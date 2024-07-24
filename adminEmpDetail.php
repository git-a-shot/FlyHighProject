<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminEmp.css">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <title>Employee List</title>
    <style>
    body {
    font-family: Arial, sans-serif; background-color: #f5f5f5; 
    margin: 0; padding: 20px;}
    table {
    padding: 8px 8px; width: 100%; margin-bottom: 20px;
    border-collapse: collapse; background-color: #fff;
    border-radius: 8px; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); }
    td {
    padding:2px 8px; text-align: center;
    font-size: 14px; border: 1px solid #ddd; }
    th {
    background-color: #3498db; font-weight: bold;
    font-size: 18px; padding:5px 10px;
    color: #faf7f7; border: 1px solid #ddd; }
  tbody tr:hover { background-color: #a8d3f1;}
  .no-records {
    text-align: center; font-style: italic; color: #666; }
  h2 {
    margin-top: 2px; text-align: center; color: #333; 
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    font-size: 35px;}
  .action-btn1 {
    background-color: #4CAF50; border: none;
    color: white; padding: 4px 8px;
    text-align: center; font-size: 14px;
    margin: 4px 2px; cursor: pointer; border-radius: 4px; }
  .action-btn {
    background-color:  #ffca28; border: none;
    color: white; padding: 4px 8px;
    text-align: center; font-size: 14px;
    margin: 4px 2px; cursor: pointer; border-radius: 4px; }
  .action-btn:hover{
    transform: translateY(-2px); font-size: 15px;
    box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1);}
  .edit-btn {
    background-color: #4CAF50; border: none;
    color: white; padding: 4px 8px; border-radius: 4px;
    text-align: center; text-decoration: none;
    display: flex; justify-content: center;
    font-size: 14px; margin: 4px 2px;
    transition-duration: 0.4s; cursor: pointer;
  }
  .edit-btn:hover {
    background-color: #45a049; transform: translateY(-2px);
    box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1); font-size: 15px; }
  .delete-btn {
    background-color: #f44336; border: none; color: white;
    padding: 4px 8px; text-align: center; text-decoration: none;
    display: flex; justify-content: center; font-size: 14px;
    margin: 4px 2px; transition-duration: 0.4s;
    cursor: pointer; border-radius: 4px;}
  .delete-btn:hover {
    background-color: #d32f2f; transform: translateY(-2px);
    box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1); font-size: 15px; }
</style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <h2>Employee List</h2>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Contact Number</th>
                <th>Designation</th>
                <th>Password</th>
                <th>Aadhaar Number</th>
                <th>Date Of Birth</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Class of Travel</th>
                <th>Nominee Status</th>
                <th class="action-column">Action</th>
                <th>Journey Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('connection.php');
            $sql = "SELECT *, TIMESTAMPDIFF(YEAR, empDateOfBirth, CURDATE()) AS empAge FROM empinfo";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nomineeQuery = "SELECT * FROM nomineeinfo WHERE empId = " . $row['empId'];
                    $nomineeResult = $conn->query($nomineeQuery);
                    $allApproved = true;
                    if ($nomineeResult->num_rows > 0) {
                        while ($nomineeRow = $nomineeResult->fetch_assoc()) {
                          if ($nomineeRow['aprv_conf'] != 'Approved' && $nomineeRow['aprv_conf'] != 'Approved, Confirmed') {
                            $allApproved = false;
                            break;
                        }
                        }
                    } else {
                        $allApproved = false;
                    }
                    echo "<tr>";
                    echo "<td>" . $row["empId"] . "</td>";
                    echo "<td>" . $row["firstName"] . " " . $row["middleName"] . " " . $row["lastName"] . "</td>";
                    echo "<td>" . $row["empAge"] . "</td>";
                    echo "<td>" . $row["empGender"] . "</td>";
                    echo "<td>" . $row["empPhoneNo"] . "</td>";
                    echo "<td>" . $row["empDesignation"] . "</td>";
                    echo "<td>" . $row["empPassword"] . "</td>";
                    echo "<td>" . $row["empAadhaar"] . "</td>";
                    echo "<td>" . $row["empDateOfBirth"] . "</td>";
                    echo "<td>" . $row["empGrade"] . "</td>";
                    echo "<td>" . $row["empEmail"] . "</td>";
                    echo "<td>" . $row["classOfTravel"] . "</td>";
                    echo "<td>";
                    if ($allApproved) {
                        echo "<button class='action-btn1' onclick='showNomineeDetails(" . $row["empId"] . ")'>Done</button>";
                    } else {
                        echo "<button class='action-btn' onclick='showNomineeDetails(" . $row["empId"] . ")'>Pending</button>";
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<button id=edit name=edit class='manage-btn edit-btn' onclick='editEmpNom(" . $row["empId"] . ")'>Edit</button>";
                    echo "<button id=delete name=delete class='manage-btn delete-btn' onclick='deleteEmpNom(" . $row["empId"] . ")'>Delete</button>";
                    echo "</td>";
                    echo "<td><button id=viewAll name=viewAll class='manage-btn delete-btn' onclick='viewAll(" . $row["empId"] . ")'>View</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14'>No records found</td></tr>";
            }
            echo "<a href=\"dashboard.html\">Go To Dashboard</a>";
            $conn->close();
            ?>
        </tbody>
    </table>
    <script>
        function showNomineeDetails(empId) {
            window.location.href = 'adminNomDetail.php?empId=' + empId;}
        function deleteEmpNom(empId) {
        if (confirm("Are you sure you want to delete this Employee?")) {
            window.location.href = "deleteEmpNom.php?empId=" + empId;}}
      function editEmpNom(empId) {
        if (confirm("Are you sure you want to edit this Employee?")) {
            window.location.href = "editEmpNom.php?empId=" + empId;}}
    </script>
</body>
</html>
