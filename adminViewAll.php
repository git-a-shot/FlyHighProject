<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="table.css">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
</head>
<?php
session_start();
include ("connection.php");
if (isset($_GET['empId'])) 
{
    $empId = $_GET['empId'];
$sql = "SELECT * FROM bookdetails WHERE empID = $empId";
$result = $conn->query($sql);
?>
<h2>Trips Details</h2>
<h4>Employee ID : <?php echo $empId ?></h4>
<table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Nominee ID</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Departure Date</th>
                <th>Validity</th>
                <th>Passenger Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) 
            {                
                    echo "<tr>";
                    echo "<td>" . $row['bookingId'] . "</td>";
                    echo "<td>" . $row['nomineeID'] . "</td>";
                    echo "<td>" . $row['source'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['bookDate'] . "</td>";
                    echo "<td>" . $row['validity'] . "</td>";
                    echo "<td>" . $row['passengerName'] . "</td>";       
                    if ($row["status"] == "Claimed") {
                        echo "<td>Claimed</td>";
                    } 
                    else if ($row["status"] == "Expired") {   
                        echo "<td>Expired</td>";
                    }
                    else if ($row["status"] == "Cancelled") {   
                        echo "<td>Cancelled</td>";
                    }
                    else {
                        echo "<td><button class='claim' onclick='confirmClaim(" . $row["nomineeID"] . ")'>Claim</button></td>";
                    }
                    echo "</tr>";
            }
          ?>
            <div class="button-container"><button class="dashboard-button"><a href="dashboard.html">Back To Home Page</a></button></div>
        </tbody>
    </table>
<?php
}
$conn->close();
?>
<script>
    function confirmClaim(nomineeID) {
        if (confirm("Are you sure you want to Claim the ticket?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();
                }
            };
            xhr.open("GET", "adminClaim.php?nomineeID=" + nomineeID, true);
            xhr.send();
        }
    }
</script>
