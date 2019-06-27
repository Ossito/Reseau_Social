
    <?php $title = "Accueil";  ?>
    <?php include('partials/_header.php'); ?>
        
        <div id="main-content">
          <div class="container head">
            <div class="row jumbotron">
              <h1><?= WEBSITE_NAME ; ?> ?</h1>
                <p>
                  <a href="index.php" class="link_index"> <?= WEBSITE_NAME ; ?> </a> </strong> est un réseau social pour les développeurs passionés <i class="fa fa-book fa-lg faa-pulse animated"></i> .<br>
                  Et qui dit <strong>développeurs</strong>, dit également <strong>code source </strong> ! <i class="fa fa-edit fa-lg faa-tada animated"></i> <br>
                  Grâce à cette plateforme vous aviez ainsi la possiblité de tisser des liens d'amités avec d'autres développeurs, échanger des codes sources,
                  recevoir de l'aide si vous en rencontrez des problèmes sur l'un de vos projets et bien plus encore ! <br>
                  Alors n'hésitez point et <strong class="text-info"> rejoignez dès maintenant la communauté  <a href="index.php" class="link_index"> <?= WEBSITE_NAME ; ?> </a> </strong> !
                </p>
                <?php if( is_logged_in() ): ?>
                  <a  href="profile.php" class="btn btn-primary btn-lg" id="go"><img src="<?= get_session('avatar') ? get_session('avatar') : get_gravatar_url(get_session('email')) ?>" alt="Image de profil de <?= get_session('pseudo') ?>" style="width:28px;height:28px;border-radius:50px;"> Voir votre profil Développeur </a>
                    <?php else: ?>
                  <a  href="register.php" class="btn btn-primary btn-lg" name="register" value="register" id="go"><i class="fa fa-user-plus"></i> Créer un compte</a>
                <?php endif; ?>
            </div>
          </div>
        </div>

        <?php include('partials/_footer.php'); ?>
