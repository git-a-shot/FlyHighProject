<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Details</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
</head>
<style>
    body {
    font-family: Arial, sans-serif; background-color: #fff; }
.container {
    width: 70%; margin: 0 auto;
    background-color: #bfdff6; backdrop-filter: blur(50px);
    border-radius: 12px; padding: 20px;
    box-shadow: 2px 8px 10px rgba(0, 0, 0, 0.1);}
h2 {
    text-align: center; color: #333; font-size: 35px;  
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);     
}
form {
    display: grid; grid-template-columns: repeat(2, 1fr);
    grid-gap: 10px; margin-bottom: 10px;}
.form-group { grid-column: span 1; }
.form-group input{
    width: calc(50% - 22px);  padding: 10px;
    background-color: #6FB1FC;
    border: #fff; color: #fff;
    border-radius: 5px; outline: none;}
.error-message {
    color: red; font-size: small;}
.input-field {
    position: relative; margin-bottom: 10px;}
.input-field label {
    display: block; margin-bottom: 5px; color: black;}
.input-field input {
    width: calc(90% - 22px); padding: 15px;
    border: 1px solid #ccc; border-radius: 5px; outline: none; }
.option1 label {
    display: block; margin-bottom: 5px; color: black;}
.option1 select {
    width: calc(100% - 40px); padding: 15px;
    border: 1px solid #ccc; border-radius: 5px;
    outline: none; cursor: pointer;}
.input-field input[type="text"]:hover,
.input-field input[type="date"]:hover {
    box-shadow: 0 2px 10px rgba(4, 96, 145, 0.3); }
.btn-container {
    text-align: center; margin-top: 28px;}
.btn {
    width: calc(50% - 25px); padding: 10px 20px;
    height: 45px; margin-bottom: 4px; color: #fff;
    background-color:#26a0da; border: none;
    font-size: 19px; border-radius: 5px; cursor: pointer;
    transition: background-color 0.3s ease;}
.btn:hover {
    background-color: #4364F7; transform: translateY(-2px);
    box-shadow: 2px 6px 8px rgba(0, 0, 0, 0.1);}
</style>
<body>
<div class="container">
    <?php
    include ("connection.php");
    if (isset($_GET['nomineeID'])){
        $nomineeID = $_GET['nomineeID'];
        $sql = "SELECT * FROM nomineeinfo WHERE nomineeID = '$nomineeID'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nomineeID = $row['nomineeID'];
            $empID = $row['empID'];
            $aadhaarNo = $row['aadhaarNo'];
            $aprv_conf = $row['aprv_conf'];
            $conn->close();
        } 
        else {
            echo "No data found for nominee ID: $nomineeID";
        }
    ?>
    <h2>Update Nominee Details</h2>
    <form action="edit.php" method="post"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="nomineeid">Nominee ID:</label>
            <input type="text"  id="nomineeid" name="nomineeid" value="<?php echo $nomineeID; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="empID">Employee ID:</label>
            <input type="text" id="empID" name="empID" value="<?php echo $empID; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="aadhaarNo">Aadhaar Number:</label>
            <input type="text"  id="aadhaarNo" name="aadhaarNo" value="<?php echo $aadhaarNo; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="aprv_conf">Approval Status:</label>
            <input type="text"  id="aprv_conf" name="aprv_conf" value="<?php echo $aprv_conf; ?>" readonly>
        </div>
        <div class="input-field">
                    <label>First Name</label>
                    <input type="text" placeholder="Enter First name" id="firstName" name="firstName" oninput="validateInput('firstName')" required>
                    <i class="bi bi-person-circle"></i>
                    <div id="firstNameError" class="error-message"></div>
                </div>
                <div class="input-field">
                    <label>Middle Name</label>
                    <input type="text" placeholder="Enter Middle name" id="middleName" name="middleName" oninput="validateInput('middleName')">
                    <i class="bi bi-person-circle"></i>
                    <div id="middleNameError" class="error-message"></div>
                </div>
                <div class="input-field">                        
                    <label>Last Name</label>
                    <input type="text" placeholder="Enter Last name" id="lastName" name="lastName" oninput="validateInput('lastName')" required>
                    <i class="bi bi-person-circle"></i>
                    <div id="lastNameError" class="error-message"></div>
                </div>
                <div class="input-field">
                    <label>Date of Birth</label>
                    <input type="date" placeholder="Enter Birthdate" id="dateOfBirth" name="dateOfBirth" onchange="validateDate()" required>
                    <div id="dateError" class="error-message"></div>
                </div>
                <div class="input-field">
                    <label>Age</label>
                    <input type="text"  id="age" name="age" >
                </div>
                <div class="option1">
                    <label>Gender</label>
                    <select name="gender" id="gender" >
                        <option value="Select Option">Select Option</option>                            
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Contact Number </label>
                    <input type="text" placeholder="Enter Contact Number" name="contactNo" id="contactNo" oninput="validateContactNo()" required>
                    <i class="bi bi-telephone-fill"></i>
                    <div id="contactNoError" class="error-message"></div>
                </div>
                <div class="input-field">
                    <label>Email Id</label>
                    <input type="text" placeholder="Enter Email Id" name="emailID" id="emailID" oninput="validateEmail()" required>
                    <i class="bi bi-envelope-at-fill"></i>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="input-field">
                    <label for="relationship"> Relationship with Employee:</label>
                    <input list="relationOptions" placeholder="Enter Relationshihp with Employee" name="relationship" id="relationshipInput" required>
                    <datalist id="relationOptions"></datalist>
                </div>
                <div class="option1">
                    <label>Add Document</label>
                    <select name="documentName" id="documentName">
                        <option value="Select Option">Select Option</option>
                        <option value="Aadhar Card">Aadhar Card</option>
                        <option value="Voter's ID">Voter's ID</option>
                        <option value="Pan Card">Pan Card</option>
                    </select>
                </div>
                <div class="input-field">
                    <label >Attach Document</label>
                    <input type="file" class="form-control-file" id="uploadedFile" enctype="multipart/form-data" name="uploadedFile"  required>
                </div> 
        <button type="submit" class="btn btn-primary" name="submitNom">Update Information</button>
    </form>
<?php
    }
    ?>
