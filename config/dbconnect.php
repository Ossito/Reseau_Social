<?php

  // Les différents paramètres de la base de données
  define ('DB_HOST' , 'localhost');
  define ('DB_NAME' , 'social');
  define ('DB_USERNAME' , 'root');
  define ('DB_PASSWORD' , '');

  //Connexion à la base de données
  try{
    $db = new PDO ("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME , DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  }catch(PDOException $e){
    die ('Erreur'.$e->getMessage());
  }

?>
