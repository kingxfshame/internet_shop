<?php 
session_start();
$user_name = $_SESSION['username'];

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
                <img class="responsive-img profile_img" src="images/avatars/<?php echo $img ?>" alt="profile_image">
            </div>
            <div class="profile_data">
                <div class="profile_data_">
                    <h5>Email</h5>
                    <h5>UserName</h5>
                    <div class="profile_input">
                        <input type="text">
                        <input type="text">
                    </div>
                </div>
            </div>
        </div>
        <?php 
        endwhile;
        ?>
        <div class="profile_products">
            <div>
                <h3></h3>
                <div> <img class="profile_product_img" src="images/products/csgo.jpg"/> </div>
                <h3></h3>
            </div>
        </div>
    </div>
    <?php require('php/footer.php') ?>
</body>
</html>