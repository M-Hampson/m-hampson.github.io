<?php
use Edu\Ccp\Cis244\User;

// over writing session data when we land on this page
$_SESSION = [];

// we check the status of the session and if there is an active session
// we destroy it
if (session_status() === PHP_SESSION_ACTIVE){
    session_destroy();

}
// we access the cookie, set it to an empty string, 
// erase all user data since yesterday '-86400' seconds
// '/' represents any pages across the root domain
setcookie(session_name(), '', time() -86400, '/' );

header('Location: login.php');
die;
?>