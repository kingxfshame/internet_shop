<?php 
session_start();
/* $user_name = $_SESSION['username']; */

require('php/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('php/head_links.php') ?>
    <title>Qwerty Multihack - Products</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    
    <ul id="slide-out" class="sidenav sidenav-fixed">
    <li><a href="admin.php">Main</a></li>
      <li><a href="productsPage.php">Products</a></li>
      <li><a href="usersPage.php">Users</a></li>
    </ul>
    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>


    <?php 
            $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description FROM products");
            $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description);
            $connect->execute();
            while($connect ->fetch()):
            
    ?>
    <div class="container row product z-depth-5">
        <a class="modal-trigger" href="#modal<?php echo $id?>">
            <div class="product_game col s6 m6">
                <h1 class="product_title"><?php echo $product_name ?> - Qwerty</h1>
                <ul class="product_desc">

                   <p class="flow-text product_desc">
                    <?php 
                        $myRes = explode(',', $short_desc );
                        for($i = 0; $i < count($myRes); $i++){
                            echo $myRes[$i];
                            echo '<br>';
                        }
                    ?>
                    
                    </p> 
                </ul>
                <h3 class="product_price"><?php echo $price ?>€ for 1 day</h3>
                <!-- <img src="images/parralax/csgo.png" class="product_image"> -->
            </div>
            <div class="product_cheat col s6 m6">
                <img src="images/products/<?php echo $img ?>" class="cheat_image">
            </div>
        </a>
    </div>

    <div id="modal<?php echo $id?>" class="modal">
        <div class="modal-content">
            <h4><?php echo $product_name ?> - Qwerty</h4>
            <p><?php echo $description ?></p>
            <h5 class="product_price" style="text-align:center;"><?php echo $price * 7 ?>€ for 7 days | <?php echo $price * 30 ?>€ for 30 days | <?php echo $price * 360 ?>€ for 360 days</h5>
            <form id="task-form" class="form" action="products" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="option-group">
                
                <div class="option-container">
                    <input class="option-input" checked id="option-<?php echo $option1 ?>" type="radio" name="options" value="<?php echo $id ?>,7" />
                    <input class="option-input" id="option-<?php echo $option2 ?>" type="radio" name="options" value="<?php echo $id ?>,30"/>
                    <input class="option-input" id="option-<?php echo $option3 ?>" type="radio" name="options" value="<?php echo $id ?>,360"/>
                    
                    <label class="option" for="option-<?php echo $option1 ?>">
                    <span class="option__indicator"></span>
                    <span class="option__label">
                        7<sub>days</sub>
                    </span>
                    </label>

                    <label class="option" for="option-<?php echo $option2 ?>">
                    <span class="option__indicator"></span>
                    <span class="option__label">
                        30<sub>days</sub>
                    </span>
                    </label>

                    <label class="option" for="option-<?php echo $option3 ?>">
                    <span class="option__indicator"></span>
                    <span class="option__label">
                        360<sub>days</sub>
                    </span>
                    </label>

                </div>
            </div>
            <?php 
                if(isset($_SESSION['username'])){
                    if($_SESSION['username'] == "")
                    {
                    ?>
                        <input type="submit" value="Buy Cheat" class="btn-large disabled" style="margin-left:40%;">
                    <?php 
                    }
                    else{
                        ?>
                            <input type="submit" value="Buy Cheat" class="btn-large" style="margin-left:40%;">
                        <?php 
                      }
                    }
                else{
                      ?>
                        <input type="submit" value="Buy Cheat" class="btn-large disabled" style="margin-left:40%;">
                      <?php 
                }
                $option1= $option1 + 1;
                $option2= $option2 + 1;
                $option3= $option3 + 1;
        ?>
         </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
        </div>
    </div>

    <?php 
        endwhile;
    ?>


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