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


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isSet($_REQUEST["task-form"])){
    echo 'test';
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


  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Qwerty</h3>
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
                <li>
                    <a href="admin?x=stats">Stats</a>
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
            <?php if($form == "allproducts") {?>
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
              <div class="row">

              <div class="col">
                    
                  <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" class="form-control" id="name" placeholder="name@example.com" value="<?php echo $product_name ?>">
                  </div>
                      <div class="form-group">
                      <label for="price">Price: </label>
                      <input type="text" class="form-control" id="price" placeholder="name@example.com" value="<?php echo $price ?>">

                      </div>

                      <div class="form-group">
                      <label for="short_description">Short Description: </label>
                      <input type="text" class="form-control" id="short_description" placeholder="name@example.com" value="<?php echo $short_desc ?>">
                      </div>
                      <div class="form-group">
                      <label for="support">Support: </label>
                      <input type="text" class="form-control" id="support" placeholder="name@example.com" value="<?php echo $support ?>">

                      </div>



                  </div>

                <div class="col">
                  <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" id="description" rows="5"><?php echo $description ?></textarea>

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
                  <input type="password" class="form-control" id="password<?php echo $id ?>" placeholder="Password">
                </div>
                  <button type="submit" class="btn btn-primary mb-2">Confirm identity</button>
                </form>
              </div>


            
            </div>    
             <div class="line"></div>
             <?php 
            
          endwhile;
        }
        else if($form == "addnew"){
          ?>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            Launch demo modal
          </button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>





          <?php
        }
        else{
          ?>
          <div class="container">
          <h1>Welcome To Admin Page</h1>
          </div>
          <?php
        }
            ?>

            </div>
    </div>



    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
</body>
</html>