<?php 
session_start();
require('php/database.php');
$username = $_SESSION['username'] ;
$game_id = $_SESSION['game_id'] ;
$days = $_SESSION['buy_days'] ;
if($game_id == null || $days == null){
    header('location: errorpage');
}
$currentdate = date("Y-m-d");
$timework = date("Y-m-d",strtotime($currentdate. '+ '.$days.' days'));

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
                <?php
                $sql=$sql_connection->prepare("SELECT id,product_name,price,img,short_description,description,support FROM products WHERE id='$game_id'");
                $sql->bind_result($id, $product_name, $price,$img,$short_description,$description,$support);
                $sql->execute();
                while($sql -> fetch()):
                ?>
                <div class="section">
                    <div class="row container">
                        <div class="content">
                            <div class="content_title">
                                <h1>Confirm order</h1>
                            </div>
                            <div class="content_img col">
                                <img class="responsive-img" src="images/products/<?php echo $img ?>" alt="profile_image" style="height:40vh;">
                            </div>

                            <div class="content_content">
                                <h4>Purchase information</h4>
                                <br>
                                <h5>Subscription time: <?= $days?></h5>
                                <h5><?php echo 'Active: '.$currentdate.' - '. $timework?></h5>
                                <br>
                                <h5><?php echo 'Price for '.$days.' days: '.$price * $days .' €'?></h5>
                            </div>
                            <div class="content_buy">
                                <a href="#">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Purchase Now!
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                
              <?php
            endwhile;
        
        ?>
    </div>
</div>
<?php require('php/footer.php') ?>
</body>
</html>