<?php
session_start();
include("connection.php");
if (!isset($_SESSION['employeeId'])){
    echo "User not logged in.";
    exit();
}
$empID = $_SESSION['employeeId'];
$sql = "SELECT * FROM bookDetails WHERE empId = '$empID' ORDER BY bookDate ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
    <title>All Trips</title>
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">  
</head>
<body>
<div class="logo"><img src="image\logo.jpeg" alt="Logo"></div>
<h2>All Trips</h2>
<?php
if ($result && $result->num_rows > 0) {
?> 
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
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
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row['bookingId'] . "</td>";
                    echo "<td>" . $row['source'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['bookDate'] . "</td>";
                    echo "<td>" . $row['validity'] . "</td>";
                    echo "<td>" . $row['passengerName'] . "</td>";  
                    $currentDate = $row['bookDate'];
                    if ($currentDate > $row['validity']) {
                        $book = $row['bookingId']; 
                        $sql = "UPDATE bookdetails SET status = 'Expired' WHERE bookingId = '$book'";
                        if ($conn->query($sql) === TRUE) {
                            echo "<td>Expired</td>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                        continue; // Skip the remaining code and move to the next iteration
                    }
	            	else if ($row['status'] == 'Booked') {
                        echo "<td><button class='cancel-button' onclick='cancelBooking(\"" . $row['bookingId'] . "\")'>Cancel</button></td>";
                        echo "</tr>";
                    } 
                    else if ($row['status'] == 'Cancelled'){
                        echo "<td>Cancelled</td>";
                    }
                    else {
                        echo "<td>Claimed</td>";
                    }
                    echo "</tr>";
            }   
            ?>
            <div class="button-container"><button class="dashboard-button"><a href="home.php">Back To Home Page</a></button></div>
        </tbody>
    </table>
<?php
} 
else {
    echo "<p>No trips found.</p>";}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"]) && $_GET["action"] == "cancel") {
    if (isset($_GET["bookingId"])) {
        $bookingId = $_GET["bookingId"];
        $sql_check_status = "SELECT status FROM bookDetails WHERE bookingId = ?";
        $stmt_check_status = $conn->prepare($sql_check_status);
        $stmt_check_status->bind_param("s", $bookingId);
        $stmt_check_status->execute();
        $stmt_check_status->store_result();
        if ($stmt_check_status->num_rows > 0) {
            $stmt_check_status->bind_result($status);
            $stmt_check_status->fetch();
            if ($status == 'Booked' ) {
                $new_status = 'Cancelled';
                $sql_update_status = "UPDATE bookDetails SET status = ? WHERE bookingId = ?";
                $stmt_update_status = $conn->prepare($sql_update_status);
                $stmt_update_status->bind_param("ss", $new_status, $bookingId);
                if ($stmt_update_status->execute()) {
                    $sql_increment = "UPDATE empinfo SET quota = quota + 1 WHERE empId = ?";
                    $stmt_increment = $conn->prepare($sql_increment);
                    $stmt_increment->bind_param("i", $empID);
                    if ($stmt_increment->execute()) {
                        echo "<script>alert('Booking canceled successfully. Quota incremented.'); 
                        window.location.href = 'allTrips.php';</script>";
                        exit();
                    } 
                    else {
                        echo "<script>alert('Failed to increment quota. Please try again later.'); 
                        window.location.href = 'allTrips.php';</script>";
                        exit();
                    }
                } 
                else {
                    echo "<script>alert('Failed to cancel booking. Please try again later.'); 
                    window.location.href = 'allTrips.php';</script>";
                    exit();
                }
            } 
            else {
                echo "<script>alert('Cannot cancel booking. Ticket already used.'); 
                window.location.href = 'allTrips.php';</script>";
                exit();
            }
        } 
        else {
            echo "<script>alert('Booking not found.'); 
            window.location.href = 'allTrips.php';</script>";
            exit();
        }
    }
}
mysqli_close($conn);
?>
<script>
    function cancelBooking(bookingId) {
        if (confirm("Are you sure you want to cancel this booking?")) {
            window.location.href = "?action=cancel&bookingId=" + encodeURIComponent(bookingId);
        }
    }
</script>
</body>
</html>