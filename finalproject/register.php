<?php

// register.php
use Edu\Ccp\Cis244\User;
require_once('User.php');
require_once('functions.php');
session_start();

$errorMessages = [];

if (userIsLoggedIn()) {
    header('Location: index.php');
    die;
}

// error handling & verification
if (isset($_POST['register'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordVerify = $_POST['password-verify'] ?? '';

    if (!User::usernameIsAvailable($username)){
        $errorMessages[]= 'Username is taken';
    }
    if ($password !== $passwordVerify){
        $errorMessages[]= 'Passwords don\'t match';
    }

    if (count($errorMessages) === 0){
        User::createUser($username, $password);
        $user = User::getUserByLoginCredentials($username,$password);
        // the session global essentially logs them in
        $_SESSION['user_id'] = $user->getId();
        header('Location: login.php');
        die;

    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.typekit.net/rma2cmu.css">
    <link href="style.css" rel=stylesheet>
    <title>Sign Up</title>
</head>
<body>
    <h1>Register</h1>
    <?php foreach ($errorMessages as $error): ?>
    <h2> <?php print $error?></h2>
    <?php endforeach;?>
    <form method="POST">
        <div>
            <label for="username">Username</label>
            <br>
            <input id="username" name="username" required>
       
            <label for="password">Password</label>
            <br>
            <input type="password" id="password" name="password" required>
       
            <label for="password-verify">Password Verification</label>
            <br>
            <input type="password" id="password-verify" name="password-verify" required>
        </div>
        <div>
            <input type="submit" id="register" name="register" value="Register new user">
        </div>
    </form>
    <p><a href="index.php">Home</a></p>
</body>
</html>
