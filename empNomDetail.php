<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
  <link rel="stylesheet" href="table.css">
  <title>Nominee List</title>
</head>
</html>
<?php
session_start();
include ("connection.php");
$empid=$_SESSION['employeeId'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if(isset($_POST['confirm_nominee'])) {
    $nomineeID = $_POST['nomineeID'];
    $count_sql = "SELECT COUNT(*) AS count FROM nomineeinfo WHERE empID = $empid AND aprv_conf = 'Approved, Confirmed'";
    $count_result = $conn->query($count_sql);
    $count_row = $count_result->fetch_assoc();
    $count = $count_row['count'];
    if ($count < 5) {
      echo "<script>
              if(confirm('Are you sure you want to confirm this nominee?')) {
                window.location.href = 'empNomConf.php?nomineeID=$nomineeID';
              }
            </script>";
    } else {
      echo "<script>alert('More than 2 nominees cannot be selected.');</script>";
    }
  }
}
$sql = "SELECT n.*, p.nomineeID AS passportID FROM nomineeinfo n
        LEFT JOIN passportdetails p ON n.nomineeID = p.nomineeID
        WHERE n.empID = $empid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "<table border='1'>
        <h2>Nominee List</h2>
        <tr>
          <th>Nominee Name</th>
          <th>Date of Birth</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Contact Number</th>
          <th>Email Id</th>
          <th>Aadhaar Number</th>
          <th>Document Name</th>
          <th>Relationship</th>
          <th>Approval Status</th>
          <th>Confirmation</th>
          <th>Passport</th>
        </tr>";
  echo '<div class="button-container"><button class="dashboard-button"><a href="home.php">Back To Home Page</a></button></div>';
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row["firstName"]." ".$row["middleName"]." ".$row["lastName"]."</td>
            <td>".$row["dateOfBirth"]."</td>
            <td>".$row["age"]."</td>
            <td>".$row["gender"]."</td>
            <td>".$row["contactNo"]."</td>
            <td>".$row["emailID"]."</td>
            <td>".$row["aadhaarNo"]."</td>
            <td>".$row["documentName"]."</td>
            <td>".$row["relationship"]."</td>
            <td>".$row["aprv_conf"]."</td>
            <td>";
    if ($row["aprv_conf"] == "Approved") {
      echo "<form method='post'>
              <input type='hidden' name='nomineeID' value='".$row['nomineeID']."'>
              <input type='submit' name='confirm_nominee' value='Confirm'>
            </form>";
    } else if ($row["aprv_conf"] == "Not Approved") {
      echo "Cannot Confirm";
    } else {
      echo "Confirmed";
    }
    echo "</td>
            <td>";
    if ($row["passportID"]) {
      echo "Added";
    } else {
      echo "Not Added";
    }
    echo "</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "No Nominee Listed";
}
$conn->close();
?>
