<?= session_start() ?>
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper">
      <a href="./" class="brand-logo"><img class="" width="50%" src="images/logo.png"></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <?php 
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 193f5c2e1c51e87412b885c09d8fdbb1d142bd6d
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
<<<<<<< HEAD
=======
=======
          if($_SESSION['username'] == ""){
            ?>
                <li><a href="login.php">Sign In</a></li>
                <li><a href="register.php">Sign Up</a></li>
            <?php 
          }
          else{
            ?>
              <li><a href="profile.php"><?= $_SESSION['username'] ?></a></li>
>>>>>>> 3b80066a1e99cbd1f6686f1a50842b2f9fe11257
>>>>>>> 193f5c2e1c51e87412b885c09d8fdbb1d142bd6d
            <?php 
          }
        ?>
        <li><a href="products.php" class="waves-effect waves-light btn pulse"> Products</a></li>
      </ul>
    </div>
  </nav>
</div>

 