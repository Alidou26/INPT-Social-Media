<?php 

require('../BaseDeDonnees.php');

if(!empty($_POST['message'])){

    //recuperer les donnees

    $pseudo_recepteur=htmlspecialchars($_POST['pseudo_recepteur']);
    $pseudo_envoyeur=htmlspecialchars($_POST['pseudo_envoyeur']);
    $message=htmlspecialchars($_POST['message']);

    $enregistreMessage=$bd->prepare('INSERT INTO `messages`(`pseudo_envoyeur`,`pseudo_recepteur`,`message`) 
    VALUES(?,?,?) ');

    $enregistreMessage->execute(array($pseudo_envoyeur,$pseudo_recepteur,$message));

}

?>