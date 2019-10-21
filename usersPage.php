<?php 
session_start();
/* $user_name = $_SESSION['username']; */

require('php/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('php/head_links.php') ?>
    <title>Qwerty Multihack - Users</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    
    <ul id="slide-out" class="sidenav sidenav-fixed">
    <li><a href="admin.php">Main</a></li>
      <li><a href="productsPage.php">Products</a></li>
      <li><a href="usersPage.php">Users</a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>

    <table class="container responsive-table highlight centered admin_users_table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Products</th>
            </tr>
        </thead>
        <?php 
            $connect=$sql_connection->prepare("SELECT id, email, username,img FROM users");
            $connect->bind_result($id, $email, $username,$img);
            $connect->execute();
            while($connect ->fetch()):
        ?>
        <tbody>
            <tr>
                <td><?php echo $username ?></td>
                <td><?php echo $email ?></td>
                <td>$0.87</td>
            </tr>
        </tbody>
        <?php 
            endwhile;
        ?>
    </table>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/jquery.event.move.js" type="text/javascript"></script>
    <script src="js/jquery.twentytwenty.js" type="text/javascript"></script>
    <script src="js/script.js"></script>
    <script>
    $(document).ready(function() {
        $('.sidenav').sidenav();
        $('.parallax').parallax();
    });
    $("#container1").twentytwenty({
      before_label: 'WithOut',
      after_label: 'With',
      no_overlay: true,
    });
    </script>
</body>
</html>