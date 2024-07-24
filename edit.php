<?php
include("connection.php"); 
if (isset($_POST["submitNom"])) {
    $nomineeID = $_POST['nomineeid'];
    $empId=$_POST['empID'];
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $gender = $_POST['gender'];
    $contactNo = $_POST['contactNo'];
    $emailID = $_POST['emailID'];
    $relationship = $_POST['relationship'];
    $documentName = $_POST['documentName'];
    if ($_FILES["uploadedFile"]["error"] === 4) {
        echo "<script> alert('Image Does Not Exist'); </script>";
    } 
    else {
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $tmpName = $_FILES['uploadedFile']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png','pdf'];
        $imageExtension = explode('.', $fileName); 
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension, $validImageExtension)){
            echo "<script> alert('Invalid Image Extension'); </script>";
        }
        else if ($fileSize > 100000000) {
            echo "<script> alert ('Image size is too large');</script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpName, 'upload/' . $newImageName);
            $sql_update = "UPDATE nomineeinfo SET 
                firstName = '$firstName', middleName = '$middleName',
                lastName = '$lastName', dateOfBirth = '$dateOfBirth',
                gender = '$gender', contactNo = '$contactNo',
                emailID = '$emailID', relationship = '$relationship',
                documentName = '$documentName', docPath = '$newImageName'
                WHERE nomineeID = $nomineeID";
            if ($relationship == 'Spouse' || $relationship == 'Mother' || $relationship == 'Father') {
                $sql_check_relationship = "SELECT * FROM nomineeinfo WHERE empId = '$empId' AND relationship = '$relationship'";
                $result_check_relationship = mysqli_query($conn, $sql_check_relationship);
                if (mysqli_num_rows($result_check_relationship) > 0) {
                    echo "<script> alert ('A $relationship already exists for this employee. Cannot add more than one.');
                    window.location.href = 'adminNomDetail.php?empId=' + $empId;</script>";
                } else if ( mysqli_query($conn, $sql_update)) {
                    
                    echo "<script> alert ('Successfully Updated');
                    window.location.href = 'adminNomDetail.php?empId=' + $empId;</script>";
                }
            } else if (mysqli_query($conn, $sql_update)) {
                
                echo "<script> alert ('Successfully Updated');
                window.location.href = 'adminNomDetail.php?empId=' + $empId;</script>";
            }
        }
    }
    $conn->close();
}
else if (isset($_POST["submitEmp"])) {
    $empId = $_POST['empId']; $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName']; $lastName = $_POST['lastName'];
    $empDateOfBirth = $_POST['dateOfBirth']; $empGender = $_POST['empGender'];
    $empPhoneNo = $_POST['contactNo']; $empEmail = $_POST['empEmail'];
    $empAge = $_POST['age']; $classOfTravel = $_POST['classOfTravel'];
    $empGrade = $_POST['empGrade']; $empDesignation = $_POST['empDesignation'];
    $empAadhaar = $_POST['empAadhaar'];
    $sql_update = "UPDATE empinfo SET 
    firstName = '$firstName', middleName = '$middleName',
    lastName = '$lastName', empDateOfBirth = '$empDateOfBirth',
    empGender = '$empGender', empPhoneNo = '$empPhoneNo',
    empEmail = '$empEmail', classOfTravel = '$classOfTravel',
    empDesignation = '$empDesignation', empGrade = '$empGrade'
    WHERE empId = '$empId'";
    mysqli_query($conn, $sql_update);
    echo "<script> alert ('Successfully Updated');
    window.location.href = 'adminEmpDetail.php?empId=" . $empId . "';</script>";
    $conn->close();
}
?>
