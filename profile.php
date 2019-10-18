<?php 
session_start();
$user_name = $_SESSION['username'];
$user_id = 0;
if(empty($_SESSION['user_id'])) $user_id = 0;
else $user_id = $_SESSION['user_id'];

require('php/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('php/head_links.php') ?>
    <title>Qwerty Multihack - Login</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    <?php 
            $connect=$sql_connection->prepare("SELECT id, email, username,img FROM users WHERE username='$user_name'");
            $connect->bind_result($id, $email, $usernamee,$img);
            $connect->execute();
            while($connect ->fetch()):
            
    ?>
    <div class="row container profile_content">
        <div class="profile_top">
            <div class="profile_img">
                <img class="profile-pic" src="images/avatars/<?php echo $img ?>" alt="profile_image">
                <div class="upload-button">
                    <i class="fas fa-arrow-circle-up" aria-hidden="true"></i>
                </div>
                <input class="file-upload" type="file" accept="image/*"/>
            </div>
            <div class="profile_data">
                <div class="profile_data_">
                    <h6><?= $_SESSION['username'] ?></h6>
                    <h6><?php echo $email ?></h6>
                    <div class="profile_input">
                        <input placeholder="New password" type="text" id="password" name="password" required>
                        <input placeholder="Repeat new password" type="text" id="password2" name="password2" required>
                    </div>
                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
        <div class="profile_line"></div>
        <?php 
        endwhile;
            $connect=$sql_connection->prepare("SELECT soft.id, soft.user_id, soft.products_id,soft.date_buy,soft.date_end,soft.status,soft.banned,
            soft.banned_description,soft.ssd,products.id,products.product_name,products.img FROM soft,products 
            WHERE soft.user_id='$user_id' AND soft.products_id = products.id");
            $connect->bind_result($id, $user_id_second, $products_id,$date_buy,$data_end,$status,$banned,$banned_description,$ssd,$products_id,$products_name,$products_image);
            $connect->execute();
            while($connect ->fetch()):
            
    ?>
        <div class="profile_products col s4">
            <a class="modal-trigger profile_product" href="#modal1">
                <div class="">
                    <h5 class="profile_product_title"><?php echo $products_name; ?> -  Qwerty</h5>
                    <div> <img class="profile_product_img" src="images/products/<?php echo $products_image; ?>"/> </div>
                    <div>
                        <h6 class="profile_product_status">Status: <?php echo $status; ?></h6>
                    </div>
                    <?php 
                    ?>
                    <div class="profile_product_dates">
                        <p class="profile_product_date col s6"><?php echo date('d',(strtotime($data_end) - strtotime($date_buy)));?> days</p>
                        <p class="profile_product_date2 col s6"><?php echo $date_buy.' - '. $data_end;?></p>
                    </div>
                </div>
            </a>
            
            <div id="modal1" class="modal">
                <div class="modal-content">
                    
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
        ?>
    </div>

    <?php require('php/footer.php') ?>
</body>
</html>