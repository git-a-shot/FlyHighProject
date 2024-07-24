<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
<title>Employee Nominee Information</title>
<style>
  body { font-family: Arial, sans-serif; }
  table {
    width: 100%; border-collapse: collapse; }
  th, td {
    padding: 10px; border-bottom: 1px solid #ddd; }
  th { background-color: #f2f2f2; }
  .action-btn {
    padding: 5px 10px; background-color: #4CAF50;
    color: white; border: none;
    border-radius: 3px; cursor: pointer; }
</style>
</head>
<body>
<table>
<thead>
  <tr>
    <th>Employee ID</th>
    <th>Employee Name</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>
<?php
include ("connection.php");
$sql = "SELECT empId, CONCAT(firstName, ' ', middleName, ' ', lastName) AS empName FROM empinfo";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row["empId"]."</td>";
    echo "<td>".$row["empName"]."</td>";
    echo "<td><button class='action-btn' onclick='showNomineeDetails(".$row["empId"].")'>Show Nominee Details</button></td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='3'>No records found</td></tr>";
}
$conn->close();
?>
</tbody>
</table>
<script>
    function showNomineeDetails(empId) {
        window.location.href = 'adminNomDetail.php?empId=' + empId;}
</script>
</body>
</html>
