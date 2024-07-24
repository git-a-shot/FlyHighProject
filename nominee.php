<?php
session_start();
include('connection.php');
if(isset($_POST["save"])){
    $empID = $_SESSION['employeeId'];
    $aadhaarNo = $_POST['aadhaarNo'];  // Initialize $aadhaarNo here
    $lastFourDigits = substr($aadhaarNo,-4);
    $nomineeID = $empID.$lastFourDigits;
    $_SESSION['nomineeID'] = $nomineeID; 
    $firstName = $_POST['firstName'];
    $_SESSION['nomlastName'] = $firstName;
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $_SESSION['nomlastName'] = $lastName;
    $dateOfBirth = $_POST['dateOfBirth'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phoneNo = $_POST['contactNo'];
    $emailID = $_POST['emailID'];
    $documentName = mysqli_real_escape_string($conn, $_POST['documentName']);
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship']);
    if($_FILES["uploadedFile"]["error"] === 4){
        echo "<script> alert('Image Does Not Exist'); </script>";
    } else{
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $tmpName = $_FILES['uploadedFile']['tmp_name'];
        $validImageExtension = ['jpg', 'jpeg', 'png','pdf'];
        $imageExtension = explode('.', $fileName); 
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension, $validImageExtension)){
            echo "<script> alert('Invalid Image Extension'); </script>";
        } else if ($fileSize>100000000){
            echo "<script> alert ('Image size is too large');</script>";
        }else{
            $sql_count_entries = "SELECT COUNT(*) as entryCount FROM nomineeinfo WHERE empId = '$empID'";
            $result = mysqli_query($conn, $sql_count_entries);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $entryCount = $row['entryCount'];
                $maxEntries = 10; 
                if ($entryCount < $maxEntries){
                    $newImageName = uniqid();
                    $newImageName .= '.' . $imageExtension;
                    move_uploaded_file($tmpName, 'upload/' . $newImageName);
                    $sql_entry_details = "INSERT INTO nomineeinfo (nomineeID,empID,firstName,middleName,lastName,dateOfBirth,age,gender,contactNo,emailID,aadhaarNo,documentName,docPath,relationship) 
                     VALUES ('$nomineeID','$empID','$firstName','$middleName','$lastName','$dateOfBirth','$age','$gender','$phoneNo','$emailID','$aadhaarNo','$documentName','$newImageName','$relationship')";
                    if ($relationship == 'Spouse' || $relationship == 'Mother' || $relationship == 'Father') {
                        $sql_check_relationship = "SELECT * FROM nomineeinfo WHERE empId = '$empID' AND relationship = '$relationship'";
                        $result_check_relationship = mysqli_query($conn, $sql_check_relationship);
                        if (mysqli_num_rows($result_check_relationship) > 0) {
                            echo "<script> alert ('A $relationship already exists for this employee. Cannot add more than one.');
                            document.location.href='nom.php';</script>";
                        }     else {
                            mysqli_query($conn, $sql_entry_details);
                            echo "<script> alert ('Successfully Added'); document.location.href='passd.php';</script>";
                        }
                    } else {
                        mysqli_query($conn, $sql_entry_details);
                        echo "<script> alert ('Successfully Added');document.location.href='passd.php';</script>";  
                    }
                } else {
                    echo "<script> alert ('Maximum limit reached. Cannot add more nominees for this employee.');document.location.href='home.php';</script>";
                }   
            } else {
                echo "<script> alert ('Error in checking entry count. Please try again.');
                document.location.href='passd.php';</script>";
            }
        }
    }
}else{
    echo mysqli_error($conn);
}
?>