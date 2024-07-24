<?php
include ("connection.php");
if(isset($_GET['nomineeID'])) {
    $nomineeID = $_GET['nomineeID'];
    $sql = "DELETE FROM nomineeinfo WHERE nomineeID = $nomineeID";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nominee deleted successfully');</script>";
        echo "<script>window.history.go(-1);</script>";
    } else {
        echo "Error deleting nominee: " . $conn->error;
    }
    $conn->close();
}
else if (isset($_GET['empId'])) {
    $empId = $_GET['empId'];
    $sql = "DELETE FROM empinfo WHERE empId = $empId";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employee deleted successfully');</script>";
        echo "<script>window.history.go(-1);</script>";
    } else {
        echo "Error deleting employee: " . $conn->error;
    }
    $conn->close();   
} 
else {
    echo "Error: Nominee ID or Employee ID parameter is missing";
}
?>
