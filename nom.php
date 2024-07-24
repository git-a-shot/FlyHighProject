<?php
session_start();
function isWithinRange($startDate, $endDate) {
    $currentDate = date('Y-m-d');
    return ($currentDate >= $startDate && $currentDate <= $endDate);
}
$allowedStartDate = date('Y') . '-01-25';
$allowedEndDate = date('Y') . '-05-31';
if (!isWithinRange($allowedStartDate, $allowedEndDate)) {
    echo "<script>alert('Nomination period has ended or has not started yet.');
    document.location.href='home.php';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="nom.css">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <title>Add Nominee</title>
</head>
<body>
    <div class="container">
        <h1>Nominee Details</h1>
        <form action="nominee.php" id="nomineeForm"  method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <header>Personal Details</header>
            <div class="fields1">          
                <input type="hidden" name="nomineeCount[]" value="1">
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
                    <input type="date" placeholder="Enter Birthdate" id="dateOfBirth" name="dateOfBirth" oninput="validateDate()" required>
                    <div id="dateError" class="error-message"></div>
                </div>
                <div class="input-field">
                    <label>Age</label>
                    <input type="text"  id="age" name="age" readonly>
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
                    <input type="email" placeholder="Enter Email Id" name="emailID" id="emailID" oninput="myfun()" required>
                    <i class="bi bi-envelope-at-fill"></i>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="input-field">
                    <label>Aadhar Number</label>
                    <input type="text" placeholder="Enter Aadhar number" name="aadhaarNo" id="aadhaarNo" maxlength="14" oninput="formatAadharNumber()" required>
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
            </div>
            <div class="button-container">
                <button type="submit" name="save" id="save">Save Details</button>
                <a href="passd.php">
                    <button type="button">Add Passport</button>
                </a>
                <a >
                    <button type="button"><a href="home.php">Back</a></button>
                </a>
            </div>  
        </form>
    </div>
    <script src="nomscript.js"></script>
    <script>
    function validateForm() {
        // Check if any error message is visible
        if (document.getElementById("firstNameError").innerHTML !== "" ||
            document.getElementById("middleNameError").innerHTML !== "" ||
            document.getElementById("lastNameError").innerHTML !== "" ||
            document.getElementById("dateError").innerHTML !== "" ||
            document.getElementById("contactNoError").innerHTML !== "" ||
            document.getElementById("emailError").innerHTML !== "") {
            
            alert("Please correct the errors before submitting the form.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>
</body>
</html>