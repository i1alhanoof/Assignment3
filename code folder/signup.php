<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Assignment #3 (signup)</title>
</head>
<body class="signup-page">
<?php
session_start();

$usernameError = "";
$emailError = "";
$passwordError = "";
$rememberMe = false;
$isValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username-text"];
    $email = $_POST["email-text"];
    $password = $_POST["password-text"];

	// for username validation
    if (empty($username)) {
        $usernameError = "Username is required.";
        $isValid = false;
    } else if (!preg_match("/^[a-zA-Z]*[0-9]*$/", $username)) {
        $usernameError = "Username can contain only letters and numbers.";
        $isValid = false;
    } else if (strlen($username) < 8) {
        $usernameError = "Username must be at least 8 characters long.";
        $isValid = false;
    }

	// for email validation
    if (empty($email)) {
        $emailError = "Email is required.";
        $isValid = false;
    } else if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $emailError = "Email is not in valid format.";
        $isValid = false;
    }

	// for password validation
    if (empty($password)) {
        $passwordError = "Password is required.";
        $isValid = false;
    } else if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/", $password)) {
        $passwordError = "Password must contain at least 1 letter, 1 number, and 1 special character.";
        $isValid = false;
    } else if (strlen($password) < 8) {
        $passwordError = "Password must be at least 8 characters long.";
        $isValid = false;
    }

	// for check if remember me checkbox is checked
    if (isset($_POST['rememberCheck'])) {
        $rememberMe = true;
    }

	// if validation passed
    if ($isValid == true) {
        // to store form data in session variables
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        // set cookies when remember me checkbox is checked
        if ($rememberMe) {
            setcookie('username', $username, time() + (86400 * 30), "/");
            setcookie('email', $email, time() + (86400 * 30), "/");
            setcookie('password', $password, time() + (86400 * 30), "/");
            setcookie('rememberMe', $rememberMe, time() + (86400 * 30), "/");
        } else {
			// clear cookies when remember me checkbox is not checked for new regestration
            setcookie('username', '', time() - 3600, "/");
            setcookie('email', '', time() - 3600, "/");
            setcookie('password', '', time() - 3600, "/");
            setcookie('rememberMe', '', time() - 3600, "/");
        }

        header('Location: welcome.php');
        exit;
    }
}
?>
	 <div class="form-container">
        <form action="signup.php" method="post">
			<div class="fill-section">
          		<label for="username-text">Username <span class="required-star"> *</span> </label>
            	<input type="text" id="username-text" name="username-text">
				<span class="error-message"><?php echo $usernameError; ?></span>
            </div>
			<div class="fill-section">
            	<label for="email-text">E-mail <span class="required-star"> *</span> </label>
            	<input type="text" id="email-text" name="email-text">
				<span class="error-message"><?php echo $emailError; ?></span>
            </div>
			<div class="fill-section">
            	<label for="password-text">Password <span class="required-star"> *</span> </label>
            	<input type="password" id="password-text" name="password-text">
				<span class="error-message"><?php echo $passwordError; ?></span>
            </div>
			<div class="submit-section">
            	<input type="submit" value="SIGN UP">
			</div>
			<div class="remember-section">
				<input type="checkbox" name="rememberCheck">
				<label for="rememberCheck">Remember me</label>
				<a href="">Forgot password?</a>
			</div>
        </form>
    </div>
</body>
</html>