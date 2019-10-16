<?php 
session_start();
require('php/database.php');
$username = $_SESSION['username'] ;
$user_id = 0;
    if(empty($_SESSION['user_id'])) $user_id = 0;
    else $user_id = $_SESSION['user_id'];

$game_id = $_SESSION['game_id'] ;
$days = $_SESSION['buy_days'] ;
if($game_id == null || $days == null){
    header('location: errorpage');
}
$currentdate = date("Y-m-d");
$timework = date("Y-m-d",strtotime($currentdate. '+ '.$days.' days'));

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql_userid_check = "SELECT * FROM soft WHERE user_id ='$user_id'";
    $sql_gamecheck = "SELECT * FROM soft WHERE products_id ='$game_id'";
    $res_u = $sql_connection -> query($sql_userid_check) or die ($sql_connection -> error());
    $res_e = $sql_connection -> query($sql_gamecheck) or die ($sql_connection -> error());

        if(mysqli_num_rows($res_u) > 0 && $res_e > 0){

        }
        else{
            $sql = "INSERT INTO soft(user_id,products_id,date_buy,date_end,status) VALUES('$user_id','$game_id','$currentdate','$timework', 'Active')";
            if($sql_connection ->query($sql) === true){

                header("location: profile");
            }
        }
    }

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
                            <form id="task-form" class="form" action="orderconfirm" method="post" enctype="multipart/form-data" autocomplete="off">
                                <a href="#" onclick="document.getElementById('task-form').submit();">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                                Purchase Now!
                                </a>
                            </form>
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