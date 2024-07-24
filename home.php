<?php
session_start();
include("connection.php");
if (isset($_SESSION['firstName']) && isset($_SESSION['employeeId'])){   
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="homestyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Home page</title>
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
</head>
<body>
    <header>
        <nav>
        <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <div class="logo"><img src="image\logo.jpeg" alt="Logo"></div>
            <ul>
                <li><a class="active" href="home.php">Home</a></li>
                <li>
                <a href="#">My Profile</a>
                <ul class="dropdown">
                    <li><a href="empNomDetail.php">Nominee Details</a></li>
                    <li><a href="myQuota.php">My Quota</a></li>
                </ul>
                </li>
                <li><a href="nom.php">Add Nominees</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </div>
        </nav>
    </header>
    <section class="welcome-section">
        <div class="welcome-message">
            <h1>Welcome <?php echo $_SESSION['firstName'];?> to our Fly High</h1>
            <p>Find and Explore Booking Experience</p>
        </div>
        <img src="image\back1.jpeg" alt="Welcome Image">
    </section>
    <section class="blocks-container">
    <?php
$empID = $_SESSION['employeeId'];
$currentDate = date("Y-m-d");
$sql = "SELECT * FROM bookdetails WHERE empId = ? AND bookDate > ? AND status = 'Booked' ORDER BY bookDate ASC LIMIT 2";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $empID, $currentDate);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
?>
    <div class="upcoming-trips-block">
        <h2>Upcoming Trips</h2>
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Validity</th>
                    <th>Passenger Name</th>
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
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
                    <button onclick="window.location.href='allTrips.php'">View All Trips</button>
                </div>
                <?php
            } else {
                echo "<div class='upcoming-trips-block'>";
                echo "<h2>No Upcoming Trips</h2>";
                echo "</div>";
            }
            ?>      
            <div class="booking-block">
                <form class="form-group" method="post" action="homecode.php">
                <label for="classTravel">Available Quota:</label>                  
                                <?php
                                    include 'connection.php';
                                    $loggedInEmployeeId = $_SESSION['employeeId'];
                                    $query = "SELECT * FROM empinfo WHERE empid = $loggedInEmployeeId";
                                    $result = mysqli_query($conn, $query);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $_SESSION['quota'] = $row['quota'];
                                        echo  $_SESSION['quota'] ;
                                    } 
                                    mysqli_close($conn);
                                ?>
                            <div id="form" class="text-white">                            
                            <h2>Booking Details</h2>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="source">Source:</label>
                                <div class="input-group">
                                    <input list="sourceOptions" type="text" class="form-control" id="source" name="source" placeholder="Source" required>
                                    <datalist id="sourceOptions"></datalist>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="destination">Destination:</label>
                                <div class="input-group">
                                    <input list="destinationOptions" type="text" class="form-control" id="destination" name="destination" placeholder="Destination" required>
                                    <datalist id="destinationOptions"></datalist>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="departureDate">Departure Date:</label>
                                <div class="input-group">
                                    <input type="date" id="departureDate" name="departureDate" class="form-control" onchange="setValidity()">                                    
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="validity">Validity:</label>
                                <div class="input-group">
                                    <input type="date" id="validity" name="validity" class="form-control"  readonly>                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="passengerName">Passenger Name:</label>
                                <div class="input-group">
                                    <?php include 'connection.php'; 
                                        $loggedInEmployeeId =$_SESSION['employeeId'];
                                        echo '<select id="nomineesList" name="nomineesList" class="form-control" required>';
                                        echo '<option value="'.$_SESSION['firstName'].' '.$_SESSION['lastName'].'">Self</option>';
                                        $query = "SELECT * FROM nomineeinfo WHERE empid = $loggedInEmployeeId AND aprv_conf = 'Approved, Confirmed'";
                                        $result = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($result) > 0) {              
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $_SESSION['nomineeID'] = $row['nomineeID'];
                                                $nomineeID=$_SESSION['nomineeID'];
                                                $firstName = $row['firstName'];
                                                $lastName = $row['lastName'];
                                                echo '<option value="' . $firstName . ' ' . $lastName . '">' . $firstName . ' ' . $lastName . '</option>';
                                            }
                                            echo '</select>';
                                        } else {
                                            echo 'No approved or confirmed nominees found.';
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="classTravel">Class of Travel:</label>
                                <div class="input-group">
                                <?php
                                    include 'connection.php';
                                    $loggedInEmployeeId = $_SESSION['employeeId'];
                                    $query = "SELECT * FROM empinfo WHERE empid = $loggedInEmployeeId";
                                    $result = mysqli_query($conn, $query);
                                    if ($result && mysqli_num_rows($result) > 0)   {
                                        $row = mysqli_fetch_assoc($result);
                                        $_SESSION['classOfTravel'] = $row['classOfTravel'];
                                        echo '<input type="text" id="classTravel" name="classTravel" class="form-control"  value="' . $_SESSION['classOfTravel'] . '" readonly> ';
                                    } 
                                    mysqli_close($conn);
                                ?>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-plane"></i></span>
                                </div>
                            </div>  
                        </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="book" id="book"><i class="fas fa-check"></i> Book Now</button>
                    </div>
                </form>
            </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <footer>
    <div class="footer-content">
        <p> &copy; 2024 Your Travel Portal. All rights reserved.</p>
    </div>
</footer>
    <script src="homescript.js" ></script>
    <script src="script2.js" ></script>
</body>
</html>
    <?php
    }
else{
    header("Location: index.php");
    exit();}