<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">
    <link rel="stylesheet" href="search.css"> 
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h2>Search Employee</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <input type="text"  name="search" placeholder="Enter Employee ID or Name"><i class='bx bx-search'></i>
            <input type="submit" value="Search">
        </form>
    </div>
    <div class="dashboard-link-container">
    <a href="dashboard.html" class="button">Go To Dashboard</a>
</div>
    <div class="employee-list-container">
        <h2>Employee List</h2>
        <table>
            <thead>
                <tr>
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
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT * FROM empinfo WHERE empId = '$search' OR firstName LIKE '%$search%' OR lastName LIKE '%$search%'";
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
                            echo "<td class='action-column'>";
                            echo "<button id=edit name=edit class='manage-btn edit-btn' onclick='editEmpNom(" . $row["empId"] . ")'>Edit</button>";
                            echo "<button id=delete name=delete class='manage-btn delete-btn' onclick='deleteEmpNom(" . $row["empId"] . ")'>Delete</button>";
                            echo "</td>";
                            echo "</td>";
                            echo "<td><button id=viewAll name=viewAll class='action-btn' onclick='viewAll(" . $row["empId"] . ")'>View</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14'>No employee found with the given ID or name.</td></tr>";
                    }
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    function showNomineeDetails(empId) {
            window.location.href = 'adminNomDetail.php?empId=' + empId;
        }
        function deleteEmpNom(empId) {
        if (confirm("Are you sure you want to delete this Employee?")) {
            window.location.href = "deleteEmpNom.php?empId=" + empId;
        }
      }
      function editEmpNom(empId) {
        if (confirm("Are you sure you want to edit this Employee?")) {
            window.location.href = "editEmpNom.php?empId=" + empId;
        }
      }
      function viewAll(empId) {
            window.location.href = 'adminViewAll.php?empId=' + empId;
        }
</script>
</html>
