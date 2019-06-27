

<?php

  session_start();
  
  //Supprimer l'entrée au niveau de la base de données
  require ('config/dbconnect.php');

  $q = $db->prepare("DELETE FROM auth_tokens WHERE user_id = ? ");

  $q->execute([$_SESSION['user_id']]);

  setcookie('auth' , '' , time()-3600);//Supprimer le cookie y compris ses données

  session_destroy(); //Détruit tous les sessions y compris les données

  $_SESSION = []; //Afin de bien vérifier que les sessions ont été bien déconnectés on va créer un tableau vide

  header('Location: login.php');

?>
