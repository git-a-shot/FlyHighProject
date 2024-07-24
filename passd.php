<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="pass.css">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
    <title>Passport Details</title>
</head>
<body>
    <div class="container2">
        <form action="pass.php" id="passForm"  method="post" enctype="multipart/form-data">
            <header>Passport Details</header>
            <div class="fields2">        
                <div class="input-field3">
                    <label for="passportNumber">Passport Number</label>
                    <input type="text" name="passNumber" id="passNumber" placeholder="Enter Passport Number" oninput="validatePassportNumber()" required>
                    <div id="passNumberError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="surname">Surname</label>
                    <input type="text" name="surName" id="surName" placeholder="Enter Surname" oninput="validateInput('surName')" required>
                    <div id="surNameError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="givenName">Given Name</label>
                    <input type="text" name="givenName" id="givenName" placeholder="Enter Given name"  oninput="validateInput('givenName')" required>
                    <div id="givenNameError" class="error-message"></div>
                </div>
                <div class="input-field3">                        
                    <label for="nationality">Nationality</label>
                    <input type="text" name="nationality" id="nationality" placeholder="Enter Nationality" oninput="validateInput('nationality')" required>
                    <div id="nationalityError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="placeOfIssue">Place of Issue</label>
                    <input type="text" name="placeOfIssue" id="placeOfIssue" placeholder="Enter place of issue" oninput="validateInput('placeOfIssue')" required>
                    <div id="placeOfIssueError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="dateOfbirth">Date of Birth</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth" placeholder="Enter Birthdate" onchange="validateDate()" required>
                    <div id="dateOfBirthError" class="error-message"></div>
                </div>
                <div class="option1">
                    <label>Passport Type</label>
                    <select name="passportType" id="passportType" onchange="calculateExpiryDate()">
                        <option value="Select Option">Select Option</option>                            
                        <option value="adult">Adult</option>
                        <option value="minor">Minor</option>
                    </select>
                </div>
                <div class="input-field3">
                    <label for="dateOfIssue">Date of Issue</label>
                    <input type="date" name="dateOfIssue" id="dateOfIssue" placeholder="Enter Date of Issue" onchange="calculateExpiryDate()" required>
                    <div id="dateOfIssueError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="dateOfExpiry">Date of Expiry</label>
                    <input type="date" name="dateOfExpiry" id="dateOfExpiry" placeholder="Automatically Calculated" onchange="validateDateOfExpiry()" required>
                    <div id="dateOfExpiryError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="passportGender">Gender</label>
                    <input type="text" name="gender" id="gender" placeholder="Enter Gender" oninput="validateInput('gender')" required>
                    <div id="genderError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="placeOfBirth">Place of Birth</label>
                    <input type="text" name="placeOfBirth" id="placeOfBirth" placeholder="Enter place of birth" oninput="validateInput('placeOfBirth')" required>
                    <div id="placeOfBirthError" class="error-message"></div>
                </div>
                <div class="input-field3">
                    <label for="attachPassport">Attach Passport</label>
                    <input type="file" name="path" id="path"  required>        
                </div>
            </div>
            <div class="button-container">
                <button type="submit" name="save" id="save">Save Details</button>
                <a href="nom.php">
                    <button type="button">Add Another Nominee</button>
                </a>
                <a >
                    <button type="button"><a href="home.php">Back</a></button>
                </a>
            </div>  
        </form>
    </div>
    <script src="pass.js"></script>
</body>
</html