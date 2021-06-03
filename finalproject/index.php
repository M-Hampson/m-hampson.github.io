<?php
use Edu\Ccp\Cis244\User;
use Edu\Ccp\Cis244\Review;
require_once('User.php');
require_once('Review.php');
require_once('functions.php');
session_start();

// if user lands on index page and are not logged in, they can read views but not add a new review
$message=NULL;
if (userIsLoggedIn()) {
    $user = User::getUserById($_SESSION['user_id']);
    $message = h($user->getUsername());
    $reviewHide= '';
} else {
    $message = ', to write a review log in or sign up';
    $reviewHide = '<style>.review {display:none;}</style>';

}

// create review
if (isset($_POST['content'])){
    $username = $user->getUsername();
    $title = $_POST['title'];
    $content = $_POST['content'];
    $rating = $_POST['rating'];
    Review::createReview($username,$title,$content,$rating);
}
if (isset($_POST['post'])){
    header('Location: index.php');
}

// sorting dropdown logic 

if(!isset($_GET['sorted']) || ($_GET['sorted']==="Newest")){
    $reviews = Review::returnReview();
    $reviewMessage = htmlentities('Currently sorted by Latest Review', ENT_QUOTES);
}else if ($_GET['sorted'] === "Highest"){
    $reviews = Review::highestReview();
    $reviewMessage = htmlentities('Currently sorted by Highest Rated Review', ENT_QUOTES);
}else if ($_GET['sorted'] === "Lowest"){
    $reviews = Review::lowestReview();
    $reviewMessage = htmlentities('Currently sorted by Lowest Rated Review', ENT_QUOTES);
}else if ($_GET['sorted'] === "Oldest"){
    $reviews = Review::oldestReview();
    $reviewMessage = htmlentities('Currently sorted by Oldest Review', ENT_QUOTES);

}

// test username:t  password:1

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.typekit.net/rma2cmu.css">
    <link href="style.css" rel=stylesheet>
    <?php print $reviewHide?>
    <title>Good Sounds</title>
</head>
<body>

<h1>Good Sounds</h1>

<p class="small"><i>Welcome <?php print $message?></i></p>
<nav class="menu">
    <ul>
    <li class="menuitem"><a href="login.php">Log In</a></li>
    <li class="menuitem"><a href="register.php">Create New User</a></li>
    <li class="menuitem"><a href= "logout.php">Log Out</a></li>
    </ul>
        
   <!-- sort reviews -->
    <form method="GET" action="#" id="sort">
        <select name="sorted" id="sorted">
            <option selected disabled hidden>Select</option>
            <option>Newest</option>
            <option>Oldest</option>
            <option>Highest</option>
            <option>Lowest</option>
        </select><br>
        <input class="sort" type="submit" value="Sort" name="Sort">
    </form>
</nav>

    <!-- form to create new review -->
    <div class="review">
        <form method="POST" action=#>
            <div class="medium">Write A Review</div>
                <label for="title" class="floatLeft">Title:</label><br>
                <input required id="title" name="title"><br>
                <label for="content" class="floatLeft">Review:</label><br>
                <textarea required id="content" name="content"></textarea><br>

                <!-- use of JS on range slider, referenced -->
                <!-- https://stackoverflow.com/questions/10004723/html5-input-type-range-show-range-value -->
                <input type="range" name="amountRange" min="0" max="10" step =".1" value="0" oninput="this.form.rating.value=this.value" />
                <input class= "output" type="number" name="rating" min="0" max="10" step= ".1" value="0" oninput="this.form.amountRange.value=this.value" />
                <input type="submit" name="post" value="Post Review">
        </form>
    </div>
    
    <!-- list of reviews -->
    <div class="reviewBox"><?php print $reviewMessage?></div>
    <?php foreach($reviews as $review): ?>
        <div class = "reviewBox">
            <label>Written by:</label><br>
            <p><?php print htmlentities($review['username'], ENT_QUOTES);?></p>

            <label>Title:</label><br> 
            <p><?php print htmlentities($review['title'], ENT_QUOTES); ?></p>

            <label>Review:</label><br> 
            <p><?php print htmlentities($review['content'], ENT_QUOTES);?></p>

            <label>Rating:</label><br>  
            <p><?php print htmlentities($review['rating'], ENT_QUOTES);?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
    
