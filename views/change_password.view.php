
    <?php $title = "Changement de mot de passe";  ?>
    <?php include ('partials/_header.php'); ?>

      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-sm-12">
                  <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-key fa-lg faa-pulse animated"></i> Changement de mon mot de passe</h3>
                      <?php include ('partials/_errors.php')?>
              </div>

              <div class="col-sm-12">
                  <form data-parsley-validate method="POST" autocomplete="off">

                      <!-- Ancien mot de passe -->
                      <div class="form-group">
                        <label class="control-label" for="password"><i class="fa fa-lock"></i> Votre mot de passe actuel<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required="required">
                      </div>


                      <!-- Nouveau mot de passe -->
                      <div class="form-group">
                        <label class="control-label" for="password"><i class="fa fa-lock"></i> Votre nouveau mot de passe<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required="required" data-parsley-minlength="6">
                      </div>


                      <!-- Confirmer le nouveau mot de passe Mot de passe -->
                      <div class="form-group">
                        <label class="control-label" for="password"><i class="fa fa-lock"></i> Confirmation de votre nouveau mot de passe<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required="required" data-parsley-equalto="#new_password">
                      </div>

                      <input type="submit" class="btn btn-primary btn-lg text-center" name="change_password" value="Valider">

                  </form>
              </div>
          </div>
        </div>
      </div>

        <?php include('partials/_footer.php'); ?>
