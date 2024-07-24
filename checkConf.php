<?php
session_start();
include ("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['employeeID'])) {
        $employeeID = $_GET['employeeID'];
        $count_sql = "SELECT COUNT(*) AS count FROM nomineeinfo WHERE empID = $employeeID AND aprv_conf = 'Approved, Confirmed'";
        $count_result = $conn->query($count_sql);
        $count_row = $count_result->fetch_assoc();
        $count = $count_row['count'];
        if ($count < 5) {
            echo 'confirm';
        } else {
            echo 'More than 5 nominees cannot be selected.';
        }
    } else {
        echo 'Error: Employee ID parameter is missing';
    }
} else {
    echo 'Invalid request method';
}
?>