<?php
$user='root'; $pass='gvava'; $db='flyhigh';
$conn=mysqli_connect('localhost',$user,$pass,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

