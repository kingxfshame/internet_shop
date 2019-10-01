<?php 
require ('php/database.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('php/head_links.php') ?>
    <title>Qwerty MultiHack - Home Page</title>
</head>
<body>
<?php include('php/navbar.php'); ?> 
    <div class="container">
        <div class="row">
                <div class="bgPadding">
                    <div class="parallax-container">
                        <div class="parallax"><img class="responsive-img" src="images/parralax/csgo.png"  alt=""></div>
                    </div>
                        <div class="section">
                            <div class="row container">
                                <h2 class="header">Qwerty Multihack</h2>
                                <p class="text-darken-3 lighten-3 text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt quisquam molestiae eos voluptas quaerat eaque fugiat ex impedit, voluptatibus quae facilis necessitatibus enim blanditiis sapiente architecto accusamus, vel unde ipsam!</p>
                            </div>
                        </div>
                        <div class="parallax-container">
                            <div class="parallax"><img src="images/parralax/fortnite_parralax.jpg"></div>
                        </div>
                        <div class="section">
                            <div class="row container">
                                <h2 class="header">Our available products</h2>
                                <div class="row">
                                    <?php 
                                        $cmd=$sql_connection->prepare("SELECT id, product_name,price,img,description FROM products ");
                                        $cmd->bind_result($id, $product_name, $price, $img,$description);
                                        $cmd->execute();
                                        while($cmd->fetch()):
                                        ?>
                                                
                                            <div class="col s6 m6">
                                                <div class="card">
                                                    <div class="card-image">
                                                    <img src="images/products/<?php echo $img ?>">
                                                    <span class="card-title"><?php echo $product_name ?> - Qwerty</span>
                                                    </div>
                                                    <div class="card-content">
                                                        <p><?php echo $description ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php 
                                        endwhile;
                                        
                                        ?>

                                </div>       
                        </div>
                    </div>
                        <div class="parallax-container">
                            <div class="parallax"><img src="images/parralax/pubg.jpg"></div>
                        </div>
                    <div class="section">
                        <div class="row container">
                            <h2 class="header">Qwerty Multihack</h2>
                            <p class="text-darken-3 lighten-3 text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt quisquam molestiae eos voluptas quaerat eaque fugiat ex impedit, voluptatibus quae facilis necessitatibus enim blanditiis sapiente architecto accusamus, vel unde ipsam!</p>
                        </div>
                    </div>
                </div>
         </div> 
    </div>

    <?php include('php/footer.php'); ?> 

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/script.js"></script>
    <script> 
    $(document).ready(function(){
    $('.sidenav').sidenav();
    $('.parallax').parallax();
  });
        
    </script>
    
</body>
</html>