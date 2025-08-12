<?php
session_start();

require('../BaseDeDonnees.php');

$reponse=0;


    //verifier que les champs ne sont  pas vide

   if(!empty($_POST['nom'])&&!empty($_POST['prenom'])){
    
    $nom=strtoupper(htmlspecialchars($_POST['nom']));
    $prenom=strtoupper(htmlspecialchars(($_POST['prenom'])));
    $pseudo=$_SESSION['pseudo'];

    //faire la modification

    $enregistreModif=$bd->prepare('UPDATE `utilisateurs` SET 
    `nom`= ?,`prenom`=?  WHERE `id_utilisateur` =?');

    $enregistreModif->execute(array($nom,$prenom,$_SESSION['id_utilisateur'])) ;
    

    //si le mot de passe veut etre modifie
    if(!empty($_POST['mot_de_passe'])){

        //crypter le mot de passe

        $mot_de_passe=password_hash(htmlspecialchars($_POST['mot_de_passe']),PASSWORD_DEFAULT);

        $modifMotDePasse=$bd->prepare("UPDATE `utilisateurs` set `mot_de_passe`= ? where `id_utilisateur`= ? ");

        $modifMotDePasse->execute(array($mot_de_passe,$_SESSION['id_utilisateur']));

    }
    


    //modifier la description

    if(!empty($_POST['description'])){

        $description=$_POST['description'];

        $modifMotDescription=$bd->prepare("UPDATE `utilisateurs` set `description`= ? where `id_utilisateur`= ? ");

        $modifMotDescription->execute(array($description,$_SESSION['id_utilisateur']));

        $_SESSION['description']=$description;

    }

    if(!empty($_FILES['photo']['name'])){

        $dest_photo='../image-utilisateurs/'. $pseudo.$_FILES['photo']['name'];
        $dest='../image-utilisateurs/'. $pseudo.$_FILES['photo']['name'];
        $nom_photo=$_FILES['photo']['name'];
         //verifier l'extension de la photo
           
         $extensionPhoto=strrchr($nom_photo,'.');

         $extensionAutorise=array('.jpg','.JPG','.jpeg','.JPEG','.png','.PNG');

         if(in_array($extensionPhoto,$extensionAutorise)){

             //Deplacer l'image dans le dossier image utilisateur

             //verifier si l'image a ete enregistre dans le dossier

             if(move_uploaded_file($_FILES['photo']['tmp_name'],$dest_photo)){
                
                 //Enregistrer les donnees de l'utilisateurs dans la base de donnees

                 $enregistre=$bd->prepare('UPDATE `utilisateurs` SET `photo`=? WHERE `id_utilisateur`=? ');

                 $enregistre->execute(array($dest,$_SESSION['id_utilisateur']));

                 //mis a jour de les donnees dans la session

                 $_SESSION['photo']=$dest;
                 $_SESSION['nom']=$nom;
                 $_SESSION['prenom']=$prenom;

                //redirection vers ses avis

               $reponse=1;
             }

         }
         else{

            $reponse=-1;

         }
    }

    if(empty($_FILES['photo']['name'])){
    //mettre a jour les valeurs de la session

    $_SESSION['nom']=$nom;
    $_SESSION['prenom']=$prenom;


    //redirection vers ses avis

    $reponse=1;
    }
   }


   echo json_encode($reponse);
?>