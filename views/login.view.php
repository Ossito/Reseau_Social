
    <?php $title = "Connexion";  ?>
    <?php include ('partials/_header.php'); ?>

      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-sm-12">
                  <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-sign-in fa-lg faa-pulse animated"></i> Connexion</h3>
                      <?php include ('partials/_errors.php')?>
              </div>

              <div class="col-sm-12">
                  <form data-parsley-validate method="POST" autocomplete="off">

                      <!-- Identifiant -->
                      <div class="form-group">
                        <label class="control-label" for="identifiant"><i class="fa fa-user"></i> / <i class="fa fa-envelope"></i> Pseudo ou Adresse E-mail</label>
                        <input type="text" class="form-control" value="<?= get_input ('identifiant'); ?>" id="identifiant" name="identifiant" required="required">
                      </div>

                      <!-- Mot de passe -->
                      <div class="form-group">
                        <label class="control-label" for="password"><i class="fa fa-lock"></i> Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" required="required">
                      </div>

                      <!-- Session active (Se souvenir de moi) -->
                      <div class="form-group">
                        <label class="control-label" for="remember_me">
                          <input type="checkbox" name="remember_me" id="remember_me"> Garder ma session active 
                        </label>
                        
                      </div>

                      <input type="submit" class="btn btn-primary btn-lg text-center" name="login" value="Connexion">

                  </form>
              </div>
          </div>
        </div>
      </div>

        <?php include('partials/_footer.php'); ?>
