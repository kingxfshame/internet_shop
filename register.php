<?php 
session_start();
$_SESSION['message'] = '';
require('php/database.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // paroli sovpadayt
    if($_POST['password'] == $_POST['second_password']){
        $password = $_POST['password'];
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            $_SESSION['message'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number.';
        }
        else{
            $username = $sql_connection ->real_escape_string($_POST['username']);
        $email = $sql_connection ->real_escape_string($_POST['email']);
        $password = md5($_POST['password']);
        $sql_username = "SELECT * FROM users WHERE username ='$username'";
        $sql_email = "SELECT * FROM users WHERE email ='$email'";
        
        $res_u = $sql_connection -> query($sql_username) or die (mysqli_error($sql_connection));
        $res_e = $sql_connection -> query($sql_email) or die (mysqli_error($sql_connection));
        
        if(mysqli_num_rows($res_u) > 0){
            $_SESSION['message'] = "Username already exists";
        }
        else if(mysqli_num_rows($res_e) > 0){
            $_SESSION['message'] = "Email already exists";
        }
        else{
            $sql = "INSERT INTO users(email,username,password) VALUES('$email','$username','$password')";
            if($sql_connection ->query($sql) === true){
                $_SESSION['message'] = 'Registration succesful!';
                header("location: ./");
            }
            else{
                $_SESSION['message'] = "Username already exists";
            } 
        }

        }


    
    }
    else{
        $_SESSION['message'] = "Passwords do not match";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/register.css"/>
    <?php require('php/head_links.php') ?>
    

    <title>Qwerty Multihack - Register</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    <div class="container">
        <div class="row">
             <div class="col s12"><h2 class="header" style="text-align:center;color:white;">Register</h2></div>
             <div class="col s4" style="margin-left:30%;margin-top:5%;margin-bottom:3.9%;">
                    <div class="card-content">
                        <div class="row">
                            <form id="task-form" class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">             
                                <div class="input-field col s12 m12">
                                    <input type="email" id="email" name="email" required>
                                    <label for="email"><i class="material-icons">email</i> Email</label>
                                </div>
                                <div class="input-field col s12 m12">
                                     <input type="text" id="username" name="username" required>
                                    <label for="username"><i class="material-icons">person</i> Username</label>
                                </div>

                                <div class="input-field col s12 m12">
                                     <input type="password" id="password" name="password" required>
                                    <label for="password"><i class="material-icons">https</i> Password</label>
                                    <span class="helper-text" data-error="wrong" data-success="right" style="color:white;">8 characters in lenght,1 upper case later and 1 number</span>
                                </div>

                                <div class="input-field col s12 m12">
                                     <input type="password" id="second_password" name="second_password" required>
                                    <label for="second_password"><i class="material-icons">https</i> Confirm password</label>
                                </div>
                                <input type="submit" value="Sign Up" class="btn">
                            </form>
                        </div>
                    </div>
             
             </div>

        </div>
    
    </div>

    <?php require('php/footer.php') ?>
    <script>
        M.toast({html: '<?php echo $_SESSION['message'] ?>', classes: 'rounded'});
                                 
    </script>
</body>
</html>