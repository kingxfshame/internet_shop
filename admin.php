<?php
session_start();
require('php/database.php');


 if($_SESSION['role'] == "admin"){
    
 }
 else{
    header('location: ./');
 }
 if(isset($_GET['x'])){
  switch ($_GET['x']) {
    case 'allproducts':
    $form = "allproducts";
    break;
    case 'addnew':
    $form = "addnew";
    break;
  
    case 'users':
    $form = "users";
    break;
    case 'stats':
    $form = "stats";
    break;
  }
 }
 else{
   $form = "";
 }
$email = $_SESSION['username'];
if(isset($_SESSION['admin_message'])){

}
else{
  $_SESSION['admin_message'] = '';
  $_SESSION['admin_product'] = '';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isSet($_REQUEST["update"])){
    $password = md5($_POST['password'.$_REQUEST['update']]);
    $sql_username = "SELECT * FROM users WHERE username ='$email' AND password ='$password'";
    $res_u = $sql_connection -> query($sql_username) or die ($sql_connection -> error());
    if(mysqli_num_rows($res_u) > 0){
      $product_name = $_POST['name'.$_REQUEST['update']];
      $price = $_POST['price'.$_REQUEST['update']];
      $short = $_POST['short_description'.$_REQUEST['update']];
      $description = $_POST['description'.$_REQUEST['update']];
      $support = $_POST['support'.$_REQUEST['update']];
      $idd = $_REQUEST['update'];
      $img = "file".$_REQUEST['update'];
      $avatar_path = $sql_connection ->real_escape_string($_FILES[$img]['name']);
      
      if(preg_match("!image!", $_FILES[$img]['type'])){
          if(copy($_FILES[$img]['tmp_name'],'images/products/'.$avatar_path)){
            $sql = "UPDATE products set product_name = '$product_name', price='$price' ,img='$avatar_path' ,short_description='$short',description='$description',support='$support' WHERE id='$idd'";
            if($sql_connection ->query($sql) === true){
              $_SESSION['admin_product'] = $product_name;
              $_SESSION['admin_message'] = 'The product has been successfully updated';
              
            }
          }

      }
      else{
        $sql = "UPDATE products set product_name = '$product_name', price='$price' , short_description='$short',description='$description',support='$support' WHERE id='$idd'";
        if($sql_connection ->query($sql) === true){
          $_SESSION['admin_product'] = $product_name;
          $_SESSION['admin_message'] = 'The product has been successfully updated';
          
         
        }
      }

    }
    else{
      $_SESSION['admin_product'] = 'Wrong Password';
      $_SESSION['admin_message'] = 'You entered an incorrect password for your account';
    }
  }
  else if(isset($_REQUEST['addnew'])){
    $password = md5($_POST['password']);
    $sql_username = "SELECT * FROM users WHERE username ='$email' AND password ='$password'";
    $res_u = $sql_connection -> query($sql_username) or die ($sql_connection -> error());
    if(mysqli_num_rows($res_u) > 0){

      $product_name = $_POST['name_addnew'];
      $price = $_POST['price_addnew'];
      $short = $_POST['short_description_addnew'];
      $description = $_POST['description_addnew'];
      $support = $_POST['support_addnew'];
      $img = "file_addnew";
      $avatar_path = $sql_connection ->real_escape_string($_FILES[$img]['name']);

      if(preg_match("!image!", $_FILES[$img]['type'])){
        if(copy($_FILES[$img]['tmp_name'],'images/products/'.$avatar_path)){
          $sql = "INSERT INTO products(product_name,price,img,short_description,description,support,status) VALUES('$product_name','$price','$avatar_path','$short','$description','$support','Active')";
          if($sql_connection ->query($sql) === true){
            $_SESSION['admin_product'] = $product_name;
            $_SESSION['admin_message'] = 'The product has been successfully added';
            
          }
        }

    }
    }
    else{
      $_SESSION['admin_product'] = 'Wrong Password';
      $_SESSION['admin_message'] = 'You entered an incorrect password for your account';
    }




  }
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/admin.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <link rel="shortcut icon" type="image/x-icon" href="images/q.ico" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin - Qwerty</title>
</head>
<body>

