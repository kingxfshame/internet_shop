<?php 
$option1 = 1;
$option2 = 100;
$option3 = 1000;
require('php/database.php') ;
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $date_cheat = $_POST ['options'];
    $dannie = explode(',', $date_cheat );
    for($i = 0; $i < 1; $i++){
        $ii = $i;
        $_SESSION['game_id'] = $dannie[$i];
        $_SESSION['buy_days'] = $dannie[$ii + 1];
    }
    header('location: orderconfirm');
}
if(isset($_GET['sort'])){
    switch ($_GET['sort']) {
      case 'low_price':
      $text = "Sort by low price";
      $sort = "low_price";
      break;
      case 'high_price':
      $text = "Sort by high price";
      $sort = "high_price";
      break;
    
      case 'asc':
      $text = "Sort by A-Z";
      $sort = "asc";
      break;
      case 'desc':
      $text = "Sort by Z-A";
      $sort = "desc";
      break;
    }
   }
else{
    $text = "Click to sort!";
    $sort = "";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php require('php/head_links.php') ?>


    <link rel="stylesheet" href="css/products.css"/>
    <link rel="stylesheet/less" type="text/css" href="css/style.less" />
    <title>Qwerty MultiHack - Products</title>
</head>
<body>
    <?php require('php/navbar.php') ?>
    <div class="container">
        <div class="row" style="margin-top: 1vh;margin-left: 80vh;margin-right:11vh;">
        <div class="input-field col s12">
        <a class='dropdown-trigger btn' href='#' data-target='dropdown1'><i class="material-icons">import_export</i> <?php echo $text; ?></a>
<!-- Dropdown Structure -->
            <ul id='dropdown1' class='dropdown-content'>
            <li><a href="products?sort=low_price">Sort by low price</a></li>
            <li><a href="products?sort=high_price">Sort by high price</a></li>
            <li class="divider" tabindex="-1"></li>
            <li><a href="products?sort=asc">Sort by A-Z</a></li>
            <li><a href="products?sort=desc">Sort by Z-A</a></li>
            </ul>
        </div>
        </div>
    </div>
    <?php 
            if($sort == ""){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description FROM products ORDER BY id DESC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description);
                $connect->execute();
                
            }
            else if($sort =="low_price"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description FROM products ORDER BY price ASC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description);
                $connect->execute();
            }

            else if($sort =="high_price"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description FROM products ORDER BY price DESC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description);
                $connect->execute();
            }
            else if($sort=="asc"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description FROM products ORDER BY product_name ASC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description);
                $connect->execute();
            }
            else if($sort =="desc"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description FROM products ORDER BY product_name DESC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description);
                $connect->execute();
            }
            while($connect ->fetch()):
            
    ?>
    <div class="container row product z-depth-5">
        <a class="modal-trigger" href="#modal<?php echo $id?>">
            <div class="product_game col s6 m6">
                <h1 class="product_title"><?php echo $product_name ?></h1>
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
                <h4 class="product_price"><?php echo $price ?>€ for 1 day</h4>
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
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        </div>
    </div>

    <?php 
        endwhile;
    ?>



    <?php require('php/footer.php') ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
    <script src="js/epmrgo.js" type="text/javascript"></script>
    <script>
     $(document).ready(function(){
        $('.dropdown-trigger').dropdown();
  });
    </script>
</body>
</html>