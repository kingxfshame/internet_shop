<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('php/head_links.php') ?>
    <title>Qwerty Multihack - Register</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    <div class="container">
        <div class="row">
             <div class="col s12"><h2 class="header" style="text-align:center;color:white;">Register Form</h2></div>
             <div class="col s4" style="margin-left:25%;">
                    <div class="card-content">
                        <div class="row">
                            <form id="task-form">
                                <div class="input-field col s12">
                                    <input type="email" id="email" name="email">
                                    <label for="email"><i class="material-icons">email</i> Email</label>
                                </div>
                                <div class="input-field col s12">
                                     <input type="text" id="username" name="username">
                                    <label for="username"><i class="material-icons">person</i> Username</label>
                                </div>

                                <div class="input-field col s12">
                                     <input type="text" id="password" name="password">
                                    <label for="password"><i class="material-icons">https</i> Passoword</label>
                                </div>

                                <div class="input-field col s12">
                                     <input type="text" id="second_passoword" name="second_passoword">
                                    <label for="second_passoword"><i class="material-icons">https</i> Confirm your password</label>
                                </div>
                                <input type="submit" value="Sign Up" class="btn">
                            </form>
                        </div>
                    </div>
             
             </div>

        </div>
    
    </div>

    <?php require('php/footer.php') ?>
</body>
</html>