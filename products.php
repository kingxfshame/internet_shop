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
    <div class="container row product z-depth-5">
        <a class="modal-trigger" href="#modal1">
            <div class="product_game col s6">
                <h1 class="product_title"><?php echo $product_name ?> - Qwerty</h1>
                <ul class="product_desc">
                   <p class="flow-text product_desc"><?php echo $description ?></p> 
                </ul>
                <h3 class="product_price"><?php echo $price ?>€</h3>
                <!-- <img src="images/parralax/csgo.png" class="product_image"> -->
            </div>
            <div class="product_cheat col s6">
                <img src="images/products/<?php echo $img ?>" class="cheat_image">
            </div>
        </a>
    </div>

    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4><?php echo $product_name ?> - Qwerty</h4>
            <p><?php echo $description ?></p>
            <h5 class="product_price"><?php echo $price ?>€</h5>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>

    <?php 
        endwhile;
    ?>

    

    <?php require('php/footer.php') ?>
</body>
</html>