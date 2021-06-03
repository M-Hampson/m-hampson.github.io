<?php

use Edu\Ccp\Cis244\User;

require_once('User.php');
require_once('functions.php');
session_start();

if(userIsLoggedIn()){
    header('Location: index.php');
    
}

if (isset($_POST['login'])){
    // null coalescing operator, acts as a ternary
    // 'take the post data's username key and store it in
    // username, if it's not set, store an empty string instead
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $user = User::getUserByLoginCredentials($username,$password);
    if($user){
        // getting the user's id off of the user object
        $_SESSION['user_id'] = $user->getId();
        header('Location: index.php');
        die;
    } else {
        $errorMessage='Invalid';
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
    <title>Good Sounds</title>
</head>

<body>
<!-- Log in  -->
<h1>Log In</h1>
    <?php if(isset($errorMessage)): ?>
    <h2><?php print $errorMessage;?></h2>
    <?php endif;?>

    <div class="signUp">
        <form method="POST">
            <label for="username">Username</label>
            <br>
            <input id="username" name="username">
            <label for="password">Password</label>
            <br>
            <input type="password" id="password" name="password">
            <input type="submit" id="login" name="login" value="Log In">
            <p>Not a User? <a href="register.php">Sign Up</a></p>
            <p><a href="index.php">Home</a></p>
            <p>Unregistered users may read reviews but not write them.</p>
        </form>
    </div>
</body>
</html>
