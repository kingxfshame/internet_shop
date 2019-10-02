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
    <div class="parallax-container">
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="images/parralax/csgo.png">
                </li>
                <li>
                    <img src="images/parralax/pubg.jpg"> 
                </li>
                <li>
                    <img src="images/parralax/fortnite_parralax.jpg"> 
                </li>
                <li>
                    <img src="images/parralax/csgo_parralax.jpg">
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="bgPadding">
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
                                        <span class="card-title">
                                            <?php echo $product_name ?> - Qwerty</span>
                                    </div>
                                    <div class="card-content">
                                        <p>
                                            <?php echo $description ?>
                                        </p>
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
                    <div class="parallax">
                        <img src="images/parralax/pubg.jpg">
                    </div>
                </div>


                <div class="section">
                    <div class="prew">
                        <h3 style="text-align:center;">Example</h3>
                        <div class="border-b-gradient"></div>
                        <div class="row">
                                <div class="header_left">
                                    <h5>Without Cheats</h5>
                                </div>
                                <div class="header_right">
                                    <h5>With Cheats</h5>
                                </div>
                            </div>
                            <div id="container1" class="twentytwenty-wrapper twentytwenty-horizontal">
                            
                                <img src="images/after_before/csgo_after.jpg" alt="">
                                <img src="images/after_before/csgo_before.jpg" alt="">
                            </div>
                        </div>
                    </div>
                


                
            </div>
        </div>
    </div>
    <?php include('php/footer.php'); ?>

</body>

</html>