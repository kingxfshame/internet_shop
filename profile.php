<?php 
session_start();
$user_name = $_SESSION['username'];
$user_id = 0;
if(empty($_SESSION['user_id'])) $user_id = 0;
else $user_id = $_SESSION['user_id'];
require('php/database.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // paroli sovpadayt
        if($_POST['password'] == $_POST['password2']){
            $password = md5($_POST['password']);
        
                $sql = "UPDATE users set password = '$password' WHERE id='$user_id'";
                if($sql_connection ->query($sql) === true){
                    $_SESSION['message'] = 'Password Changed!';
                    header("location: profile");
                }
                else{
                    $_SESSION['message'] = "Connection Failed";
                } 
    }
    else{
        $_SESSION['message'] = "Passwords do not match";
    }
}
else{
}
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
                <input class="file-upload" type="file" accept="image/*" />
            </div>
            <div class="profile_data">
                <div class="profile_data_">
                    <h6>Username:
                        <?= $_SESSION['username'] ?>
                    </h6>
                    <h6>Email:
                        <?php echo $email ?>
                    </h6>
                    <form id="task-form" class="form" action="profile" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="profile_input">
                            <input placeholder="New password" type="password" id="password" name="password" required>
                            <input placeholder="Repeat new password" type="password" id="password2" name="password2" required>
                        </div>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                            <i class="material-icons right">send</i>
                        </button>
                    </form>
                </div>
            </div>
            <h3 style="margin-top:-40px; margin-left:93px; font-size: 20px;"><a href="php/logout">Log out</a></h3>
        </div>
        <div class="profile_line"></div>
        <?php 
        endwhile;
        $sql_userid_check = "SELECT * FROM soft WHERE user_id ='$user_id'";
        $res_u = $sql_connection -> query($sql_userid_check) or die (mysqli_error($sql_connection));
        if(mysqli_num_rows($res_u) > 0 ){
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
                    <h5 class="profile_product_title">
                        <?php echo $products_name; ?> - Qwerty</h5>
                    <div> <img class="profile_product_img" src="images/products/<?php echo $products_image; ?>" /> </div>
                    <div>
                        <h6 class="profile_product_status col s12">Status:
                            <?php echo $status; ?>
                        </h6>
                        <p class="profile_product_date2 col s12">
                            <?php echo $date_buy.' - '. $data_end;?>
                        </p>
                        <p class="profile_product_date col s12">
                            <?php 
                        echo floor((strtotime($data_end) - strtotime($date_buy)) / (60*60*24) );
                        
                        ?> days</p>
                    </div>
                    <?php 
                    ?>
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
    }
        
        
        else{
            ?>
        <div class="col s12">
            <h1 style="text-align:center;">You have no purchased items</h1>
        </div>
        <?php
        }
            ?>
    </div>
    <?php require('php/footer.php') ?>
</body>

</html>