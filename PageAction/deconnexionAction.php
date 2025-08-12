<?php

session_start();

require('../BaseDeDonnees.php');

date_default_timezone_set('Africa/Casablanca');

//Enregistre la date de deconnexion comme derniere connexion et changer le status dans la base de donnee



$derniereConnexion=$bd->prepare('UPDATE `utilisateurs` SET `derniere_connexion`= ? , `status`= ?
 WHERE `id_utilisateur`= ? ');
 $derniereConnexion->execute(array(date('Y-m-d H:i:s'),'DECONNECTE',$_SESSION['id_utilisateur']));


//mettre tous les donnees dans un tableau

$_SESSION=array();

//supprimer la session

session_destroy();

//redirection vers l'index

header('location: ../index.php');



?>