<?php
    include ("connection.php");
    if (isset($_GET['empId'])){
        $empId = $_GET['empId'];
        $sql = "SELECT * FROM empinfo WHERE empId = '$empId'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $empId = $row['empId'];
            $empAadhaar = $row['empAadhaar'];
            $conn->close();
        } 
        else {
            echo "No data found for employee ID: $empId";
        }
    ?>
    <h2>Updated Employee Information</h2>
    <form action="edit.php" method="post">
            <div class="form-group">
                <label for="empId">Employee ID:</label>
                <input type="text" id="empId" name="empId" value="<?php echo $empId; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="empAadhaar">Aadhaar Number:</label>
                <input type="text" id="empAadhaar" name="empAadhaar" value="<?php echo $empAadhaar; ?>" readonly>
            </div>
            <div class="input-field">
                <label for="firstName">First Name:</label>
                <input type="text" placeholder="Enter First Name" id="firstName" name="firstName" oninput="validateInput('firstName')" required>
            </div>
            <div class="input-field">
                <label for="middleName">Middle Name:</label>
                <input type="text" placeholder="Enter Middle Name" id="middleName" name="middleName" oninput="validateInput('middleName')">
            </div>
            <div class="input-field">
                <label for="lastName">Last Name:</label>
                <input type="text" placeholder="Enter Last Name" id="lastName" name="lastName" oninput="validateInput('lastName')" required>
            </div>
            <div class="input-field">
                <label for="empDateOfBirth">Date of Birth:</label>
                <input type="date" placeholder="Select Birthdate" id="dateOfBirth" name="dateOfBirth" onchange="validateDate()" required>
                <div id="dateError" class="error-message"></div>
            </div>
            <div class="input-field">
                <label for="empAge">Age:</label>
                <input type="text"  id="age" name="age"  readonly>
            </div>
            <div class="option1">
            <label>Gender:</label>
                    <select name="empGender" id="empGender" required>
                        <option value="Select Option">Select Option</option>                            
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                        <option value="Others">Others</option>
                    </select>
            </div>
            <div class="input-field">
                <label for="empPhoneNo">Contact Number:</label>
                <input type="text" placeholder="Enter Contact Number" id="contactNo" name="contactNo" oninput="validateContactNo()" required>
                <div id="contactNoError" class="error-message"></div>
            </div>
            <div class="input-field">
                <label for="empDesignation">Designation:</label>
                <input type="text" placeholder="Enter Enter Designation" id="empDesignation" name="empDesignation" oninput="validateInput('empDesignation')"required>
            </div>
            <div class="input-field">
        <label for="empGrade">Grade:</label>
        <input type="number" placeholder="Enter Grade (1-12)" id="empGrade" name="empGrade" min="1" max="12" required oninput="updateClassOfTravel()" onblur="restrictInput()">
        <div id="error" style="color: red;"></div>
    </div>
            <div class="input-field">
                <label for="empEmail">Email Id:</label>
                <input type="email" placeholder="Enter Email Id" id="empEmail" name="empEmail" oninput="validateEmail()" required>
            </div>
            <div class="input-field">
        <label for="classOfTravel">Class of Travel:</label>
        <input type="text" id="classOfTravel" name="classOfTravel" readonly>
    </div>
            <div class="btn-container">
                    <button type="submit" class="btn btn-primary" name="submitEmp">Update Information</button>
            </div>
    </form>
<?php
    }
    ?>
</div>
<script src="nomscript.js"></script>
</body>
</html>