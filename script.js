function changePassword() {
    var newPassword = document.getElementById("newpw").value;
    var confirmPassword = document.getElementById("confirmpw").value;
    if (newPassword !== confirmPassword) {
        alert ("Passwords do not match.");
        return false; 
    } else {
        return true;
    }
}