<div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="admin"><h3>Qwerty</h3></a>
            </div>

            <ul class="list-unstyled components">
                <p>Admin Panel</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Products</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                        <a href="admin?x=allproducts">All Products</a>

                        </li>
                        <li>
                            <a href="admin?x=addnew">Add new</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="admin?x=users">Users</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="./">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <?php 
            
            if($_SESSION['admin_message'] == ''){

            }
            else{

           
            
            ?>
              <div style="position: absolute; top: 20; right: 0;">
                  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color:black;">
                    <div class="toast-header">
                      
                      <strong class="mr-auto"><?php echo $_SESSION['admin_product'] ?></strong>
                      <small class="text-muted">just now</small>
                      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="toast-body" style="color:white;">
                    <?php echo $_SESSION['admin_message'] ?>
                    </div>
                  </div>
              </div>
              <?php 
               }
               $_SESSION['admin_product'] = '';
               $_SESSION['admin_message'] = '';
              ?>

            <?php if($form == "" || $form == "allproducts") {?>
            <h2>All Products</h2>
           
            <div class="line"></div>
            <?php 
                  $connect=$sql_connection->prepare("SELECT id, product_name,price,img,short_description,description,support FROM products");
                  $connect->bind_result($id, $product_name,$price ,$img, $short_desc ,$description,$support);
                  $connect->execute();
                  while($connect ->fetch()):
                    
            
            ?>
            <a href="#collapse<?php echo $id?>" data-toggle="collapse" href="#collapse<?php echo $id?>" aria-expanded="false" aria-controls="collapse<?php echo $id?>" role="button">
             <h2><?php echo $product_name ?> - Qwerty</h2>
             <p><?php echo $description ?></p>
             </a>
             <div class="collapse" id="collapse<?php echo $id?>">
              <div class="card card-body">
              
              <form id="task-form" action="admin" method="post" enctype="multipart/form-data" autocomplete="off">
              <input type='hidden' name='update' value='<?php echo $id?>'>
              <div class="row">

              <div class="col">
                    
                  <div class="form-group">
                    <label for="name<?php echo $id ?>">Name: </label>
                    <input type="text" class="form-control" id="name<?php echo $id ?>" name="name<?php echo $id?>" placeholder="name@example.com" value="<?php echo $product_name ?>">
                  </div>
                      <div class="form-group">
                      <label for="price<?php echo $id ?>">Price: </label>
                      <input type="text" class="form-control" id="price<?php echo $id ?>" name="price<?php echo $id?>" placeholder="name@example.com" value="<?php echo $price ?>">

                      </div>

                      <div class="form-group">
                      <label for="short_description<?php echo $id ?>">Short Description: </label>
                      <input type="text" class="form-control" id="short_description<?php echo $id ?>" name="short_description<?php echo $id?>" placeholder="name@example.com" value="<?php echo $short_desc ?>">
                      </div>
                      <div class="form-group">
                      <label for="support<?php echo $id ?>">Support: </label>
                      <input type="text" class="form-control" id="support<?php echo $id ?>" name="support<?php echo $id?>" placeholder="name@example.com" value="<?php echo $support ?>">

                      </div>



                  </div>

                <div class="col">
                  <div class="form-group">
                  <label for="description<?php echo $id ?>">Description</label>
                  <textarea class="form-control" id="description<?php echo $id ?>" name="description<?php echo $id?>" rows="5"><?php echo $description ?></textarea>

                  </div>
                    <div class="file-field">
                      <div class="z-depth-1-half mb-4">
                        <img src="images/products/<?php echo $img ?>" class="img-fluid"
                          alt="example placeholder" style="margin-left:100px;width:400px;height:200px;">
                      </div>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded float-left">
                          <span>Choose file</span>
                          <input type="file" id="file<?php echo $id ?>" name="file<?php echo $id ?>" accept="images/products/*" class="file-upload">
                        </div>
                      </div>
                    </div>

              </div>





              </div>

              <div class="line"></div>
              <div class="form-group col-sm">
                <label for="staticEmail2" class="sr-only">Email</label>
                  <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Username:    <?php echo $_SESSION['username'] ?>">
              </div>


              <div class="form-group mx-sm-3 mb-2">
                  <label for="password<?php echo $id ?>" class="sr-only">Password</label>
                  <input type="password" class="form-control" id="password<?php echo $id ?>" name="password<?php echo $id ?>" placeholder="Password">
                </div>
                <a href="#" onclick="document.getElementById('task-form').submit();">
                  <button class="btn btn-primary mb-2">Confirm identity</button>
                  </a>
                </form>
              </div>


            
            </div>    
             <div class="line"></div>
             <?php 
            
          endwhile;
        }
        else if($form == "addnew"){
          ?>
        <h2>Add new product</h2>
         
         <div class="line"></div>
          <div class="card card-body">
          
           <form id="task-form" action="admin" method="post" enctype="multipart/form-data" autocomplete="off">
           <input type='hidden' name='addnew'>
           
           <div class="row">

           <div class="col">
                
               <div class="form-group">
                 <label for="name_addnew">Name: </label>
                 <input type="text" class="form-control" id="name_addnew" name="name_addnew" placeholder="CS GO" >
               </div>
                   <div class="form-group">
                   <label for="price_addnew">Price for 1 day: </label>
                   <input type="text" class="form-control" id="price_addnew" name="price_addnew" placeholder="0.4">

                   </div>

                   <div class="form-group">
                   <label for="short_description_addnew">Short Description: </label>
                   <input type="text" class="form-control" id="short_description_addnew" name="short_description_addnew" placeholder="Wallhack,Aimbot">
                   </div>
                   <div class="form-group">
                   <label for="support_addnew">Support: </label>
                   <input type="text" class="form-control" id="support_addnew" name="support_addnew" placeholder="Linux">

                   </div>



               </div>

             <div class="col">
               <div class="form-group">
               <label for="description_addnew">Description</label>
               <textarea class="form-control" id="description_addnew" name="description_addnew" rows="5" placeholder="Description"></textarea>

               </div>
                 <div class="file-field">
                   <div class="z-depth-1-half mb-4">
                   </div>
                   <div class="d-flex justify-content-center">
                     <div class="btn btn-mdb-color btn-rounded float-left">
                       <input type="file" id="file_addnew" name="file_addnew" accept="images/products/*" class="file-upload">
                     </div>
                   </div>
                 </div>

           </div>





           </div>

           <div class="line"></div>
           <div class="form-group col-sm">
             <label for="staticEmail2" class="sr-only">Email</label>
               <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Username: <?php echo $_SESSION['username'] ; ?>">
           </div>


           <div class="form-group mx-sm-3 mb-2">
               <label for="password" class="sr-only">Password</label>
               <input type="password" class="form-control" id="password" name="password" placeholder="Password">
             </div>
             <a href="#" onclick="document.getElementById('task-form').submit();">
               <button class="btn btn-primary mb-2">Confirm identity</button>
               </a>
             </form>
             
           
    


          
          <div class="line"></div>
          <?php
        
     }
        else if($form == "users"){
          ?>
          <h2>All Users</h2>
          <div class="line"></div>
          <table class="table">
          <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Username</th>
              </tr>
         </thead>
          <?php
            $connect=$sql_connection->prepare("SELECT id,email,username FROM users");
            $connect->bind_result($id, $email,$username);
            $connect->execute();
            while($connect ->fetch()):
          ?>
            <tr>
              <th scope="row"><?php echo $id; ?></th>
              <td><?php echo $email; ?></td>
              <td><?php echo $username; ?></td>
              
            </tr>
        
          <?php
          endwhile;
        }
            ?>
          </div>
      </div>
    </div>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
          $('.toast').toast({
            delay:5000
          });
          $('.toast').toast('show');
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });

        });
    </script>
</body>
</html>