<?php

session_start();

require('../BaseDeDonnees.php');

if(!empty($_POST['pseudo_recepteur'])){

$pseudo_envoyeur=$_SESSION['pseudo'];
$pseudo_recepteur=htmlspecialchars($_POST['pseudo_recepteur']);

$requ=$bd->query("SELECT * FROM `utilisateurs` WHERE `pseudo`='$pseudo_recepteur' ");
$infoU=$requ->fetch();


//recuperer les messages qui concernent les deux utilisateurs en question

$recupMessage=$bd->prepare('SELECT * FROM `messages`  WHERE ( `pseudo_envoyeur` = ? AND pseudo_recepteur= ?)
OR (`pseudo_envoyeur`= ? AND `pseudo_recepteur`= ?) ');

$recupMessage->execute(array($pseudo_envoyeur,$pseudo_recepteur,$pseudo_recepteur,$pseudo_envoyeur));

//verifier s'ils se sont deja envoyes un message

If($recupMessage->rowcount() > 0){

    while($message=$recupMessage->fetch()){

        if($message['pseudo_envoyeur'] == $pseudo_envoyeur){

       echo '
       <div class="message-wrapper reverse">
       <img class="message-pp" src="'.$_SESSION["photo"].'" alt="">
       <div class="message-box-wrapper">
         <div class="message-box">'.
          $message["message"].'
         </div>
         <span>'.$message["date_envoi"].'</span>
       </div>
     </div>
   ';

        }
        else{

            echo'
            <div class="message-wrapper">
            <img class="message-pp" src="'.$infoU["photo"].'" alt="">
            <div class="message-box-wrapper">
              <div class="message-box">'.
               $message["message"].'
              </div>
              <span>'.$message["date_envoi"].'</span>
            </div>
          </div>
            ';


        }
    }

}

else {
     echo '

         <p style="color:white;">Aucun Message</p>
    
     
     ';
}


}


?>