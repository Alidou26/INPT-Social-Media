<?php

include('../BaseDeDonnees.php');

$req1=$bd->prepare("SELECT * FROM `follow_list` where `id_utilisateur`= ? ");

$req1->execute(array($_SESSION['id_utilisateur']));

if($req1->rowcount() > 0){

    $utilisateurs=$req1->fetchAll();

    foreach($utilisateurs as $U){

        $req2=$bd->prepare("SELECT * FROM `utilisateurs` where `id_utilisateur`= ? ");
        $req2->execute(array($U['id_follower']));

        $info=$req2->fetch();

       

        echo'
        <a href="message.php?pseudo='.$info["pseudo"].'" style="text-decoration:none;"><li class="chat-list-item active">
          <img src="'.$info["photo"].'" alt="">
          <span class="chat-list-name">'.$info['filiere']."__".$info["pseudo"].'
        </li></a>
        ';

       
    }

}


?>