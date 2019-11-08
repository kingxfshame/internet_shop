<?php 
$option1 = 1;
$option2 = 100;
$option3 = 1000;

require('php/database.php') ;
session_start();
$_SESSION["windows10"] = "checked";
$_SESSION["windows7"] = "checked";
$_SESSION["linux"] = "checked";
$_SESSION["macos"] = "checked";
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

if(isset($_REQUEST['filter'])){
    $low = $_REQUEST['from'];
    $hight = $_REQUEST['to'];
    if($low < 0) $low = 0;
    if($hight < 0) $hight = 100;
    $_SESSION["lower_price"] = $low;
    $_SESSION["hight_price"] = $hight;
	if(isset($_REQUEST['Windows10'])){
		$_SESSION["windows10"] = "checked";
	}
	else{
		$_SESSION["windows10"] = "";
	}
	
	if(isset($_REQUEST['Windows7'])){
		$_SESSION["windows7"] = "checked";
	}
	else{
		$_SESSION["windows7"] = "";
	}
	
	if(isset($_REQUEST['Linux'])){
		$_SESSION["linux"] = "checked";
	}
	else{
		$_SESSION["linux"] = "";
	}
	
	if(isset($_REQUEST['MacOs'])){
		$_SESSION["macos"] = "checked";
	}
	else{
		$_SESSION["macos"] = "";
	}
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
<body style="height: 100%;">
	<div id="containerr" style="min-height: 100vh; overflow: hidden; display: block; position: relative; padding-bottom: 300px;">
    <?php require('php/navbar.php') ?>
    <div class="container">

    </div>
    <div class="sortcontainer">
        <div class="row" style="margin-top: 1vh;margin-left: 80vh;margin-right:11vh;">
            <div class="input-field col s12">
            <a class='dropdown-trigger btn' href='#' data-target='dropdown1'><i class="material-icons">import_export</i> <?php echo $text; ?></a>
                <ul id='dropdown1' class='dropdown-content'>
                <li><a href="products?sort=low_price">Sort by low price</a></li>
                <li><a href="products?sort=high_price">Sort by high price</a></li>
                <li class="divider" tabindex="-1"></li>
                <li><a href="products?sort=asc">Sort by A-Z</a></li>
                <li><a href="products?sort=desc">Sort by Z-A</a></li>
                </ul>
            </div>
            <div class="col s12">
                <div class="profile_line"></div>
            </div>
            <?php 
                    $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY price ASC limit 1");
                    $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                    $connect->execute();
                    while($connect ->fetch()){
                        if(isset($_SESSION["lower_price"])){

                        }
                        else{
                            $_SESSION["lower_price"] = $price;
                        }
                        
                    }
            ?>
            <form id="filter" action="products" enctype="multipart/form-data" autocomplete="off">
            <div class="input-field col s6" style="margin-top:1%;">
                <h6 style="color:white;">From</h6>
                <input value="<?php echo $_SESSION["lower_price"] ?>" id="from" name="from" type="text" class="validate" style="color:white;width:30%;">
                
            </div>
            <?php 
                    
                    $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY price DESC limit 1");
                    $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                    $connect->execute();
                    while($connect ->fetch()){
                        if(isset($_SESSION["hight_price"])){

                        }
                        else{
                            $_SESSION["hight_price"] = $price;
                        }
                    }
            ?>
            <div class="input-field col s6" style="margin-top:1%;margin-left:-6vh">
                <h6 style="color:white;">To</h6>
                <input value="<?php echo $_SESSION["hight_price"] ?> " id="to" name="to" type="text" class="validate" style="color:white;width:30%;">
            </div>
			<div class="col s12">
                <div class="profile_line"></div>
            </div>
			<div class="col s6" style="margin-left:-40vh">
			    <p>
				  <label>
					<input type="checkbox" <?php echo $_SESSION["windows10"]; ?> name="Windows10"/>
					<span style="color:white;">Windows 10</span>
				  </label>
				</p>
				<p>
				  <label>
					<input type="checkbox" name="Windows7" <?php echo $_SESSION["windows7"]; ?> />
					<span style="color:white;">Windows 7</span>
				  </label>
				</p>
				<p>
				  <label>
					<input type="checkbox" name="Linux" <?php echo $_SESSION["linux"]; ?> />
					<span style="color:white;">Linux</span>
				  </label>
				</p>
				<p>
				  <label>
					<input type="checkbox" name="MacOs" <?php echo $_SESSION["macos"]; ?> />
					<span style="color:white;">Mac OS</span>
				  </label>
				</p>
			</div>
			<div class="col s12">
                <div class="profile_line"></div>
            </div>
			
			<div class="col s6">
                
                    <input type='hidden' name='filter'>
                    <button class="btn waves-effect waves-light" type="submit" name="action" style="margin-left:6vh;margin-top:15vh">Find</button>
                

            </div>
            </form>


        </div>
        
    </div>
    
    <?php 
            if($sort == ""){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY id DESC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                $connect->execute();
                
            }
            else if($sort =="low_price"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY price ASC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                $connect->execute();
            }

            else if($sort =="high_price"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY price DESC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                $connect->execute();
            }
            else if($sort=="asc"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY product_name ASC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                $connect->execute();
            }
            else if($sort =="desc"){
                $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products ORDER BY product_name DESC");
                $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$system);
                $connect->execute();
            }
            while($connect ->fetch()):
                $low = $_SESSION['lower_price'];
                $hight = $_SESSION['hight_price'];
            if($price <= $hight && $price >= $low){
				
				$systemcheck = 0;
				
				$myRes = explode(',', $system );
                    for($i = 0; $i < count($myRes); $i++){
						$systemcheck = 0;
						if($_SESSION["windows10"] == "checked"){
							if($myRes[$i] == "Windows 10"){
								$systemcheck = 1 ;
							}
							else{
								
							}
						}
						if($_SESSION["linux"] == "checked"){
							if($myRes[$i] == "Linux"){
								$systemcheck = 1;
							}
							else{
								
							}
						}
						if($_SESSION["windows7"] == "checked"){
							if($myRes[$i] == "Windows 7"){
								$systemcheck = 1;
							}
							else{
								
							}
						}
						

						
						if($_SESSION["macos"] == "checked"){
							if($myRes[$i] == "Mac OS"){
								$systemcheck = 1;
							}
							else{
								
							}
						}
						
                        
                     if($systemcheck == 1){
			
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
            <h6><?php echo $description?></h6>
            <br>
            
            <p>
            Supported Systems:
                    <?php 
                        $myRes = explode(',', $system );
                        for($i = 0; $i < count($myRes); $i++){
                            echo $myRes[$i];
                            echo ',';
                        }
                    ?>
                    
                    </p> 
            <p>
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
					 }
				}
            }
            else{
                
            }
        endwhile;
    ?>


	<div style="position: absolute; bottom: 0; width: 100%;">
		<?php require('php/footer.php') ?>
	</div>
	</div>
	
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
    <script src="js/epmrgo.js" type="text/javascript"></script>
    <script>
     $(document).ready(function(){
        $('.dropdown-trigger').dropdown();
  });
    </script>
	
	
</body>
</html>