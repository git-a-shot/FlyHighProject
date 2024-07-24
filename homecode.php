<?php
session_start();
include("connection.php");
if (isset($_POST['book'])) {
    $uniqueID = uniqid();
    $hashedID = md5($uniqueID);
    $bookingID = substr($hashedID, 0, 8);
    $empID = $_SESSION['employeeId'];
    $passengerName = $_POST['nomineesList'];
    $nomineeID = $_SESSION['nomineeID'];
    $validity = $_POST['validity'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $departureDate = $_POST['departureDate'];
    $sql_fetch_quota = "SELECT quota FROM empinfo WHERE empId = ?";
    $stmt_quota = $conn->prepare($sql_fetch_quota);
    $stmt_quota->bind_param("i", $empID);
    $stmt_quota->execute();
    $result_quota = $stmt_quota->get_result();
    $row_quota = $result_quota->fetch_assoc();
    $quota = $row_quota['quota'];
    if ($quota > 0) {
        if ($passengerName == $_SESSION['firstName'].' '.$_SESSION['lastName']) {
            $sql_fetch_details = "SELECT * FROM empinfo WHERE empId = ?";
            $stmt = $conn->prepare($sql_fetch_details);
            $stmt->bind_param("i", $empID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $nomineeID=$_SESSION['employeeId'];
            $_SESSION['email'] = $row['empEmail'];
            $_SESSION['contact'] = $row['empPhoneNo'];
        } else {
            $sql_fetch_details = "SELECT * FROM nomineeinfo WHERE nomineeID = ?";
            $stmt = $conn->prepare($sql_fetch_details);
            $stmt->bind_param("s", $nomineeID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $_SESSION['contact'] = $row['contactNo'];
            $_SESSION['email'] = $row['emailID'];
        }
        $sql = "INSERT INTO bookdetails (bookingID, source, destination, bookDate, validity, empId, nomineeID, passengerName) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $bookingID, $source, $destination, $departureDate, $validity, $empID, $nomineeID, $passengerName);
        if ($stmt->execute()) {
            $sql_update_quota = "UPDATE empinfo SET quota = quota - 1 WHERE empId = ?";
            $stmt_update = $conn->prepare($sql_update_quota);
            $stmt_update->bind_param("i", $empID);
            $stmt_update->execute();
            $_SESSION['bookingID'] = $bookingID;
            $_SESSION['source'] = $source;
            $_SESSION['destination'] = $destination;
            $_SESSION['departureDate'] = $departureDate;
            $_SESSION['passengerName'] = $passengerName;
            header("Location: ticket.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Quota exceeded. Cannot book ticket.'); 
        window.location.href = 'home.php';</script>";
    }
}
mysqli_close($conn);
?>
