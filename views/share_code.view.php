

<?php $title = "Partage de codes sources";  ?>
<?php include ('partials/_header.php'); ?>

  <div id="main-content">
    <div class="container head">
      <div class="row jumbotron">
          <div class="col-sm-12">
              <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-share fa-lg faa-pulse animated"></i> Partager vos codes sources à volonté</h3>
                  <?php include ('partials/_errors.php')?>
          </div>

          <div class="col-sm-12">
            <div id="main-content-share-code">
              <form method="POST" autocomplete="off">
                <textarea name="code" id="code" placeholder="Entrez votre code ici..." required="required"><?= e($code); ?></textarea>

                <div class="btn-group nav">
                  <a href="share_code.php" class="btn btn-danger">Tout Effacer !</a>
                  <input type="submit" name="save" class="btn btn-success" value="Enregistrer">
                </div>

              </form>
            </div>
          </div>
      </div>
    </div>
  </div>

          <script src="assets/js/jquery-3.3.1.min.js"></script>
          <script src="assets/js/bootstrap.js"></script>
          <script src="assets/js/jquery.textarea.js"></script>
          <script type="text/javascript">
            $("#code").tabby();
            $("#code").height( $(window).height() - 50 );
          </script>

    </body>
  </html>
