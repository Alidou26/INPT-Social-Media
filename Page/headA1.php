<?php  session_start();

  require('../BaseDeDonnees.php');

  if(!isset($_SESSION['utilisateur_connecte'])){
    header('Location:index.php');
  }
  require('functions.php');
  $poste=filterPosts();
  $follow=filterFollowSuggestion();
  $demandes=DonneesDemande();
  $groupe= getUserGroupe($_SESSION['id_utilisateur']);
  $groupes=AllUsergroupe();
  $utilisateurs= getAllUser();
?>