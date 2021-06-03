<?php

// this function compares two booleans, ternary
function userIsLoggedIn(){
    return isset($_SESSION['user_id']) && ((int) $_SESSION['user_id']) > 0;
}
// return the html encoded values
function h($value){
    return htmlentities($value);
}

?>