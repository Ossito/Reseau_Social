
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME ; ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-lg-auto">
              
              <!-- Barre de recherche -->
              <!--<li class="form-inline" style="margin-right:8rem !important;">
                <input id="searchbox" class="form-control mr-2" type="search" placeholder="Recherche rapide ..." style="border-radius:3px !important;width:220px !important;">&nbsp;<i class="fa fa-spinner fa-spin" id="sipnner" style="display:none;"></i>&nbsp;
                <button class="btn btn-success" type="submit" name="rechercher">Rechercher</button>
                  <div id="display-results">
                    <div class="display-box-user">
                      <a href="#"><img src="assets/img/avatar.png" alt="Img" width="25" height="25">&nbsp;Ossito Germain <br> ossitogermain@gmail.com </a>
                    </div>                 
                  </div>
                </li>-->


                <?php if( is_logged_in() ): ?>

                  <li class="nav-item dropdown" style="margin-right:14rem;margin-top:0.1rem;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="<?= get_session('avatar') ? get_session('avatar') : get_gravatar_url(get_session('email')) ?>" alt="Image de profil de <?= get_session('pseudo') ?>" style="width:38px;height:38px;border-radius:50px;">
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item <?= set_active('profile') ?>" href="profile.php?id=<?= get_session('user_id') ?>"><i class="fa fa-user faa-pulse animated"></i> Mon profil</a>
                      <a class="dropdown-item <?= set_active('edit_user') ?>" href="edit_user.php?id=<?= get_session('user_id') ?>"><i class="fa fa-pencil faa-pulse animated"></i> Éditer mon profil</a>
                      <a class="dropdown-item <?= set_active('change_password') ?>" href="change_password.php"><i class="fa fa-key faa-vertical animated"></i> Changer mon mot de passe</a>
                      <a class="dropdown-item <?= set_active('list_users') ?>" href="list_users.php"><i class="fa fa-users faa-tada animated"></i> Listes des Utilisateurs</a> 
                      <a class="dropdown-item <?= set_active('share_code') ?>" href="share_code.php"><i class="fa fa-share faa-shake animated"></i> Partage de code sources</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Déconnexion</a>
                    </div>
                  </li>

                  <li class="nav-item <?= $notifications_count > 0 ? 'have_notifs faa-tada animated' : '' ?> " style="margin-left:-10rem;margin-right:8rem;margin-top:0.5rem">
                    <a class="nav-link <?= set_active('notifications') ?> notifications" href="notifications.php"><i class="fa fa-bell"></i><?= $notifications_count > 0 ? "($notifications_count)" : ''; ?> </a>
                  </li>

                <?php else: ?>
                  <li class="nav-item">
                      <a class="nav-link <?= set_active('login') ?>" href="login.php"><i class="fa fa-sign-in faa-pulse animated"></i> Connexion</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link <?= set_active('register') ?>" href="register.php"><i class="fa fa-user-plus faa-pulse animated"></i> Inscription</a>
                  </li>
                <?php endif; ?>
            </ul>
            </div>
        </div>
    </nav>

    <?php include ('partials/_flash.php') ; ?>
