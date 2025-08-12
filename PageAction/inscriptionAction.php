<?php 

session_start();

require('../BaseDeDonnees.php');

$reponse=-1;


        //mettre les donnees dans des variables
           
        $nom=strtoupper(htmlspecialchars($_POST['nom']));
        $prenom=strtoupper(htmlspecialchars($_POST['prenom']));
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $filiere=htmlspecialchars($_POST['filiere']);
        $mot_de_passe=password_hash(htmlspecialchars($_POST['mot_de_passe']),PASSWORD_DEFAULT);
        $dest_photo='../image-utilisateurs/'. $pseudo.$_FILES['photo']['name'];
        $nom_photo=$_FILES['photo']['name'];



         //verifier si le pseudo n'existe pas deja

         $verifPseudo=$bd->prepare("SELECT `pseudo` from `utilisateurs` WHERE `pseudo` = ?  ");
         $verifPseudo->execute(array($pseudo));

         if($verifPseudo->rowcount() > 0  ){
            $reponse="Ce pseudo existe deja , veuillez choisir un autre un pseudo";

         }
       
         else {


                  //verifier l'extension de la photo
           
            $extensionPhoto=strrchr($nom_photo,'.');

            $extensionAutorise=array('.jpg','.JPG','.jpeg','.JPEG','.png','.PNG');

            if(in_array($extensionPhoto,$extensionAutorise)){

                //Deplacer l'image dans le dossier image utilisateur

                //verifier si l'image a ete enregistre dans le dossier

                if(move_uploaded_file($_FILES['photo']['tmp_name'],$dest_photo)){

                   
                    //Enregistrer les donnees de l'utilisateurs dans la base de donnees

                    $enregistre=$bd->prepare('INSERT INTO `utilisateurs`( `nom`, `prenom`, `pseudo`, `mot_de_passe`, `photo`, `filiere`) 
                    VALUES(? ,? ,? , ?,? ,?)');

                    $enregistre->execute(array($nom,$prenom,$pseudo,$mot_de_passe,$dest_photo,$filiere));

                    //recuperer les informations de l'utilisateurs nouvellement inscris dans la premiere etape

                    $verifUtilisateur=$bd->prepare("SELECT * from `utilisateurs` WHERE `pseudo` = ?  ");
                    $verifUtilisateur->execute(array($pseudo));

                    $utilisateur=$verifUtilisateur->fetch();

                                    //on met a jour son status dans la base de donnee

                $changeStatus=$bd->prepare('UPDATE `utilisateurs` SET `status`= ? WHERE `id_utilisateur`= ? ');
                $changeStatus->execute(array('CONNECTE',$utilisateur['id_utilisateur']));

                                    //integrer au groupe de sa filiere

                $req=$bd->query('SELECT * FROM `groupe` where `nom_groupe`="'.$filiere.'" ');
                $res1=$req->fetch();

                $req12=$bd->prepare("INSERT INTO `membregroupe`(`id_utilisateur`,`id_groupe`) values (?,?)");
                $req12->execute(array($utilisateur['id_utilisateur'],$res1['id_groupe']));

                    $reponse=0; 

                    
                }

                else{
                    $reponse="une erreur est survenu , l'image n'a pas ete enregistree !";
                }

            }
            else{

                $reponse="veuillez choisir une photo en jpg ou png !";

            }
            
         

         }
         
         

    //RETOUR DE LA REPONSE

    echo json_encode($reponse);








?>