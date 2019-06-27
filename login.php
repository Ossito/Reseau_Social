
<?php
    session_start();

    require ('includes/init.php');
    include ('filters/guest_filter.php');


    //Si le formulaire a été soumis c'est-à-dire si le bouton "Inscription" est valider
    if(isset($_POST['login'])){
      //Vérification de tous les champs si ils sont vides ou pas
      if(not_empty(['identifiant' , 'password'])){

        extract($_POST);

        $q = $db->prepare("SELECT id,pseudo,avatar,password AS hashed_password,email FROM users WHERE (pseudo = :identifant OR email = :identifant )AND active = '0'");
        $q->execute([
          'identifant' => $identifiant
        ]);

        $user = $q->fetch(PDO::FETCH_OBJ);

        if($user && bcrypt_verify_password($password , $user->hashed_password)){

          $_SESSION['user_id'] = $user->id;
          $_SESSION['pseudo'] = $user->pseudo;
          $_SESSION['avatar'] = $user->avatar;
          $_SESSION['email'] = $user->email;

          //Si l'utilisateur choisi de garder sa session active
          if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'on'){
            remember_me($user->id);
          }

          //redirect_intent_or('profile.php?id='.$user->id);
          redirect_intent_or('index.php');
        }else{
          set_flash('Combinaison Identifiant / Mot de passe incorrect' , 'danger');
          save_input_data();
        }

      }else{
        $errors [] = "<strong>Champs non remplis !</strong>";
      }
    }else{
      clear_input_data();
    }
?>


<?php require ('views/login.view.php'); ?>
