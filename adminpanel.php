<!--
<?php
session_start();
 if($_SESSION['role'] == "admin"){
    
 }
 else{
    header('location: ./');
 }



require('php/database.php');
// добавление данных в таблицу из БД
if(isSet($_REQUEST["add"]))
{
    $connect = $sql_connection->prepare("INSERT INTO products(product_name, price, img, short_description, description) VALUES (?,?,?,?,?)");
    $connect->bind_param("sssss", $_REQUEST["product_name"], $_REQUEST["price"],  $_REQUEST["img"],  $_REQUEST["short_description"], $_REQUEST["description"]);
    $connect->execute();
    header("Location: $_SERVER[PHP_SELF]");
    $sql_connection->close();
}

//удаление конкретной записи
if(isSet($_REQUEST["delete"]))
{
    $connect=$sql_connection->prepare("DELETE FROM products WHERE id=?");
    $connect->bind_param("i", $_REQUEST["delete"]);
    $connect->execute();
}
//изменение или обновление записи
if(isSet($_REQUEST["update"]))
{
    $connect=$sql_connection->prepare("UPDATE products SET product_name=?, price=?, img=?, short_description=?, description=? WHERE id=?");
    $connect->bind_param("sssssi",$_REQUEST["product_name"], $_REQUEST["price"], $_REQUEST["img"], $_REQUEST["short_description"], $_REQUEST["description"], $_REQUEST["update"]);
    $connect->execute();
}
?>
    <!DOCTYPE HTML>
    <html lang="et">
    <head>

        <title>Admin Panel</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="">

    </head>
    <body>
    <div id="menyy">
        <h1>Products</h1>
        <ul>
            <?php
            //просмотр продуктов из таблицы
            $connect=$sql_connection->prepare("SELECT id, product_name FROM products");
            $connect->bind_result($id, $product_name);
            $connect->execute();
            while($connect->fetch())
            {
                echo "<li>";
                echo "<a href='?id=$id'>".htmlspecialchars($product_name)."</a>";
                echo "</li>";
            }
            ?>
        </ul>
        <a href="?adding=jah">ADD</a>
    </div>

    <div id="price">
        <?php
        // просмотр всех данных продукта
        if(isSet($_REQUEST["id"]))
        {
            $connect=$sql_connection->prepare("SELECT id, product_name, price, img, short_description, description FROM products WHERE id=?");
            $connect->bind_param("i", $_REQUEST["id"]);
            $connect->bind_result($id, $product_name, $price, $img, $short_description, $description);
            $connect->execute();
            if($connect->fetch())
            {
                if (isSet($_REQUEST['updated']))
                {
                    echo "
                             <form action='?'>
                                 <input type='hidden' name='update' value='$id'>
                                 Products
                                 <input type='text' name='product_name' value='" . htmlspecialchars($product_name) . "'>
                                 <br>
                                 Price
                                 <input type='float' name='price' value='" . htmlspecialchars($price) . "'>
                                 <br>
                                 Img
                                 <input type='text' name='img' value='" . htmlspecialchars($img) . "'>
                                 <br>
                                 Short description
                                 <input type='text' name='short_description' value='" . htmlspecialchars($short_description) . "'>
                                 <br>
                                 Description
                                 <input type='text' name='description' value='" . htmlspecialchars($description) . "'>
                                 <br>
                                 <input type='submit' value='Edit'>
                             </form>
                            ";
                }
                else
                {
                    echo "<h2>" . htmlspecialchars($product_name) . "</h2>";
                    echo "<h2>" . htmlspecialchars($price) . "</h2>";
                    echo "<h2>" . htmlspecialchars($img) . "</h2>";
                    echo "<h2>" . htmlspecialchars($short_description) . "</h2>";
                    echo "<h2>" . htmlspecialchars($description) . "</h2>";
                    echo "<a href='$_SERVER[PHP_SELF]?delete=$id'>Delete product</a>";
                    echo "<br>";
                    echo "<a href='$_SERVER[PHP_SELF]?id=$id&amp;updated=jah'>Edite product</a>";
                    //&amp;
                }
            }
            else
            {
                echo "vigased andmed";
            }
        }
        //добавление новых данных
        if(isSet($_REQUEST["adding"]))
        {
            ?>
            <form action="?">
                <input type="hidden" name="add" value="jah">
                Product:
                <input type="text" name="product">
                <br>
                Price:
                <input type="float" name="price">
                <br>
                Image:
                <input type="text" name="img">
                <br>
                Short description:
                <input type="text" name="short_description">
                <br>
                Description:
                <input type="text" name="description">
                <br>
                <input type="submit" value="Add">
            </form>
            <?php
        }
        ?>
    </div>
    </body>
    </html>
<?php
$sql_connection->close();
?>-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" href="css/admin.css"> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <title>Admin Panel</title>
</head>
<body>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
    
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <a href="#" class="btn" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
            <h1 class="text-center">Bootstrap Sidebar</h1>
            <h2 class="small text-center">Second Header</h2>
            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium perferendis maiores velit ad id delectus nisi eligendi doloremque officia necessitatibus, repellendus alias omnis, natus nam voluptates dolor vel minus ab?</p>
          </div>
        </div>
      </div>
    </div>
  </div>









<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
  $("#menu-toggle").click(function(e){
    e.preventDefault();
    $("#wrapper").toggleClass("menuDisplayed");
  });
});

</script>


</body>
</html>