<?php
include ("connection.php");
session_start();
$empID=$_SESSION['employeeId'];
$query = "SELECT quota FROM empinfo where empId=$empID";
$result = mysqli_query($conn, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $balancedQuota = $row['quota'];
    $totalQuota = 14;
    $usedQuota = $totalQuota - $balancedQuota;
} else {
    $balancedQuota = 0; 
    $usedQuota = 0; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <title>Quota Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;  background-color: #f0f0f0;
        } .container {
            width: 80%; margin: 0 auto; padding: 20px;
            background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        } .quota-card {
            display: flex; justify-content: space-between;
            align-items: center;  padding: 20px;
            background-color: #f0f0f0; border-radius: 5px;
            margin-bottom: 20px;
        } .quota-card h2 {
            margin: 0;   font-size: 24px;
        } .quota-card .quota-value {
            font-size: 24px; font-weight: bold;
        } .quota-card .quota-label {
            font-size: 14px;  color: #666;
        } .button-container button {
    height: 45px; width: 25%; text-align: center;
    margin-top: 20px; margin-left: 50px; color: #060606;
    font: bolder; border: none; font-size: 18px; border-radius: 5px;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Quota Dashboard</h1>
        <div class="quota-card">
            <div>
                <h2>Total Quota</h2>
                <span class="quota-value"><?php echo $totalQuota; ?></span>
            </div>
            <div>
                <h2>Used Quota</h2>
                <span class="quota-value"><?php echo $usedQuota; ?></span>
            </div>
            <div>
                <h2>Balanced Quota</h2>
                <span class="quota-value"><?php echo $balancedQuota; ?></span>
            </div>
        </div>
        <div class="button-container"><button class="dashboard-button"><a href="home.php">Back To Home Page</a></button></div>
    </div>
</body>
</html>
