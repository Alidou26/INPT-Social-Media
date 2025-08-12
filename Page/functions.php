<?php

require("../BaseDeDonnees.php");

//obtenier les infos d`un utilisateur grace a son id
function getUser($user_id){
    global $bd;
    $query=$bd->prepare("SELECT * FROM utilisateurs WHERE id_utilisateur=?");
    $query->execute(Array($user_id));
    $run= $query->fetch();
 return  $run;

}
//obtenir tous les utilisateurs 

function getAllUser(){
    global $bd;
    $query=$bd->prepare("SELECT * FROM utilisateurs");
    $query->execute();
    $run= $query->fetchAll();
 return  $run;

}
//....................................groupe........................


function AllUsergroupe(){
    global $bd;
    $query=$bd->prepare("SELECT*FROM groupe");
    $query->execute();
    $run= $query->fetchAll();
 return  $run;

}
//fonction pour la suggestion de groupe a partir de la filiere de l`administrateur

function getGroupeSuggestions(){
    global $bd;
    $filiere=$_SESSION['filiere'];
    $id=$_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT * FROM groupe WHERE filiere_admin=?");
    $query->execute(Array($filiere));
    $run= $query->fetchAll();
    return  $run;
}

//renvoi 1 si l`utilisateur appartient au groupe 0 si non

function UserGroupe($id_groupe){
    global $bd;
    $id=$_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT count(*) as nombre FROM membregroupe WHERE id_utilisateur=? and id_groupe=?");
    $query->execute(Array($id,$id_groupe));
    $run= $query->fetch();
    return  $run['nombre'];
}

//filter les suggestions de groupe en retirant les groupes deja integrer et limitant le nombre a moin de 5

function filterGroupeSuggestions(){

    $list = getGroupeSuggestions();

    $filter_list  = array();
    foreach($list as $user){
        if(!UserGroupe($user['id_groupe']) &&count($filter_list)<5){
         $filter_list[]=$user;
        }
    }
    
    return $filter_list;
    }

//fonction pour obtenir les commentaire d`un poste de groupe
function getCommentGroupe($post_id){
    global $bd;
    $query=$bd->prepare("SELECT * FROM commentairegroupe,utilisateurs WHERE commentairegroupe.id_utilisateur=utilisateurs.id_utilisateur and id_posteG=? ORDER BY 	id_commentaireG  DESC");
    $query->execute(Array($post_id));
    $run = $query->fetchAll(PDO::FETCH_OBJ);
    return $run;
}

//fonction pour mettre les like a un poste de grouoe
function likeg($post_id){
    global $bd;
    $current_user=$_SESSION['id_utilisateur'];
    $query=$bd->prepare("INSERT INTO likesg(id_posteG,id_utilisateur) VALUES(?,?)");
   
  
   
    return ($query->execute(Array($post_id,$current_user)));
    
}
//fonction pour enlever les like a un poste de grouoe
function unlikeg($post_id){

    global $bd;
    $current_user=$_SESSION['id_utilisateur'];

    $query=$bd->prepare("DELETE FROM likesg WHERE id_utilisateur=? and id_posteG=?");
   
   $run=$query->execute(Array($current_user,$post_id));

    return $run;
}



//fonction pour obtenir les groupes d`un utilisateur via son id

function getUserGroupe($user_id){
    global $bd;
    $query=$bd->prepare("SELECT*FROM groupe,membregroupe where groupe.id_groupe=membregroupe.id_groupe and membregroupe.id_utilisateur=?");
    $query->execute(Array($user_id));
    $run= $query->fetchAll();
 return  $run;

}
//fonction pour repertorier tous les utilisateurs d`un groupe
function getAllUsergroupe($id_groupe){
    global $bd;
    $query=$bd->prepare("SELECT*FROM utilisateurs,membregroupe where membregroupe.id_utilisateur=utilisateurs.id_utilisateur and membregroupe.id_groupe=?");
    $query->execute(Array($id_groupe));
    $run= $query->fetchAll();
 return  $run;

}

// obtenir les infos d`un groupe par id 

function getGroupe($id){
    global $bd;
    $query=$bd->prepare("SELECT * FROM groupe where id_groupe=?");
    $query->execute(Array($id));
    $run= $query->fetch();
 return  $run;

}

//fonction pour obtnir tous les likes d`un poste de  groupe

function getLikesGroupe($post_id){
    global $bd;
    $query=$bd->prepare("SELECT count(*) as row FROM likesg WHERE id_posteG=?");
    $query->execute(array($post_id));

    $run = $query->fetch();
    return $run['row'];
}

//fonction pour obtenir les informations de l`utilisateur ayant effectuer le poste sans aussi oublier les infos du poste

