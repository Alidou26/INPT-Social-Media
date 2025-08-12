<?php

include('../BaseDeDonnees.php');

$req1=$bd->query("SELECT COUNT(*) as `total` FROM `follow_list` where `id_utilisateur`={$_SESSION['id_utilisateur']}");

if($req1->rowcount() > 0){

    $nombre=$req1->fetch();
}

else{
    $nombre['total']=0;
}


?>