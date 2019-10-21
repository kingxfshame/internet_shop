<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}?>
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper">
      <a href="./" class="brand-logo"><img class="" width="50%" src="images/logo.png"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="products" class="waves-effect waves-light btn pulse"> Products</a></li>
        <?php 
          if(isset($_SESSION['username'])){
            if($_SESSION['username'] == "")
            {
              ?>
                <li><a href="login">Sign In</a></li>
                <li><a href="register">Sign Up</a></li>
              <?php 
            }
            else{
              ?>
                <li><a href="profile"><?= $_SESSION['username'] ?></a></li>
              <?php 
            }
            ?>

          <?php 
          }
          else{
            ?>
                <li><a href="login">Sign In</a></li>
                <li><a href="register">Sign Up</a></li>
            <?php 
          }
        ?>

      </ul>
    </div>
  </nav>
</div>
