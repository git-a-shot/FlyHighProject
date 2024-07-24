<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
    <link rel="shortcut icon" href="image\logo.jpeg" type="image/x-icon">
</head>
<body>
    <div class="wrapper">
        <form id="loginForm" method="post" action="logincode.php">
            <h1>Login</h1>
            <?php if(isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="input-box">
                <input type="text" id="employeeId" name="employeeId" placeholder="Username" >
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="empPassword" name="empPassword" placeholder="Password" >
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forgot">
                <label><a  href="admin.php">click here for admin login</a></label>
                <a  href="forgot.html">Forgot Password</a>
            </div>
            <button type="submit" class="btn">Login</button></a>
        </form>
    </div>
</body>
</html>