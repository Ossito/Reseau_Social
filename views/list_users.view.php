



    <?php $title = "Listes des Utilisateurs";  ?>
    <?php include ('partials/_header.php'); ?>
      <div id="main-content">
        <div class="container head">
          <div class="row jumbotron">
              <div class="col-md-12">
                  <h3 class="text-info" style="font-size:1.5rem;font-weight:800;margin-bottom:25px;"><i class="fa fa-users fa-lg faa-pulse animated"></i> Listes des Utilisateurs</h3>
              </div>


                  <?php foreach ($users as $user): ?>
                    <div class="col-lg-3">
                        <div class="col-md-4">
                          <a href="profile.php?id=<?= $user->id ?>">
                            <img src="<?= $user->avatar ? $user->avatar : get_gravatar_url($user->email , 70) ?>" alt="Image de profil de <?= get_session('pseudo') ?>" style="width:70px;height:70px;border-radius:8px;">
                          </a>
                          <a href="profile.php?id=<?= $user->id ?>">
                            <h5 style="font-size:18px;margin-bottom:15px;margin-top:4px;margin-left:2px;"> <?= e($user->pseudo); ?> </h5>
                          </a>
                        </div>

                    </div>
                  <?php endforeach; ?>

                  <div class="col-sm-12" style="margin-left:-20px;margin-top:20px;">
                    <div id="pagination">
                      <?= $pagination ?>
                    </div>
                  </div>

              </div>
            </div>
          </div>


          <?php include('partials/_footer.php'); ?>