function getPosteGroupe($post_id){
    global $bd;
    $query=$bd->prepare("SELECT utilisateurs.id_utilisateur as uid,postgroupe.id_posteG,postgroupe.id_utilisateur,postgroupe.photo_poste,postgroupe.texte,postgroupe.date_poste,utilisateurs.nom,utilisateurs.prenom,utilisateurs.pseudo,utilisateurs.photo FROM postgroupe JOIN utilisateurs ON utilisateurs.id_utilisateur=postgroupe.id_utilisateur where id_groupe=?  ORDER BY id_posteG DESC");
    $query->execute(array($post_id));
    $run =$query->fetchAll();

    return $run;

}


//verifier si un utilisateur a deja liker un poste

function checkLikeStatusGroupe($post_id){
    global $bd;
    $current_user = $_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT count(*) as row FROM likesg WHERE id_utilisateur=? and id_posteG=?");
    $query->execute(array($_SESSION['id_utilisateur'],$post_id));
    $run = $query->fetch();
    return $run['row'];
}

//ajouter un commentaire a un groupe

function addCommentGroupe($post_id,$comment){
    global $bd;
    $current_user=$_SESSION['id_utilisateur'];
    $pseudo=$_SESSION['pseudo'];
    $query=$bd->prepare("INSERT INTO commentairegroupe(id_utilisateur,	id_posteG,commentaireG) VALUES(?,?,?)");
    return  $query->execute(Array($current_user,$post_id,$comment));
    
}

// integrer un groupe

function integrerGroupe($id_groupe){
    global $bd;
    $id = $_SESSION['id_utilisateur'];

    $queryA=$bd->prepare("SELECT * FROM membregroupe where id_utilisateur=? and id_groupe=? ");
    $queryA->execute(Array($id,$id_groupe));
    $verif=$queryA->fetch();

    if(empty($verif['id_Membregroupe'])){

    $query=$bd->prepare("INSERT INTO membregroupe(id_utilisateur,id_groupe) VALUES (?,?)");
   return $query->execute(Array($id,$id_groupe));
  
    }

}

//fin groupe.................................................

//compter le nombre de membre d`un groupe

function NbrMenbre($id){
    global $bd;
    $query=$bd->prepare("SELECT count(*) as nombre FROM membregroupe WHERE id_groupe=?");
    $query->execute(Array($id));
    $run = $query->fetch();
    return $run['nombre'];

}
  
//compter le nombre de follower d`un groupe

function NbrFollower($user_id){
    global $bd;
    $query=$bd->prepare("SELECT count(*) as nombre FROM follow_list WHERE id_utilisateur=?");
    $query->execute(Array($user_id));
    $run = $query->fetch();
    return $run['nombre'];

}

// stocker les demandes d`abonnement
function invitation($user_id){
    global $bd;

    $queryA=$bd->prepare("SELECT * FROM invitation WHERE id_utilisateur=? AND id_demandeur=? ");
    $queryA->execute(Array($user_id,$_SESSION['id_utilisateur']));
    $verif1=$queryA->fetch();

    $queryB=$bd->prepare("SELECT * FROM follow_list WHERE id_utilisateur=? AND id_follower=? ");
    $queryB->execute(Array($user_id,$_SESSION['id_utilisateur']));
    $verif2=$queryB->fetch();

    

    if(empty($verif1['id_invitation'])  && empty($verif2['id'])){
    $query=$bd->prepare("INSERT INTO invitation(id_utilisateur, id_demandeur) values(?,?)");
    $run=$query->execute(Array($user_id,$_SESSION['id_utilisateur']));
    }

 return  $run;

}

function accepterInvitation($user){
    global $bd;

    $current_user= $_SESSION['id_utilisateur'];

    // follow recriproquement

    $query1=$bd->prepare("INSERT INTO follow_list(id_utilisateur,id_follower) VALUES(?,?)");
         
    $query2=$bd->prepare("INSERT INTO follow_list(id_utilisateur,id_follower) VALUES(?,?)");

    $query1->execute(Array($current_user,$user));

    $query2->execute(Array($user,$current_user));
     
    //supprimer l`invitation apres l`acceptation
    return supprimerInvitation($user);

}

//refuser la demande d`abonnement

function supprimerInvitation($user_id){
    global $bd;
    $query=$bd->prepare("DELETE FROM invitation where id_utilisateur=? and id_demandeur=?");
    $run=$query->execute(Array($_SESSION['id_utilisateur'],$user_id));

 return  $run;

}

// fonction pout recuperer toutes les demandes d`abonnement

function LesDemandes(){
    global $bd;
    $query=$bd->prepare("SELECT * FROM invitation WHERE id_utilisateur=?");
    $query->execute(Array($_SESSION['id_utilisateur']));
    $run= $query->fetchAll();
    return  $run;
}

