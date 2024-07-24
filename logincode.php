<?php
session_start();
include "connection.php";
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['employeeId']) && isset($_POST['empPassword'])) {
    $uname = validate($_POST['employeeId']);
    $pass = validate($_POST['empPassword']);    
}if(empty($uname)) {
    header("Location: index.php?error=User Name is required");
    exit();
}else if(empty($pass)) {
    header("Location: index.php?error=Password is required");
    exit();
}
$sql = "SELECT * FROM empinfo WHERE empId='$uname' AND empPassword='$pass'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_assoc($result);
    if($row['empId'] == $uname && $row['empPassword'] == $pass) {
        $_SESSION['employeeId'] = $row['empId'];
        $empid=$_SESSION['employeeId'];
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['aprv_conf']=$row['aprv_cpnf'];
        $_SESSION['quota']=$row['quota'];
        header("Location: home.php");
        exit();
    } else{
        header("Location: home.php?error=Incorrect User Name or Password");    
    }
}else{
    header("Location: home.php");
    exit();
}
