<?php

  session_start();
  require ('includes/init.php');



  if(isset($_POST['change_password'])){

    $errors = [];

    if(not_empty(['current_password' , 'new_password' , 'new_password_confirmation'])){

      extract($_POST);


      if(mb_strlen($new_password) < 6){
        $errors [] = "<strong>Mot de passe trop court (Minimum 06 caractères)</strong>";
      }else{
        if($new_password != $new_password_confirmation){
          $errors [] = "<strong>Les deux mots de passe ne concordent pas / ne sont pas les mêmes</strong>";
        }
      }

      if(count($errors) == 0){
        $q = $db->prepare("SELECT password AS hashed_password FROM users WHERE (id = :id)AND active = '0'");
        $q->execute([
          'id' => get_session('user_id')
        ]);

        $user = $q->fetch(PDO::FETCH_OBJ);

        if($user && bcrypt_verify_password($current_password , $user->hashed_password)){
          $q = $db->prepare("UPDATE users SET password = :password WHERE id = :id");

          $q->execute([
            'password' => password_hash($new_password , PASSWORD_BCRYPT),
            'id' => get_session('user_id')
          ]);

          set_flash("Votre mot de passe a bel et bien été mis à jour !" , success);
          redirect('profile.php?id='.get_session('user_id'));
        }else{
          save_input_data();
        $errors [] = "<strong>Le mot de passe actuel indiqué est invalide</strong>";
        }

      }
    }else{
      save_input_data();
      $errors [] = "<strong>Veuillez bien remplir tous les champs</strong>";
    }

  }else{
    clear_input_data();
  }

  require ('views/change_password.view.php');


?>
