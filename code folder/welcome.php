<?php
session_start();

if (isset($_COOKIE['username']) && isset($_COOKIE['email']) && isset($_COOKIE['password']) && isset($_COOKIE['rememberMe'])) {
    $username = $_COOKIE['username'];
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    if ($_COOKIE['rememberMe']) {
        $rememberMe = 'Checked';
    } else {
        $rememberMe = 'Unchecked';
    }
} else if (isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $rememberMe = 'Unchecked'; // Set to default value if not set in session
} else {
    header('Location: signup.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Assignment #3 (welcome)</title>
</head>
<body class="welcome-page">
    <div class="info-container">
        <h1>Welcome To This Website</h1>
        <table class="table-section">
            <tr>
                <th>Username</th>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo $password; ?></td>
            </tr>
            <tr>
                <th>Remember me?</th>
                <td><?php echo $rememberMe; ?></td>
            </tr>
        </table>
    </div>
</body>
</html>