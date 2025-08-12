
<?php  session_start();

  require('../BaseDeDonnees.php');

  if(!isset($_SESSION['utilisateur_connecte'])){
    header('Location:index.php');
  }
  require('functions.php');

  $id_groupe=$_GET['id'];
$groupe=getGroupe($_GET['id']);
$poste= getPosteGroupe($_GET['id']);
$suggestion=filterGroupeSuggestions();
$user=getAllUsergroupe($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./stylep.css">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./style.css">
     <link rel="stylesheet" href="./stylep2.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

</head>