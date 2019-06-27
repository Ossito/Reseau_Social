

<?php
    session_start();

    require ('includes/init.php');
    include ('filters/auth_filter.php');


    if(isset($_POST['publish'])){

      if(!empty($_POST['content'])){
        extract($_POST);

        if(mb_strlen($content) < 140 && mb_strlen($content) > 3){

          create_micropost_for_the_current_user($content);

          set_flash('Hourra vous venez de poster un statut <i class="fa fa-smile-o"></i> <i class="fa fa-smile-o"></i> <i class="fa fa-smile-o"> </i> <i class="fa fa-smile-o"> </i> !!!');

        }else{
          set_flash('Vous ne devez pas dépasser le nombre de caractères requis');
        }



      }else{
        set_flash('Aucun contenu n\'a été fourni !!!');
      }
    }

    redirect('profile.php?id='.get_session('user_id'));


?>
