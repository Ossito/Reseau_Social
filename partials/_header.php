
<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>
      <?=
          isset($title)
          ? $title .' - '.WEBSITE_NAME
          : WEBSITE_NAME.', Simple, Rapide et Efficace !';
      ?>
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale = 1">
    <meta name="description" content="Réseau social pour les développeurs passionés">
    <meta name="author" content="IGG Germain">
    <link rel="stylesheet" href="bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="assets/js/google-code-prettify/prettify.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="librairies/uploadify/uploadify.css">
  </head>
  <body>

    <?php include ('partials/_nav.php'); ?>

    <?php include ('partials/_flash.php'); ?>
