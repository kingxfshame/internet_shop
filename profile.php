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
    <div>
        <div>
            <img class="responsive-img" src="images/avatars/<?php echo $img ?>" alt="profile_image">
        </div>
        <div>
            <div>
                <div>
                    <h3></h3>
                    <h3></h3>
                    <input type="text">
                    <input type="text">
                </div>
            </div>
            <div>
                <h3></h3>
                <div>
                </div>
                <h3></h3>
            </div>
        </div>
    </div>
    <?php 
        endwhile;
    ?>
    <?php require('php/footer.php') ?>
</body>

</html>