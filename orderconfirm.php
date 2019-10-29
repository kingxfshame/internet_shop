<?php 
session_start();
require('php/database.php');
$username = $_SESSION['username'] ;
$user_id = $_SESSION['user_id'];
$game_id = $_SESSION['game_id'] ;
$days = $_SESSION['buy_days'] ;
if($game_id == null || $days == null){
    header('location: errorpage');
}
$currentdate = date("Y-m-d");
$timework = date("Y-m-d",strtotime($currentdate. '+ '.$days.' days'));

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql_userid_check = "SELECT * FROM soft WHERE user_id ='$user_id' AND products_id ='$game_id'";

    $res_u = $sql_connection -> query($sql_userid_check) or die (mysqli_error($sql_connection));

        if(mysqli_num_rows($res_u) > 0){
            $sql=$sql_connection->prepare("SELECT id,user_id,products_id,date_buy,date_end,status FROM soft WHERE user_id ='$user_id' AND products_id ='$game_id'");
            $sql->bind_result($idsoft, $usersid, $productid,$datebuy,$dateend,$statuss);
            $sql->execute();
            while($sql -> fetch()):
                    $current = strtotime(date("Y-m-d"));
                    $datediff = strtotime($dateend) - $current ;
                    $difference = floor($datediff/(60*60*24));


                if($difference < -1) { 
                    $sql = "UPDATE soft set date_buy ='$currentdate' , date_end = '$timework' WHERE user_id = '$user_id' and products_id = '$game_id'";
                    if($sql_connection ->query($sql) === true){
                        header("location: profile");
                        
                    }
                }
                else{
                    $dateupdate = date('Y-m-d', strtotime($dateend. ' + '.$days.' days'));
                    $sql = "UPDATE soft set date_end = '$dateupdate' WHERE user_id='$user_id' AND products_id = '$game_id'";
                    if($sql_connection ->query($sql) === true){
                        header("location: profile");
                    }
                }

            endwhile;
            


            
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
                                <img class="responsive-img" src="images/products/<?php echo $img ?>" alt="profile_image" style="height:25vh; width:20vw;">
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