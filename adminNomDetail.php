<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <title>Nominee Information</title>
    <h2>Nominee Information</h2>
</head>
<body>
<?php
include("connection.php");
if (isset($_GET['empId'])) 
{
    $empId = $_GET['empId'];
    $sql = "SELECT * FROM nomineeinfo WHERE empID = $empId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo '<div class="button-container"><button class="dashboard-button"><a href="dashboard.html">Back To Home Page</a></button></div>';
        echo "<table>";
        echo "<thead><tr><th>Nominee ID</th><th>Name</th><th>Date of Birth</th><th>Age</th><th>Gender</th><th>Contact No</th><th>Email ID</th><th>Aadhaar No</th><th>Document Name</th><th>Document Path</th><th>Relationship</th><th>Approval/Confirmation</th><th class='action-column'>Action</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nomineeID"] . "</td>";
            echo "<td>" . $row["firstName"] . " " . $row["middleName"] . " " . $row["lastName"] . "</td>";
            echo "<td>" . $row["dateOfBirth"] . "</td>";
            echo "<td>" . $row["age"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["contactNo"] . "</td>";
            echo "<td>" . $row["emailID"] . "</td>";
            echo "<td>" . $row["aadhaarNo"] . "</td>";
            echo "<td>" . $row["documentName"] . "</td>";
            echo "<td><a href='upload/" . $row["docPath"] . "' target='_blank'>" . $row["documentName"] . "</a></td>";
            echo "<td>" . $row["relationship"] . "</td>";
            if ($row["aprv_conf"] == "Approved"){
                echo "<td>Approved</td>";} 
            else if ($row["aprv_conf"] == "Approved, Confirmed") {
                echo "<td>Approved, Confirmed</td>";} 
            else {
                echo "<td><button class='aprv-btn' onclick='confirmApproval(" . $row["nomineeID"] . ")'>Approval Pending</button></td>";}
                echo "<td>";
                echo "<button id=edit name=edit class='manage-btn edit-btn' onclick='editEmpNom(" . $row["nomineeID"] . ")'>Edit</button>";
                echo "<button id=delete name=delete class='manage-btn delete-btn' onclick='deleteEmpNom(" . $row["nomineeID"] . ")'>Delete</button>";
                echo "</td>";
        }
        echo "</tbody>";
        echo "</table>";
    }else {
        echo "No nominee information found for Employee ID: $empId";}
    $conn->close();
} 
else {
    echo "Employee ID parameter is missing";}
?>
<script>
    function confirmApproval(nomineeID) {
        if (confirm("Are you sure you want to approve this nominee?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();}
            };
            xhr.open("GET", "adminNomAprv.php?nomineeID=" + nomineeID, true);
            xhr.send();
        }
    }
    function deleteEmpNom(nomineeID) {
        if (confirm("Are you sure you want to delete this nominee?")) {
            window.location.href = "deleteEmpNom.php?nomineeID=" + nomineeID;}
    }
    function editEmpNom(nomineeID)     {
        if (confirm("Are you sure you want to Edit this nominee?")) {
            window.location.href = "editEmpNom.php?nomineeID=" + nomineeID;}
    }
</script>
</body>
</html>