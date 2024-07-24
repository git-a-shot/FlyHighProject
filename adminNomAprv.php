<?php
include("connection.php");
if(isset($_GET['nomineeID'])) 
{
    $nomineeID = $_GET['nomineeID'];
    $sql = "UPDATE nomineeinfo SET aprv_conf = 'Approved' WHERE nomineeID = $nomineeID";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Successfully Approved.');</script>";} 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;}
    $conn->close();
} 
else {
    echo "Error: Nominee ID parameter is missing";}
?>
