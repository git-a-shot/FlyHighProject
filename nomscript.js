const relationships = [
    'Spouse','Domestic Partner', 'Children', 'Mother', 'Father', 'Mother-in-law', 'Father-in-law', 'Grand Mother',
    'Grand Father', 'Grand Children', 'Daughter-in-law', 'Son-in-law', 'Brother', 'Sister','Adoptive Family',
    'Brother-in-law', 'Sister-in-law','Siblings','Siblings Spouse','Siblings Children','Step Brother','Step Sister','Step Children',' Stepfather','Stepmother',''
];
const relationshipInput = document.getElementById('relationshipInput');
const relationOptions = document.getElementById('relationOptions');
relationships.forEach(relationship => {
    const option = document.createElement('option');
    option.value = relationship;
    relationOptions.appendChild(option);
});
relationshipInput.addEventListener('input', function () {
    const inputText = this.value;
    const filteredRelationships = relationships.filter(relationship => relationship.toLowerCase().startsWith(inputText.toLowerCase()));
    populateRelationshipOptions(filteredRelationships);
});
function populateRelationshipOptions(filteredRelationships) {
    relationOptions.innerHTML = '';
    filteredRelationships.forEach(relationship => {
        const option = document.createElement('option');
        option.value = relationship;
        relationOptions.appendChild(option);
    });
}


function validateInput(fieldName) {
    var input = document.getElementById(fieldName);
    var errorDiv = document.getElementById(fieldName + 'Error');
    var nameRegex = /^[A-Za-z\s]+$/;
    input.value = input.value.replace(/[^A-Za-z\s]/g, '');
    if (!nameRegex.test(input.value)) {
        errorDiv.innerHTML = 'Only alphabets and spaces are allowed';
    } else {
        errorDiv.innerHTML = '';
    }
}function validateContactNo() {
    var input = document.getElementById("contactNo");
    var messagesElement = document.getElementById('contactNoError');
    input.value = input.value.replace(/\D/g, '');
    messagesElement.innerText = "";
    if (input.value === "") {
        messagesElement.innerText = "Please fill in the mobile number";
    } else if (!/[6-9]/.test(input.value.charAt(0))) {
        messagesElement.innerText = "Mobile number must start with 9, 8, 7, or 6";
        input.value = input.value.slice(0, 1); // Remove the first character
    } else if (input.value.length < 10) {
        messagesElement.innerText = "Mobile number cannot be less than 10 digits";
    } else if (input.value.length > 10) {
        messagesElement.innerText = "Mobile number cannot be greater than 10 digits";
        input.value = input.value.slice(0, 10);
    }
}   
//automatic age 
function validateDate() {
    var dobInput = document.getElementById('dateOfBirth');
    var dateError = document.getElementById('dateError');
    var ageInput = document.getElementById('age');
    if (dobInput.value) {
        var currentDate = new Date();
        var enteredDate = new Date(dobInput.value);
        if (enteredDate > currentDate) {
            dateError.innerHTML = 'Invalid date (future date)';
            ageInput.value = ''; 
        } else {
            dateError.innerHTML = '';
            calculateAge();
        }
    } else {
        dateError.innerHTML = 'Please enter a date of birth';
        ageInput.value = ''; 
    }
}
function calculateAge() {
    var dobInput = document.getElementById('dateOfBirth');
    var ageInput = document.getElementById('age');
    var birthDateObj = new Date(dobInput.value);
    var currentDate = new Date();
    var age = currentDate.getFullYear() - birthDateObj.getFullYear();
    if (currentDate.getMonth() < birthDateObj.getMonth() || (currentDate.getMonth() === birthDateObj.getMonth() && currentDate.getDate() < birthDateObj.getDate())) {
        age--; }
    ageInput.value = age;
}
//filteration of gender
function filterOptions() {
    var input = document.getElementById('gender');
    var inputValue = input.value.toLowerCase();
    for (var i = 0; i < input.options.length; i++) {
        var optionText = input.options[i].text.toLowerCase();
        if (optionText.includes(inputValue)) {
            input.selectedIndex = i;
            break;
        }
    }
}
//email2try
function myfun(){
    var emailcheck = document.getElementById('emailID').value;
    var pattern = /^[A-Za-z._]{3,}@[A_Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
    if(pattern.test(emailcheck)){
        document.getElementById('showmsg').innerHTML = 'email is valid';
    }else{
        document.getElementById('showmsg').innerHTML = 'email is not valid';
        return false;
    }
}
// aadhaar
function formatAadharNumber() {
    var aadharInput = document.getElementById('aadhaarNo');
    var inputValue = aadharInput.value.replace(/[^\d]/g, ''); 
    var formattedValue = inputValue.replace(/(\d{4})/g, '$1 ');
    aadharInput.value = formattedValue.trim(); // Remove trailing space
}
function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}
var employeeId = getQueryParam('employeeId');
var firstName = document.getElementById('firstName').value; 
var lastFourChars = firstName.slice(-4);
var nomineeID = employeeId + lastFourChars;
document.getElementById('nomineeID').value = nomineeID;
//class of travel for editing employee details in editEmpNom
function updateClassOfTravel() {
    var gradeInput = document.getElementById("empGrade");
    var grade = parseInt(gradeInput.value);
    if (grade >= 1 && grade <= 12) {
        document.getElementById("error").value = "";
        if (grade >= 1 && grade <= 3) {
            document.getElementById("classOfTravel").value = "Business";
        } else {
            document.getElementById("classOfTravel").value = "Economy";
        }
    } else {
        document.getElementById("error").value = "Please enter a grade between 1 and 12.";
        document.getElementById("classOfTravel").value = "";
        gradeInput.value = "";
    }
}
function restrictInput() {
    var gradeInput = document.getElementById("empGrade");
    var grade = parseInt(gradeInput.value);
    if (grade < 1 || grade > 12) {
        gradeInput.value = "";
    }
}

/*function validateDate() {
    var selectedDate = new Date(document.getElementById("dateOfBirth").value);
    var currentDate = new Date();

    // Check if the selected date is a future date
    if (selectedDate > currentDate) {
        document.getElementById("dateError").innerHTML = "Please select a date that is not in the future.";
        return false; // Prevent form submission
    } else {
        document.getElementById("dateError").innerHTML = "";
        return true; // Allow form submission
    }
}*/
function validateDate() {
    var dobInput = document.getElementById('dateOfBirth');
    var dateError = document.getElementById('dateError');
    var ageInput = document.getElementById('age');
    if (dobInput.value) {
        var currentDate = new Date();
        var enteredDate = new Date(dobInput.value);
        if (enteredDate > currentDate) {
            dateError.innerHTML = 'Invalid date (future date)';
            ageInput.value = ''; 
            return false;
        } else {
            dateError.innerHTML = '';
            calculateAge();
            return true;
        }
    } else {
        dateError.innerHTML = 'Please enter a date of birth';
        ageInput.value = ''; 
    }
}