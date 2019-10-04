<?php require('php/database.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require('php/head_links.php') ?>
    <title>Qwerty MultiHack - Products</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    <?php 
            $connect=$sql_connection->prepare("SELECT id, product_name,price,img,description FROM products");
            $connect->bind_result($id, $product_name,$price ,$img, $description);
            $connect->execute();
            while($connect ->fetch()):
    ?>
    <div class="container row product">
        <a href="#">
            <div class="product_game col s6">
                <h1 class="product_title"><?php echo $product_name ?> - Qwerty</h1>
                <ul class="product_desc">
                   <p class="flow-text"><?php echo $description ?></p> 
                </ul>
                <!-- <img src="images/parralax/csgo.png" class="product_image"> -->
            </div>
            <div class="product_cheat col s6">
                <img src="images/products/<?php echo $img ?>" class="cheat_image">
            </div>
        </a>
    </div>

    <?php 
        endwhile;
    ?>

    

    <?php require('php/footer.php') ?>
</body>
</html>