<?php
session_start();
include ("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['adminname'];
    $password = $_POST['adminPassword'];
    if ($username=="admin" && $password=="gvava"){
        header("Location: dashboard.html");}
    else {
        echo "Invalid username or password";}
}
$conn->close();
?>