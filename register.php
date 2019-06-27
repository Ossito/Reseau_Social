
<?php
    session_start();

    require ('includes/init.php');
    include ('filters/guest_filter.php');

    //Si le formulaire a été soumis c'est-à-dire si le bouton "Inscription" est valider
    if(isset($_POST['register'])){
      //Vérifiacation de tous les champs si ils sont vides ou pas
      if(not_empty(['name', 'pseudo' , 'email' , 'password' , 'password_confirm'])){

        $errors = []; //Création de tableau pour afficher nos diverses erreurs;
        extract($_POST);

        if(mb_strlen($pseudo) < 3){
          $errors [] = "<strong>Pseudo trop court (Minimum 03 caractères)</strong>";
        }

        if(!filter_var($email , FILTER_VALIDATE_EMAIL)){
          $errors [] = "<strong>Votre adresse mail n'est pas valide</strong>";
        }

        if(mb_strlen($password) < 6){
          $errors [] = "<strong>Mot de passe trop court (Minimum 06 caractères)</strong>";
        }else{
          if($password != $password_confirm){
            $errors [] = "<strong>Les deux mots de passe ne concordent pas / ne sont pas les mêmes</strong>";
          }
        }

        if(is_already_in_use('pseudo' , $pseudo , 'users')){
          $errors [] = "<strong>Le pseudo est déjà utilisé<strong>";
        }


        if(is_already_in_use('email' , $email , 'users')){
          $errors [] = "<strong>L'adresse mail est déjà utilisé</strong>";
        }

        if(count($errors) == 0){
            //Envoi d'un mail de confirmation à l'utilisateur
            $to = $email;
            $subject = WEBSITE_NAME." - ACTIVATION DE COMPTE";
            $password = bcrypt_hash_password($password);
            $token = sha1($pseudo.$email.$password);

            ob_start(); // Garder les informations dans la mémoire tampon pour les réutilisera après;
            require('templates/emails/activation.tmpl.php');
            $content = ob_get_clean();

            $headers = 'MIME- Version: 1.0' . "\r\n";
            $headers .= 'Content type: text/html; charset=iso-8859-1' . "\r\n";

            mail ($to , $subject , $content , $headers);

            //Informer l'utilisateur que le mail a bien été envoyé
            set_flash ("Enregistrement bien effectuée , vous pouvez vous connecter" , 'success');


            $q = $db->prepare("INSERT INTO users (name,pseudo,email,password) VALUES(:name,:pseudo,:email,:password)");
            $q->execute([
              'name' => $name,
              'pseudo' => $pseudo,
              'email' => $email,
              'password' => $password
            ]);


            $q = $db->prepare("SELECT id, email , password FROM users WHERE pseudo = ?");
            $q->execute([$pseudo]);
            $data = $q->fetch(PDO::FETCH_OBJ);


            $q = $db->prepare("INSERT INTO friends_relationships (user_id1 , user_id2 , status) VALUES(?,?,?)");
            $q->execute([$data->id ,$data->id , '2']);


            redirect ('login.php');
        }else{
          save_input_data();
        }

      }else{
        $errors [] = "<strong>Veuillez svp remplir tous les champs !</strong>";
        save_input_data();
      }
    }else{
      clear_input_data();
    }
?>


<?php require ('views/register.view.php'); ?>
