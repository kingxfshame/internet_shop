<?php 
require ('php/database.php');

?>
<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">About us</h5>
                <p class="grey-text text-lighten-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus quis hic nisi fuga eveniet neque ipsam assumenda! Officiis facilis, aspernatur, voluptatem deserunt, similique perspiciatis dolore corporis sapiente eveniet illum blanditiis.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                <?php 
                      $cmd=$sql_connection->prepare("SELECT product_name FROM products ");
                      $cmd->bind_result($product_name);
                      $cmd->execute();
                      while($cmd->fetch()):
                 ?>
                  <li><a class="grey-text text-lighten-3" href="#!"><?php echo $product_name ?> - Qwerty</a></li>
                  <?php 
                  endwhile;
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 QWERTY project 
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
</footer>