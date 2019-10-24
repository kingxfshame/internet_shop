<?php 
session_start();
$_SESSION['message'] = '';
require('php/database.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // paroli sovpadayt
        $email = $sql_connection ->real_escape_string($_POST['email']);
        $password = md5($_POST['password']);
        $sql_username = "SELECT * FROM users WHERE username ='$email' AND password ='$password'";
        $sql_email = "SELECT * FROM users WHERE email ='$email' AND password ='$password'";
        
        $res_u = $sql_connection -> query($sql_username) or die ($sql_connection -> error());
        $res_e = $sql_connection -> query($sql_email) or die ($sql_connection -> error());
        if(mysqli_num_rows($res_u) > 0 || mysqli_num_rows($res_e) > 0){
            $sql=$sql_connection->prepare("SELECT id, email,username,admin_check FROM users WHERE username='$email' OR email ='$email'");
            $sql->bind_result($id, $email, $username,$admin_check);
            $sql->execute();
            while($sql -> fetch()){
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $id;
                if($admin_check == "admin") $_SESSION['role'] = "admin"; 
            }

            header("location: ./");
        }
        else{
            $_SESSION['message'] = "Username / Email or Password wrong";
        }
    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/register.css"/>
    <?php require('php/head_links.php') ?>
    <title>Qwerty Multihack - Login</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
        
    <div class="container">
        <div class="row">
             <div class="col s12"><h2 class="header" style="text-align:center;color:white;">Login</h2></div>
             <div class="col s4" style="margin-left:35%;margin-top:14%;margin-bottom:19.5%;">
                    <div class="card-content">
                        <div class="row">
                            <form id="task-form" class="form" action="login" method="post" enctype="multipart/form-data" autocomplete="off">
                                <?php 
                                    if($_SESSION['message'] == ''){

                                    }
                                    else{
                                        ?>
                                                <div class="alert"><?=$_SESSION['message'] ?></div>
                                        <?php
                                    }
                                ?>

                                
                                <div class="input-field col s12 m12">
                                    <input type="text" id="email" name="email" required>
                                    <label for="email"><i class="material-icons">email</i> Email / Username</label>
                                </div>

                                <div class="input-field col s12 m12">
                                     <input type="password" id="password" name="password" required>
                                    <label for="password"><i class="material-icons">https</i> Password</label>
                                </div>

                                <input type="submit" value="Log in" class="btn">
                            </form>
                        </div>
                    </div>
             
             </div>

        </div>
    
    </div>

    <?php require('php/footer.php') ?>
</body>
</html>