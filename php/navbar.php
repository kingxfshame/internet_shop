<?= session_start() ?>
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper">
      <a href="./" class="brand-logo"><img class="" width="50%" src="images/logo.png"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php 
          if(isset($_SESSION['username'])){
            if($_SESSION['username'] == "")
            {
              ?>
                <li><a href="login.php">Sign In</a></li>
                <li><a href="register.php">Sign Up</a></li>
              <?php 
            }
            else{
              ?>
                <li><a href="profile.php"><?= $_SESSION['username'] ?></a></li>
                <li><a href="php/logout.php">Log out</a></li>
              <?php 
            }
            ?>

          <?php 
          }
          else{
            ?>
                <li><a href="login.php">Sign In</a></li>
                <li><a href="register.php">Sign Up</a></li>
            <?php 
          }
        ?>
        <li><a href="products.php" class="waves-effect waves-light btn pulse"> Products</a></li>
      </ul>
    </div>
  </nav>
</div>