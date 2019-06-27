





    <?php $title = "Edition de Profil";  ?>
    <?php include ('partials/_header.php'); ?>
      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-md-12">
                  <div class="col-md-6">
                    <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-pencil fa-lg faa-pulse animated"></i> Edition de Profil</h3>
                  </div>
                  <?php include ('partials/_flash.php')?>
              </div>

              <?php if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')): ?>
                  <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <i class="fa fa-plus"></i>
                            <strong class="card-title pl-2">Complèter mon profil</strong>
                        </div>

                        <div class="card-body">
                          <?php include ('partials/_errors.php'); ?>

                          <form method="POST" autocomplete="off" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="name">Nom</label> <span class="text-danger">*</span>
                                    <input class="form-control" type="text" value="<?= get_input('name') ?: e($user->name) ; ?>" name="name" id="name" placeholder="Germain" >
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="city">Ville</label> <span class="text-danger">*</span>
                                  <input class="form-control" type="text" value="<?= get_input('city') ?: e($user->city); ?>" name="city" id="city" >
                                </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="country">Pays</label> <span class="text-danger">*</span>
                                    <input class="form-control" type="text" value="<?= get_input('country') ?: e($user->country); ?>" name="country" id="country" >
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="sex">Sexe</label> <span class="text-danger">*</span>
                                      <select  name="sex" id="sex" class="form-control">
                                          <option value="H" <?= $user->sex == "H" ? "selected" : "" ?>>Homme</option>
                                          <option value="F" <?= $user->sex == "F" ? "selected" : "" ?>>Femme</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="facebook">Facebook</label> <span class="text-danger">*</span>
                                    <input class="form-control" type="text" value="<?= get_input('facebook') ?: e($user->facebook); ?>" name="facebook" id="facebook">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="instagram">Instagram</label> <span class="text-danger">*</span>
                                    <input class="form-control" type="text" value="<?= get_input('instagram') ?: e($user->instagram); ?>" name="instagram" id="instagram">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="available_for_hire">
                                          <input type="checkbox" name="available_for_hiring" id="available_for_hiring" <?= $user->available_for_hiring ? "checked" : "" ?>>
                                              Disponible pour emploi ?
                                      </label>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="avatar">Changez mon avatar</label><br>
                                  <input type="file" name="avatar" id="avatar">
                                </div>
                              </div><br>
                              <div class="col-md-12">
                                  <div class="form-group" >
                                      <label for="bio">Biographie <span class="text-danger">*</span></label>
                                      <textarea name="bio" id="bio" cols="30" rows="10" class="form-control"  placeholder="Je suis un amoureux de la programmation !!!"> <?= get_input('bio') ?: e($user->bio); ?> </textarea>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <input type="submit" class="btn btn-primary" value="Valider" name="update">
                              </div>
                            </div>
                          </form>
                    </div>
                  </div>
                </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>

                  <script src="assets/js/jquery-3.3.1.min.js"></script>
                  <script src="librairies/uploadify/jquery.uploadify.js"></script>
                  <script src="assets/js/bootstrap.js"></script>
                  <script src="assets/js/dropzone.js"></script>
                  <script src="assets/js/jquery.timeago.js"></script>
                  <script src="assets/js/jquery.timeago.fr.js"></script>
                  <script src="librairies/parsley/parsley.min.js"></script>
                  <script src="librairies/parsley/i18n/fr.js"></script>
                  <script type="text/javascript">
                    window.ParsleyValidator.setLocale('fr');

                    <?php $timestamp = time(); ?> 
                        $(function() {
                          $('#avatar').uploadify({
                            'fileObjName' : 'avatar',
                            'fileTypeDesc': 'Images Files',
                            'fileTypeExts': '*.gif; *.jpg; *.jpeg; *.png',
                            'buttonText'  : 'Parcourir',
                            'formData'    : {
                              'timestamp' : '<?php echo $timestamp;?>',
                              'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                              'user_id'   :  '<?= get_session('user_id') ?>',
                              '<?php echo session_name();?>' : '<?php echo session_id();?>' 
                            },
                              'swf'       : 'librairies/uploadify/uploadify.swf', 
                              'uploader'  : 'librairies/uploadify/uploadify.php',
                              'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                                  alert("Erreur lors du chargement de votre fichier ; veuillez réessayer svp !!!");
                              },
                              'onUploadSuccess' : function(file, data, response) {
                                  alert("Votre fichier a été bien uploadé !!!");
                              }
                          });
                        });
                  </script>

            </body>
          </html>
