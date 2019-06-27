

<?php $title = "Affichage de codes sources";  ?>
<?php include ('partials/_header.php'); ?>

  <div id="main-content">
    <div class="container head">
      <div class="row jumbotron">
          <div class="col-sm-12">
                  <?php include ('partials/_errors.php')?>
          </div>

          <div class="col-sm-12">
            <div id="main-content-share-code">
              <pre class="prettyprint linenums"><?= e($data->code); ?></pre>

              <div class="btn-group nav">
                <a href="share_code.php?id=<?= $_GET['id']?>" class="btn btn-warning">Cloner</a>
                <a href="share_code.php" class="btn btn-primary">Nouveau</a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

          <script src="assets/js/jquery-3.3.1.min.js"></script>
          <script src="assets/js/bootstrap.js"></script>
          <script src="assets/js/google-code-prettify/prettify.js"></script>
          <script>
            prettyPrint();
          </script>

    </body>
  </html>
