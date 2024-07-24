<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Details</title>
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <style>
        body {
            background-color: rgb(253, 243, 229); font-family: Arial, sans-serif;
            margin: 0; padding: 0;
        }
    .logo img {
            width: 7%; height: 5%; float: inline-start;
            margin-left: 10px; margin-bottom: 5px;
        }.container {    
            background-image: linear-gradient(to bottom,#e7f0fd 0%, #accbee 100%);
            margin-top: 20px; width: 65%; height: 65%;
            margin: 20px auto; background-color: #fff;
            padding: 20px; border-radius: 9px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }h1 {
            margin-top: 2px; text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); font-size: 45px; 
        }.details {
            margin-top: 20px; display:flex; margin-bottom: 20px; margin-left: 200px;
        }.details label {
            font-weight: bold; width: 200px;
        }        .details p {
            margin: 5px 0; flex: 1;
        }.button1 {
        padding: 8px 12px;background-color: rgba(0, 166, 255, 0.625);
        color: white; margin-top: 20px; margin-left: 200px;
        text-align: center; text-decoration: none; border: none;
        border-radius: 5px; cursor: pointer;
        box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1);
        }        .button1:hover {
        background-color: rgb(0, 166, 255);box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1);
        font-size: 17px;
        }.button {
        padding: 8px 12px; background-color: rgba(0, 166, 255, 0.625);
        color: white;margin-top: 20px; margin-left: 600px;
        text-align: center; text-decoration: none; border: none;
        border-radius: 5px; cursor: pointer; box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1);
        }.button:hover {
        background-color: rgb(0, 166, 255);
        box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1); font-size: 17px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="logo"><img src="image\logo.jpeg" alt="Logo"></div>
        <h1>Booking Details</h1>
        <hr></hr>
        <div class="details">
            <label for="source">Source:</label>
            <p><?php echo isset($_SESSION['source']) ? $_SESSION['source'] : ''; ?></p>
        </div>
        <div class="details">
            <label for="destination">Destination:</label>
            <p><?php echo isset($_SESSION['destination']) ? $_SESSION['destination'] : ''; ?></p>
        </div>
        <div class="details">
            <label for="departureDate">Date of Flight:</label>
            <p><?php echo isset($_SESSION['departureDate']) ? $_SESSION['departureDate'] : ''; ?></p>
        </div>
        <div class="details">
            <label for="classOfTravel">Class of Travel:</label>
            <p><?php echo isset($_SESSION['classOfTravel']) ? $_SESSION['classOfTravel'] : ''; ?></p>
        </div>
        <div class="details">
            <label for="passengerName">Name of Passenger:</label>
            <p><?php echo isset($_SESSION['passengerName']) ? $_SESSION['passengerName'] : ''; ?></p>
        </div>
        <div class="details">
            <label for="contactNo">Contact Number:</label>
            <p><?php echo  $_SESSION['contact']; ?></p>
        </div>
        <div class="details">
            <label for="emailID">Email ID:</label>
            <p><?php echo  $_SESSION['email']; ?></p>
        </div>
        <div class="details">
            <label for="bookingid">Booking ID or E-ticket Number:</label>
            <p><?php echo isset($_SESSION['bookingID']) ? $_SESSION['bookingID'] : ''; ?></p>
        </div>
    </div>
            <div class="details">
                <a href="download_ticket.php" class="button1" download="ticket_details.txt">Download Ticket</a>
                <a href="home.php" class="button" >Back</a>
            </div>
</body>
</html>