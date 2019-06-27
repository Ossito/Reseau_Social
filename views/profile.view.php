



    <?php $title = "Profil";  ?>
    <style>
      .mail:hover{
        text-decoration: none;
        color: #ff1c95;
        transition: 0.5s all;
      }
    </style>
    <?php include ('partials/_header.php'); ?>
      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-md-12">
                  <div class="col-md-6">
                    <h3 class="text-info" style="font-size:1.3rem;font-weight:800;margin-bottom:20px;"><i class="fa fa-user fa-lg faa-pulse animated"></i> Profil et Statut</h3>
                  </div>
                  <?php include ('partials/_flash.php')?>
              </div>

              <div class="col-md-12">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="card">

                          <div class="card-header">
                            <i class="fa fa-user"></i>
                              <strong class="card-title pl-2">Profil de <?= e($user->pseudo); ?> ( <?= friends_count($_GET['id']) ?> ami<?= friends_count($_GET['id']) == 1 ? '' : 's' ?> )</strong>
                          </div>

                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-5">
                                <img src="<?= $user->avatar ? $user->avatar : get_gravatar_url($user->email , 100) ?>" alt="Image de profil de <?= e($user->pseudo); ?>" style="width:100px;height:100px;border-radius:80px;">
                              </div>
                              <div class="col-md-7">
                                <?php if(!empty($_GET['id']) && $_GET['id'] !== get_session('user_id')): ?>
                                  <?php include ('partials/_relation_links.php') ; ?>
                                <?php endif; ?>
                              </div>
                            </div><br>
                            <div class="row">
                              <div class="col-sm-6">
                                <i style="margin-left:-4px" class="fa fa-user"></i> <strong> <?= e($user->pseudo); ?></strong><br>
                                <i style="margin-left:-6px" class="fa fa-envelope-open"></i> <a style="font-size:0.8rem;" class="mail" href="mailto:<?= e($user->email); ?>"><?= e($user->email); ?></a><br>
                                <?=
                                    $user->city && $user->country ? '<i style="margin-left:-6px" class="fa fa-location-arrow"></i> '.e($user->city).' - '.e($user->country) : '' ;
                                ?>
                              </div>
                              <div class="col-sm-6">
                                <?=
                                    $user->facebook ? '<i style="color:#5768ff" class="fa fa-facebook"></i> <a href="//facebook.com/'.e($user->facebook).'"> '.e($user->facebook).'</a><br>' : '' ;
                                ?>
                                <?=
                                    $user->instagram ? '<i style="color:#ff5898" class="fa fa-instagram"></i> <a href="//instagram.com/'.e($user->instagram).'"> '.e($user->instagram).'</a><br>' : '' ;
                                ?>
                                <?=
                                    $user->sex == "H" ? '<i class="fa fa-male"></i>' : '<i class="fa fa-female"></i>' ;
                                ?>
                                <?=
                                    $user->available_for_hiring ? 'Disponible pour emploi' : 'Non disponible pour emploi' ;
                                ?>
                              </div>
                            </div>
                            <hr>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="card">
                                  <div class="card-header">
                                    <h6><strong><i class="fa fa-fire"></i> Petite Biographie de <?= e($user->pseudo)?></strong></h6>
                                    <p>
                                        <?=
                                          $user->bio ? nl2br(e($user->bio)) : "Aucune Biographie pour le moment..." ;
                                        ?>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <?php if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')): ?>
                      <?php include ('partials/_errors.php')?>
                      <div class="card">
                        <div class="">
                          <div class="card-header">
                            <h5 style="font-weight:700;"><i class="fa fa-smile-o"></i> Écrivez quelque chose ...</h5>
                          </div>
                        </div>
                        <div class="card-body">
                          <form data-parsley-validate action="microposts.php" method="POST">
                            <div class="form-group">
                              <label for="content"></label>
                              <textarea class="form-control" name="content" id="content" rows="3" cols="48" placeholder="Alors quoi de neuf ?" data-parsley-minlength = "3" data-parsley-maxlength = "140" required="required" ></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary btn-sm pull-right" name="publish" value="Publier">
                          </form>
                        </div>
                      </div>


                    <hr>

                    <?php endif; ?>

                    <div class="card">
                    
                      <?php if(count($microposts) != 0): ?>
                        <?php foreach ($microposts as $micropost): ?>
                          <?php require ('partials/_micropost.php'); ?>
                        <?php endforeach; ?>
                      <?php else: ?>
                      <div class="card-body">
                        <p class="text-info">Cet utilisateur n'a encore rien posté pour le moment ...</p>
                      </div>
                      <?php endif;?>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/main.js"></script>
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
