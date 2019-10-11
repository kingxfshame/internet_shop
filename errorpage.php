<?php 
session_start();
require('php/database.php');
$username = $_SESSION['username'] ;
$game_id = $_SESSION['game_id'] ;
$days = $_SESSION['buy_days'] ;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php require('php/head_links.php') ?>
    <link rel="stylesheet" href="css/register.css"/>
    <title>Qwerty Multihack - Order</title>
</head>
<body>
<?php require('php/navbar.php') ?>
<div class="container">
    <div class="row">
                <div class="error">
                    <i class="medium material-icons" style="font-size: 450px;">mood_bad</i>
                    <h1 class="errortitle">404</h1>
                </div>


    </div>
</div>
<?php require('php/footer.php') ?>
</body>
</html>