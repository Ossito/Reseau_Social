
    <?php $title = "Notifications";  ?>
    <?php include ('partials/_header.php'); ?>

      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-sm-12">
                  <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-exclamation-circle fa-lg faa-pulse animated"></i> Vos notifications</h3>
                      <?php include ('partials/_errors.php')?>
              </div>

              <div class="col-sm-12">
                <?php if(count($notifications) > 0): ?>
                    <ul class="list-group">
                <?php foreach($notifications as $notification): ?>
                    <li class="list-group-item <?= $notification->seen == '0' ? 'not_seen' : '' ?>" >
                      <?php require("partials/notifications/{$notification->name}.php"); ?>
                    </li>
                <?php endforeach; ?>
                    </ul>
                    <div class="col-sm-12" style="margin-left:-20px;margin-top:20px;">
                        <div id="pagination"><?= $pagination ?></div>
                    </div>
                <?php else: ?>
                    <p>Aucune notification disponible pour l'instant.</p>
                <?php endif; ?>
              </div>
          </div>
        </div>
      </div>

            
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/jquery.timeago.js"></script>
        <script src="assets/js/jquery.timeago.fr.js"></script>
        <script src="librairies/parsley/parsley.min.js"></script>
        <script src="librairies/parsley/i18n/fr.js"></script>
        <script type="text/javascript">
          window.ParsleyValidator.setLocale('fr');
            $(document).ready(function(){
                $(".timeago").timeago();
          });
        </script>

  </body>
</html>

