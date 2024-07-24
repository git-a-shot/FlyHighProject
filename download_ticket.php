<?php
session_start();
$ticketContent = "Source: " . $_SESSION['source'] . "\n";
$ticketContent .= "Destination: " . $_SESSION['destination'] . "\n";
$ticketContent .= "Date of Flight: " . $_SESSION['departureDate'] . "\n";
$ticketContent .= "Class of Travel: " . $_SESSION['classOfTravel'] . "\n";
$ticketContent .= "Name of Passenger: " . $_SESSION['passengerName'] . "\n";
$ticketContent .= "Contact Number: " . $_SESSION['contact'] . "\n";
$ticketContent .= "Email ID: " . $_SESSION['email'] . "\n";
$ticketContent .= "Booking ID or E-ticket Number: " . $_SESSION['bookingID'] . "\n";
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="ticket_details.txt"');
echo $ticketContent;
?>