<?php 

session_start();

$reponse=[];


require('../BaseDeDonnees.php');


    //enregistrer les donnees dans des variables

    $pseudo=htmlspecialchars($_POST['pseudo']);
    $mot_de_passe=htmlspecialchars($_POST['mot_de_passe']);

    //verifier si l'utilisateur existe
    
    $verifUtilisateur=$bd->prepare("SELECT * from `utilisateurs` WHERE `pseudo` = ?  ");
    $verifUtilisateur->execute(array($pseudo));

    if($verifUtilisateur->rowcount() > 0){
        
        //verifier le mot de passe
       
    $utilisateur=$verifUtilisateur->fetch();
    

    if(password_verify($mot_de_passe,$utilisateur['mot_de_passe'])){

                //on met a jour son status dans la base de donnee

                $changeStatus=$bd->prepare('UPDATE `utilisateurs` SET `status`= ? WHERE `id_utilisateur`= ? ');
                $changeStatus->execute(array('CONNECTE',$utilisateur['id_utilisateur']));

                session_regenerate_id();

           //On cree une SESSION pour l'utilisateur

           $_SESSION['utilisateur_connecte']=true;
           $_SESSION['id_utilisateur']=$utilisateur['id_utilisateur'];
           $_SESSION['nom']=$utilisateur['nom'];
           $_SESSION['prenom']=$utilisateur['prenom'];
           $_SESSION['pseudo']=$utilisateur['pseudo'];
           $_SESSION['photo']=$utilisateur['photo'];
           $_SESSION['status']=$utilisateur['status'];
           $_SESSION['derniere_connexion']=$utilisateur['derniere_connexion'];
           $_SESSION['filiere']=$utilisateur['filiere'];
           $_SESSION['date_inscription']=$utilisateur['date_inscription'];
       
        $reponse['status']=0;
  
        //url de redirection
        $reponse['url']="Page/home.php";
    }

    else {
        $reponse['status']="Votre mot de passe est incorrect !";
    }

    }
else {
    $reponse['status']="Vous etes pas encore inscrit !";
}


//Retourner la reponse

echo json_encode($reponse);