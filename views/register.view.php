
    <?php $title = "Inscription";  ?>
    <?php include ('partials/_header.php'); ?>

      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-sm-12">
                  <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-user-plus fa-lg faa-pulse animated"></i> Devenez dès à présent membre !</h3>
                      <?php include ('partials/_errors.php')?>
              </div>

              <div class="col-sm-12">
                  <form data-parsley-validate method="POST" autocomplete="off">

                      <!-- Nom -->
                      <div class="form-group">
                        <label class="control-label" for="name"><i class="fa fa-user"></i> Nom</label>
                        <input type="text" class="form-control" value="<?= get_input ('name'); ?>" id="name" name="name" required="required">
                      </div>

                      <!-- Pseudo -->
                      <div class="form-group">
                        <label class="control-label" for="pseudo"><i class="fa fa-user"></i> Pseudo</label>
                        <input type="text" class="form-control" value="<?= get_input ('pseudo'); ?>" id="pseudo" name="pseudo" required="required" data-parsley-minlength="3">
                      </div>

                      <!-- Email -->
                      <div class="form-group">
                        <label class="control-label" for="email"><i class="fa fa-envelope"></i> Adresse Email</label>
                        <input type="email" class="form-control" value="<?= get_input ('email'); ?>" id="email" name="email" required="required" data-parsley-trigger="keypress">
                      </div>

                      <!-- Mot de passe -->
                      <div class="form-group">
                        <label class="control-label" for="password"><i class="fa fa-lock"></i> Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required="required">
                      </div>

                      <!-- Mot de passe de confirmation -->
                      <div class="form-group">
                        <label class="control-label" for="password_confirm"><i class="fa fa-lock"></i> Confirmez votre mot de passe</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required="required" data-parsley-equalto="#password">
                      </div>

                      <input type="submit" class="btn btn-primary btn-lg text-center" name="register" value="Inscription">

                  </form>
              </div>
          </div>
        </div>
      </div>

        <?php include('partials/_footer.php'); ?>
