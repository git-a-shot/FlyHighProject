<?php
session_start();
include('connection.php');
if (isset($_SESSION['nomineeID'])){
    if(isset($_POST["save"])){
        $nomineeID = $_SESSION['nomineeID'];
        $empID = $_SESSION['employeeId'];;
        $passNumber = $_POST['passNumber'];
        $surName = $_POST['surName'];
        $givenName = $_POST['givenName'];
        $dateOfBirth = $_POST['dateOfBirth'];
        $nationality = $_POST['nationality'];
        $gender = $_POST['gender'];
        $placeOfBirth = $_POST['placeOfBirth'];
        $placeOfIssue = $_POST['placeOfIssue'];
        $dateOfIssue = $_POST['dateOfIssue'];
        $dateOfExpiry = $_POST['dateOfExpiry'];
        if($_FILES["path"]["error"] === 4){
            echo"<script> alert('Image Does Not Exist'); </script>";
        } else{
            $fileName = $_FILES['path']['name'];
            $fileSize = $_FILES['path']['size'];
            $tmpName = $_FILES['path']['tmp_name'];
            $validImageExtension = ['jpg', 'jpeg', 'png','pdf'];
            $imageExtension = explode('.', $fileName); 
            $imageExtension = strtolower(end($imageExtension));
            if(!in_array($imageExtension, $validImageExtension)){
                echo "<script> alert('Invalid Image Extension'); </script>";
            } else if ($fileSize>100000000){
                echo "<script> alert ('Image size is too large');</script>";
            } else{
                $newImageName=uniqid();
                $newImageName .='.'.$imageExtension;
                move_uploaded_file($tmpName, 'passport/'.$newImageName);
                $sql_entry_details = "INSERT INTO passportdetails (empID,nomineeID,passNumber,surName,givenName,nationality,gender,dateOfBirth,placeOfBirth,placeOfIssue,dateOfIssue,dateOfExpiry,path)
                 VALUES ('$empID','$nomineeID','$passNumber','$surName','$givenName','$nationality','$gender','$dateOfBirth','$placeOfBirth','$placeOfIssue','$dateOfIssue','$dateOfExpiry','$newImageName')";
                mysqli_query($conn,$sql_entry_details);
                echo "<script> alert ('Successfully Added');
                document.location.href='passd.php';</script>";
            }
        }
    }
}
?>