function DonneesDemande(){
    $list=LesDemandes();// recuperation des l`identifiants

    $filter= array();
    foreach($list as $user){
     
         $filter[]=getUser($user['id_demandeur']);
        
    }
    
    return $filter;
    }

    //verifier si un utilisateur a deja envoyer de demande pour eviter de l`afficher au niveau de la suggestion

    function verificationD($id){
        global $bd;
        $query=$bd->prepare("SELECT count(*) as nombre  FROM invitation WHERE (id_utilisateur=? and id_demandeur=?) or (id_utilisateur=? and id_demandeur=?) ");
        $query->execute(Array($_SESSION['id_utilisateur'],$id,$id,$_SESSION['id_utilisateur']));
        $run= $query->fetch();
        return  $run['nombre'];
    }

//function fonction pour suivre un utilisateur

function followUser($user){
    global $bd;
   // $cu = getUser($_SESSION['userdata']['id']);
    $current_user= $_SESSION['id_utilisateur'];
    $query=$bd->prepare("INSERT INTO follow_list(id_utilisateur,id_follower) VALUES(?,?)");
    $run= $query->execute(Array($current_user,$user));
    return  $run;
    
}


//obenir les suggestion d`ami
function getFollowSuggestions(){
    global $bd;
    $filiere=$_SESSION['filiere'];
    $id=$_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT * FROM utilisateurs WHERE filiere=? and id_utilisateur not LIKE ?");
    $query->execute(Array($filiere,$id));
    $run= $query->fetchAll();
    return  $run;
}


//filtrer les suggestion

function filterFollowSuggestion(){

    $list = getFollowSuggestions();

    $filter_list  = array();
    foreach($list as $user){
        if(!checkFollowStatus($user['id_utilisateur'])  && count($filter_list)<5 && verificationD($user['id_utilisateur'])==0){
         $filter_list[]=$user;
        }
    }
    
    return $filter_list;
    }
    

//ami en commun

function commun($id){
    global $bd;
    $current_user = $_SESSION['id_utilisateur'];

    $query=$bd->prepare("SELECT count(*)  as row FROM follow_list WHERE id_utilisateur=? and  id_follower in (

       SELECT id_utilisateur FROM follow_list WHERE  id_follower=?
    )");
        $query->execute(Array($current_user,$id));

         $run = $query->fetch();
          return $run['row'];
}





//verifier si l`utilisateur est abonne a l`utilisateur
function checkFollowStatus($user){
    global $bd;
    $current_user = $_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT count(*) as row FROM follow_list WHERE id_utilisateur=? and id_follower=?");
    $query->execute(Array($current_user,$user));
  
    $run = $query->fetch();
    return $run['row'];
}



//verifier si l`utilisateur est bloque
function checkBS($id){
    global $bd;
    $current_user = $_SESSION['id_utilisateur'];

    $query=$bd->prepare("SELECT count(*) as row FROM block_list WHERE id_utilisateur=? and id_ubloque=?");

    $query->execute(Array($current_user,$id));
    $run = $query->fetch();
    return $run['row'];
}






//fonction pour ecrire un commentaire

function addComment($post_id,$comment){
    global $bd;
    $current_user=$_SESSION['id_utilisateur'];
    $pseudo=$_SESSION['pseudo'];
    $query=$bd->prepare("INSERT INTO comments(id_utilisateur,id_poste,commentaire,date_creation) VALUES(?,?,?,current_timestamp())");
    return  $query->execute(Array($current_user,$post_id,$comment));
    
}




//fonction pour obtenir les poste

function getPosterId($post_id){
    global $bd;
    $query=$bd->prepare("SELECT id_utilisateur FROM posts WHERE id_poste=?");
    $query->execute(Array($post_id));
 $run =$query->fetch();
 return $run['id_utilisateur'];

}

//pour liker le poste d`un utilisateur
function like($post_id){
    global $bd;
    $current_user=$_SESSION['id_utilisateur'];
    $query=$bd->prepare("INSERT INTO likes(id_poste,id_utilisateur) VALUES(?,?)");
   
  
   
    return ($query->execute(Array($post_id,$current_user)));
    
}

function Userlike($post_id){
    global $bd;
    $current_user=$_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT *FROM utilisateurs,likes,posts where posts.id_poste=likes.id_poste and utilisateurs.id_utilisateur=likes.id_utilisateur and posts.id_poste=? limit 3" );
   
    $query->execute(Array($post_id));

    $run =$query->fetchAll(PDO::FETCH_OBJ);
    return  $run;
    
}


//function for unlike the post
function unlike($post_id){

    global $bd;
    $current_user=$_SESSION['id_utilisateur'];

    $query=$bd->prepare("DELETE FROM likes WHERE id_utilisateur=? and id_poste=?");
   
   $run=$query->execute(Array($current_user,$post_id));

    return $run;
}




