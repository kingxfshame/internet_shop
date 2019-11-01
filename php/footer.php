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
            </div>
          </div>
          <div class="footer-copyright">
          </div>
</footer>
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