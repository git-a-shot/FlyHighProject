function validatePassportNumber() {
    var passportNumberInput = document.getElementById('passNumber');
    var passportNumberError = document.getElementById('passNumberError');
    var validFormat = /^[A-Za-z]\d{7}$/;
    if (!validFormat.test(passportNumberInput.value)) {
        passportNumberError.innerHTML = 'The passport number should start with a letter, followed by 7 numbers.';
    } else {
        passportNumberInput.value = passportNumberInput.value.charAt(0).toUpperCase() + passportNumberInput.value.slice(1);
        passportNumberError.innerHTML = '';
    }
}
//name validation
function validateInput(fieldName) {
    var input = document.getElementById(fieldName);
    var errorDiv = document.getElementById(fieldName + 'Error');
    var nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(input.value)) {
        errorDiv.innerHTML = 'Only alphabets and spaces are allowed';
    } else {
        errorDiv.innerHTML = '';
    }
}
//date
function validateDate() {
    var dateOfBirthInput = document.getElementById('dateOfBirth');
    var dateOfBirthError = document.getElementById('dateOfBirthError');
    var selectedDate = new Date(dateOfBirthInput.value);
    var currentDate = new Date();
    if (selectedDate > currentDate) {
        dateOfBirthError.innerHTML = 'Invalid date (future date)';
    } else {
        dateOfBirthError.innerHTML = '';
    }
}
//issue date
function validateDateOfIssue() {
    var dateOfBirthInput = document.getElementById('dateOfBirth');
    var dateOfIssueInput = document.getElementById('dateOfIssue');
    var dateOfIssueError = document.getElementById('dateOfIssueError');
    var dateOfBirth = new Date(dateOfBirthInput.value);
    var dateOfIssue = new Date(dateOfIssueInput.value);
    if (dateOfIssue <= dateOfBirth) {
        dateOfIssueError.innerHTML = 'Issue date must be after the birth date';
    } else {
        dateOfIssueError.innerHTML = '';
    }
}
//Expiry validation
function validateDateOfExpiry() {
    var dateOfIssueInput = document.getElementById('dateOfIssue');
    var dateOfExpiryInput = document.getElementById('dateOfExpiry');
    var dateOfExpiryError = document.getElementById('dateOfExpiryError');
    var dateOfIssue = new Date(dateOfIssueInput.value);
    var maxExpiryDate;
    var passportType = document.getElementById('passportType').value; 
    if (passportType === 'adult') {
        maxExpiryDate = new Date(dateOfIssue);
        maxExpiryDate.setFullYear(maxExpiryDate.getFullYear() + 10);
    } else if (passportType === 'minor') {
        maxExpiryDate = new Date(dateOfIssue);
        maxExpiryDate.setFullYear(maxExpiryDate.getFullYear() + 5);
    } else {
        dateOfExpiryError.innerHTML = 'Invalid passport type';
        return;
    }
    maxExpiryDate.setDate(maxExpiryDate.getDate() - 1);
    dateOfExpiryInput.value = formatDate(maxExpiryDate);
    if (maxExpiryDate <= dateOfIssue) {
        dateOfExpiryError.innerHTML = 'Expiry date must be valid based on passport type';
    } else {
        dateOfExpiryError.innerHTML = '';
    }
}
function formatDate(date) {
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var day = ('0' + date.getDate()).slice(-2);
    return year + '-' + month + '-' + day;
}
//Expiry date automatically displayed
function calculateExpiryDate() {
    validateDateOfIssue();
    var passportType = document.getElementById("passportType").value;
    var dateOfIssue = new Date(document.getElementById("dateOfIssue").value);
    var dateOfExpiry = new Date(dateOfIssue);
    if (passportType === "adult") {
        dateOfExpiry.setFullYear(dateOfExpiry.getFullYear() + 10);
    } else if (passportType === "minor") {
        dateOfExpiry.setFullYear(dateOfExpiry.getFullYear() + 5);
    }
    dateOfExpiry.setDate(dateOfExpiry.getDate() - 1);
    var formattedDate = dateOfExpiry.toISOString().slice(0, 10);
    document.getElementById("dateOfExpiry").value = formattedDate;
}