//function for getting likes count
function getComments($post_id){
    global $bd;
    $query=$bd->prepare("SELECT * FROM comments,utilisateurs WHERE comments.id_utilisateur=utilisateurs.id_utilisateur and id_poste=? ORDER BY 	id_commentaire DESC");
    $query->execute(Array($post_id));
    $run = $query->fetchAll(PDO::FETCH_OBJ);
    return $run;
}



//for getting userdata by username
function getUserByUsername($username){
    global $bd;
    $query=$bd->prepare( "SELECT * FROM utilisateurs WHERE pseudo=?");
    $query->execute(Array($username));
 
    $run =$query->fetchAll();
    return $run;
}

//for getting posts
function getPost(){
    global $bd;
    $query=$bd->prepare("SELECT utilisateurs.id_utilisateur as uid,posts.id_poste,posts.id_utilisateur,posts.poste_image,posts.poste_texte,posts.date_poste,utilisateurs.nom,utilisateurs.prenom,utilisateurs.pseudo,utilisateurs.photo FROM posts JOIN utilisateurs ON utilisateurs.id_utilisateur=posts.id_utilisateur ORDER BY id_poste DESC");
    $query->execute();
    $run =$query->fetchAll();

    return $run;

}

// rechercher les postes d`un utilisateur
function posteUtilisateur($id){

    global $bd;
    $query=$bd->prepare("SELECT utilisateurs.id_utilisateur as uid,posts.id_poste,posts.id_utilisateur,posts.poste_image,posts.poste_texte,posts.date_poste,utilisateurs.nom,utilisateurs.prenom,utilisateurs.pseudo,utilisateurs.photo FROM posts JOIN utilisateurs ON utilisateurs.id_utilisateur=posts.id_utilisateur where utilisateurs.id_utilisateur=? ORDER BY id_poste DESC");
    $query->execute(array($id));
    $run =$query->fetchAll();

    return $run;
}


function unfollowUser($user_id){
    global $bd;
    $current_user=$_SESSION['id_utilisateur'];
 
    $query=$bd->prepare(" DELETE FROM follow_list WHERE id_follower=? and id_utilisateur=?");

    $run=$query->execute(Array( $current_user,$user_id));
 
    return  $run;
    
}


function deletePost($post_id){
    global $bd;
   

    $dellike=$bd->prepare("DELETE FROM likes WHERE id_poste=? and id_utilisateur=?");
    $dellike->execute(Array($post_id,$_SESSION['id_utilisateur']));
 
    $delcom=$bd->prepare("DELETE FROM comments WHERE id_poste=? and id_utilisateur=?");

    $delcom->execute(Array($post_id,$_SESSION['id_utilisateur']));

    $query=$bd->prepare("DELETE FROM posts WHERE id_poste=?");
   
    
    return $query->execute(Array($post_id));
}

// POUR OBTENIR TOUT LES POSTE

function filterPosts(){
    $list = getPost();
    $filter_list  = array();
    foreach($list as $post){
        if(checkFollowStatus($post['id_utilisateur']) || $post['id_utilisateur']==$_SESSION['id_utilisateur']){
         $filter_list[]=$post;
        }
    }
    
    return $filter_list;
    }


    function userOnline(){
        global $bd;
             $list  = array();
            $query=$bd->prepare("SELECT*FROM `utilisateurs` WHERE  `status`='CONNECTE' ");
            $query->execute();
         $run= $query->fetchAll();
                             foreach($run as $user){
                                if(checkFollowStatus($user['id_utilisateur'])==1 ){
                                    $list[]= $user;  
                                }
                             }
      return  $list;
        }
    
    

//function checkLikeStatus
function checkLikeStatus($post_id){
    global $bd;
    $current_user = $_SESSION['id_utilisateur'];
    $query=$bd->prepare("SELECT count(*) as row FROM likes WHERE id_utilisateur=? and id_poste=?");
    $query->execute(array($_SESSION['id_utilisateur'],$post_id));
    $run = $query->fetch();
    return $run['row'];
}

//function for getting likes count
function getLikes($post_id){
    global $bd;
    $query=$bd->prepare("SELECT count(*) as row FROM likes WHERE id_poste=?");
    $query->execute(array($post_id));

    $run = $query->fetch();
    return $run['row'];
}


//for searching the users
function recherche($mot){
    global $bd;

    $query=$bd->prepare("SELECT * FROM utilisateurs WHERE nom LIKE '%".$mot."%' or prenom LIKE '%".$mot."%' or pseudo LIKE '%".$mot."%' LIMIT 5");
    $query->execute();

    $run = $query->fetchAll();

 return $run;

}



   
?>