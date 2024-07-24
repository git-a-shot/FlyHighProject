<?php
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newpw"];
    $employeeId = $_POST["empid"];
    $query = "UPDATE empinfo SET empPassword = '$newPassword' WHERE empid = $employeeId";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Successfully Changed the Password.');
        window.location.href='login.html';</script>";} 
    else {
        echo "<script>alert('Error in Changing the Password.');
        </script>" . mysqli_error($conn);}
} else {
    echo "Invalid request.";}
?>
