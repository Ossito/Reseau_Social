


<?php if(isset($_SESSION['notification']['message'])): ?>
    <div class="container">
      <div class="alert alert-<?= $_SESSION['notification']['type']  ?>" style="margin-top:12%;margin-bottom:-115px;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times-circle"></i></button>
          <h5> <strong> <?= $_SESSION['notification']['message'] ?> </strong> </h5>
      </div>
    </div>
    <?php $_SESSION['notification'] = []; ?>
<?php endif; ?>
