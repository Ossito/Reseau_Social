

<?php
  session_start();


  require ('includes/init.php');
  include ('filters/auth_filter.php');
  
  
  if(!empty($_GET['id']) && $_GET['id'] === get_session('user_id')){
    //Récupérer les informations de l'utilisateur de la base de données en utilisant son id
    $user = find_user_by_id($_GET['id']);

    if(!$user){
      redirect('index.php');
    }

  }else{
    redirect('profile.php?id='.get_session('user_id'));
  }


  //Si le formulaire a été soumis c'est-à-dire si le bouton "Inscription" est valider
  if(isset($_POST['update'])){
    //Vérifiacation de tous les champs si ils sont vides ou pas
    if(not_empty(['name' , 'city' , 'country' , 'sex' , 'bio'])){

        $errors = [];
        extract($_POST);

        $q = $db->prepare("UPDATE users SET name = :name , city = :city , country = :country , sex = :sex , facebook = :facebook , instagram = :instagram , available_for_hiring = :available_for_hiring , bio = :bio WHERE id = :id ");
        $q->execute([
          'name' => $name,
          'city' => $city,
          'country' => $country,
          'sex' => $sex,
          'facebook' => $facebook,
          'instagram' => $instagram,
          'available_for_hiring' => !empty($available_for_hiring) ? '1' : '0',
          'bio' => $bio,
          'id' => $_SESSION['user_id']
        ]);

        set_flash("Félicitations, votre profil a bien été mis à jour !");
        redirect('profile.php?id='.get_session('user_id'));
      
    }else{
      save_input_data();
      $errors [] = "Veuillez remplir tous les champs marqués par une astérisque(*)";
    }
  }

  require ('views/edit_user.view.php');

?>
