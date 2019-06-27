




<?php
    session_start();
    
    require ('includes/init.php');
    include ('filters/auth_filter.php');
    

    if(!empty($_GET['id'])){
      
      $data = find_code_by_id($_GET['id']);

        if(!$data){
          $code = "";
        }else{
          $code = $data->code;
        }
      }else{
        $code = "";
      }


    if(isset($_POST['save'])){
      if(not_empty(['code'])){
        extract ($_POST);

        $q = $db->prepare("INSERT INTO codes(code) VALUES (?)");
        $success = $q->execute([$code]);

        if($success){
          $id = $db->lastInsertId();
          $fullURL = WEBSITE_URL . 'show_code.php?id='.$id;
          create_micropost_for_the_current_user('Je viens de publier un code source : ' . $fullURL );
          redirect('show_code.php?id='.$id);
        }else{
          set_flash("Erreur lors de l'ajout de votre code ; veuillez réessayer svp !!!" , 'danger');
          redirect('share_code.php');
        }
      }else{
        redirect('share_code.php');
      }
    }

?>


<?php require ('views/share_code.view.php'); ?>
