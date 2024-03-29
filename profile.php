<?php 
session_start();
$user_name = $_SESSION['username'];
$user_id = $_SESSION['user_id'];


require('php/database.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // paroli sovpadayt
    if($_POST['password'] == null || $_POST['password2'] == null){

        $avatar_path = $sql_connection ->real_escape_string('images/avatars/'.$_FILES['avatar']['name']);
        print_r($_FILES);
        if(preg_match("!image!", $_FILES['avatar']['type'])){
            if(copy($_FILES['avatar']['tmp_name'],$avatar_path)){
                $sql = "UPDATE users set img = '$avatar_path' WHERE id='$user_id'";
                if($sql_connection ->query($sql) === true){
                    $_SESSION['message'] = 'Avatar Changed!';
                    header("location: profile");
                }
            }
        }
    }
    else{



        if($_POST['password'] == $_POST['password2']){
            $password = $_POST['password'];
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $_SESSION['message'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number.';
        }
        else{
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
        
    }
    else{
        $_SESSION['message'] = "Passwords do not match";
    }
}
    }

else{
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('php/head_links.php') ?>
    <title>Qwerty Multihack - Profile</title>
</head>

<body>
    <?php require('php/navbar.php') ?>
    <?php 
            $connect=$sql_connection->prepare("SELECT id, email, username,img FROM users WHERE username='$user_name'");
            $connect->bind_result($id, $email, $usernamee,$img);
            $connect->execute();
            while($connect ->fetch()):
            
    ?>
    <form id="task-form" class="form" action="profile" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="row container profile_content">
        <div class="profile_top">
            <div class="profile_img">
                <img class="profile-pic" src="<?php echo $img ?>" alt="profile_image">
                <div class="upload-button">
                    <i class="fas fa-arrow-circle-up" aria-hidden="true"></i>
                </div>
                <div class="avatar"><input name="avatar" class="file-upload" type="file" accept="images/avatars/*" /></div>
            </div>
            <div class="profile_data">
                <div class="profile_data_">
                    <h6>Username: <?= $_SESSION['username'] ?></h6>
                    <h6>Email: <?php echo $email ?></h6>

                            <div class="profile_input">
                                <input placeholder="New password" type="password" id="password" name="password" >
                                <input placeholder="Repeat new password" type="password" id="password2" name="password2" >
                            </div>
                            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>

                    </form>
                </div>
            </div>
            <h3 style="margin-top:-40px; margin-left:93px; font-size: 20px;"><a href="php/logout">Log out</a></h3>
            <?php 
            if($_SESSION['role'] == "admin"){
                echo "<h3 style='margin-top:-40px; margin-left:400px; font-size: 20px;'><a href='admin?x=allproducts'>Admin</a></h3>";
            }
            ?>


            
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
            $current = strtotime(date("Y-m-d"));
            $datediff = strtotime($data_end) - $current ;
            $difference = floor($datediff/(60*60*24));
            
            if($difference < -1) {
                ?>
                <div class="profile_products col s4">
                <a class="modal-trigger profile_product_negative" href="products">
                <div class="">
                    <h5 class="profile_product_title">
                        <?php echo $products_name; ?> - Qwerty</h5>
                    <div> <img class="profile_product_img" src="images/products/<?php echo $products_image; ?>" /> </div>
                    <div>
                        <h6 class="profile_product_status col s12">Status:
                            Not Active
                        </h6>
                        <p class="profile_product_date2 col s12">
                            <?php echo $date_buy.' - '. $data_end;?>
                        </p>
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
            }
            else{
            
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
                        echo floor((strtotime($data_end) - $current) / (60*60*24) );
                        
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
        }
        endwhile;
    }
        
        
        else{
            ?>
        <div class="col s12">
            <h4 style="text-align:center;">You have no purchased items</h4>
        </div>
        <?php
        }
            ?>
    </div>
    <div class="page-footer-down-fix">
        <?php require('php/footer.php') ?>
    </div>
    <script>
    
        M.toast({html: '<?php echo $_SESSION['message'] ?>', classes: 'rounded'});
                                 
    </script>
    <?php
    $_SESSION['message'] == "";
    ?>
</body>

</html>