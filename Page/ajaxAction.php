<?php
require_once 'functions.php';

session_start();


if(isset($_GET['follow'])){

    $user_id = $_POST['user_id'];

    if( accepterInvitation( $user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

//retirer du groupe

if(isset($_GET['retirerGroupe'])){

    $id_groupe= $_GET['id'];
    $id_user=$_GET['retirerGroupe'];

    $dellike=$bd->prepare("DELETE FROM membregroupe WHERE id_groupe=? and id_utilisateur=?");
    $dellike->execute(Array($id_groupe,$id_user));
    header("location:groupe.php?id=$id_groupe");
    echo json_encode($response);
}



//envoyer une invitation

if(isset($_GET['invitation'])){
    $user_id = $_POST['user_id'];


    if(invitation($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

//envoyer une invitation via recherche

if(isset($_GET['invitationH'])){

    $user_id =$_GET['invitationH'];

    if(invitation($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }
    header("location:home.php");
    echo json_encode($response);
}

//integer un groupe

if(isset($_GET['integrerGroupe'])){
    $id_groupe = $_POST['id_groupe'];


    if(integrerGroupe($id_groupe)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}

//integer un groupe via la recherche

if(isset($_GET['integrerGroupeHome'])){

    $id_groupe =$_GET['integrerGroupeHome'];

    if(integrerGroupe($id_groupe)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }
    header("location:home.php");

    echo json_encode($response);
}

 
//refuser une invitation

if(isset($_GET['refuser'])){

    $user_id = $_POST['user_id'];


    if(supprimerInvitation($user_id)){
        $response['status']=true;
    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}


//poste de groupe
if(isset($_GET['posteGroupe'])){

    $response['status']=true;

    $user_id=$_SESSION['id_utilisateur'];

    if(!empty($_POST['texte'] )){

    if(!empty($_FILES['photoVideo']['tmp_name'])){

       $image_name = time().basename($_FILES['photoVideo']['name']);
       $image_dir="posteGroupe/$image_name";
       move_uploaded_file($_FILES['photoVideo']['tmp_name'],$image_dir);
   
       $query=$bd->prepare("INSERT INTO postgroupe(id_groupe,id_utilisateur,texte,photo_poste,date_poste)VALUES (?,?,?,?,current_timestamp())");
      $query->execute(Array($_POST['id_groupe'],$user_id,$_POST['texte'],$image_dir));
      $response['status']=true;
 
  }else{
    $query=$bd->prepare("INSERT INTO postgroupe(id_groupe,id_utilisateur,texte,date_poste)VALUES (?,?,?,current_timestamp())");
    $query->execute(Array($_POST['id_groupe'],$user_id,$_POST['texte']));
    $response['status']=true;
    }

 
}else if(!empty($_FILES['photoVideo'])){


   $image_name = time().basename($_FILES['photoVideo']['name']);
   $image_dir="posteGroupe/$image_name";
   move_uploaded_file($_FILES['photoVideo']['tmp_name'],$image_dir);

   $query=$bd->prepare("INSERT INTO postgroupe(id_groupe,id_utilisateur,photo_poste,date_poste)VALUES (?,?,?,current_timestamp())");
   $query->execute(Array($user_id,$_POST['id_groupe'],$image_dir));
   $response['status']=true;
}

 echo json_encode($response);
 }


//for managing add post
if(isset($_GET['addpost'])){

    $response['status']=true;

    $user_id=$_SESSION['id_utilisateur'];
    $pseudo=$_SESSION['pseudo'];
    if(!empty($_POST['texte'] )){

    if(!empty($_FILES['photoVideo']['name'])){

       $image_name = time().basename($_FILES['photoVideo']['name']);
       $image_dir="poste/$image_name";
       move_uploaded_file($_FILES['photoVideo']['tmp_name'],$image_dir);
   
       $query=$bd->prepare("INSERT INTO posts(id_utilisateur,poste_texte,poste_image,date_poste)VALUES (?,?,?,current_timestamp())");
      $query->execute(Array($user_id,$_POST['texte'],$image_dir));
      $response['status']=true;
 
  }else{

    $query=$bd->prepare("INSERT INTO posts(id_utilisateur,poste_texte,date_poste)VALUES (?,?,current_timestamp())");
    $query->execute(Array( $user_id,$_POST['texte']));
    $response['status']=true;

  }


  
  
 
}else if(!empty($_FILES['photoVideo'])){


   $image_name = time().basename($_FILES['photoVideo']['name']);
   $image_dir="poste/$image_name";
   move_uploaded_file($_FILES['photoVideo']['tmp_name'],$image_dir);

   $query=$bd->prepare("INSERT INTO posts(id_utilisateur,poste_image,date_poste)VALUES (?,?,current_timestamp())");
  $query->execute(Array($user_id,$image_dir));
 
  $response['status']=true;

}

 echo json_encode($response);
 }



 



//for managing add post
if(isset($_GET['groupe'])){

    $response['status']=true;

    $user_id=$_SESSION['id_utilisateur'];

    if(!empty($_POST['nom'] )){

    if(!empty($_FILES['photo']['name'])){

       $image_name = time().basename($_FILES['photo']['name']);
       $image_dir="groupe/$image_name";
       move_uploaded_file($_FILES['photo']['tmp_name'],$image_dir);
   
       $query=$bd->prepare("INSERT INTO groupe(nom_groupe,id_administrateur,photo_groupe,filiere_admin)VALUES (?,?,?,?)");
      $query->execute(Array($_POST['nom'],$user_id,$image_dir,$_SESSION['filiere']));
      $response['status']=true;
 

  }else{

    $query=$bd->prepare("INSERT INTO groupe(nom_groupe,id_administrateur,filiere_admin)VALUES (?,?,?)");
    $query->execute(Array($_POST['nom'],$user_id,$_SESSION['filiere']));
    $response['status']=true;
  }

  $query1=$bd->prepare("SELECT id_groupe FROM groupe where id_administrateur=? order by id_groupe desc limit 1");
  $query1->execute(Array($user_id));
  $run1= $query1->fetch();

//ajouter l`administrateur dans le groupe
  $query=$bd->prepare("INSERT INTO membregroupe(id_utilisateur,id_groupe)VALUES (?,?)");
  $query->execute(Array($user_id, $run1['id_groupe']));

}

 echo json_encode($response);
 }







          if(isset($_GET['modifierInfoGroupe'])){

       $response['status']=true;

         $groupe=$_POST['id_groupe'];


    if(!empty($_POST['nom'] ) && !empty($_FILES['photo']['name'])){


       $image_name = time().basename($_FILES['photo']['name']);
       $image_dir="groupe/$image_name";
       move_uploaded_file($_FILES['photo']['tmp_name'],$image_dir);
   
       $query=$bd->prepare(" UPDATE  groupe set nom_groupe=?, photo_groupe=? where id_groupe=?");
      $query->execute(Array($_POST['nom'],$image_dir,$groupe));
      $response['status']=true;
 

 

}else if(!empty($_FILES['photo']['name'])){
    
    $image_name = time().basename($_FILES['photo']['name']);
    $image_dir="groupe/$image_name";
    move_uploaded_file($_FILES['photo']['tmp_name'],$image_dir);

    $query=$bd->prepare(" UPDATE groupe set photo_groupe=? where id_groupe=?");
   $query->execute(Array($image_dir,$groupe));

   $response['status']=true;

}else{
    $query=$bd->prepare(" UPDATE groupe set nom_groupe=? where id_groupe=?");
    $query->execute(Array($_POST['nom'],$groupe));
    $response['status']=true;

}

 echo json_encode($response);
 }




 if(isset($_GET['likeG'])){
    $post_id = $_POST['post_id'];

    if(!checkLikeStatusGroupe($post_id)){
        if(likeg($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}


if(isset($_GET['unlikeG'])){
    $post_id = $_POST['post_id'];

    if(checkLikeStatusGroupe($post_id)){
        if(unlikeg($post_id)){
            $response['status']=true;
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    }

  
}






 if(isset($_GET['like'])){
        $post_id = $_POST['post_id'];
    
        if(!checkLikeStatus($post_id)){
            if(like($post_id)){
                $response['status']=true;
            }else{
                $response['status']=false;
            }
        
            echo json_encode($response);
        }
    
      
    }
    
    
    if(isset($_GET['unlike'])){
        $post_id = $_POST['post_id'];
    
        if(checkLikeStatus($post_id)){
            if(unlike($post_id)){
                $response['status']=true;
            }else{
                $response['status']=false;
            }
        
            echo json_encode($response);
        }
    
      
    }
    
    
  
if(isset($_GET['addcomment'])){
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $style='bx bx-dots-horizontal-rounded';
        if(addComment($post_id,$comment)){
      $cuser = getUser($_SESSION['id_utilisateur']);
      $time = date("Y-m-d H:i:s");
            $response['status']=true;
            $response['comment']='						
								

                                <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="'.$cuser['photo'].'" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark"><a href="#" class="fs-8">'.$cuser['nom'].' '.$cuser['pseudo'].'</strong>
                                        <a href="#"><i class='.$style.'></i></a>
                                    </div>
                                    <span class="d-block comment-created-time">'.$time.'</span>
                                    <p class="fs-8 pt-2">'.$comment.'</p>
                                    
                                </div>
                            </li>				
        ';
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    

  
}


 
if(isset($_GET['addcommentG'])){
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $style='bx bx-dots-horizontal-rounded';
        if( addCommentGroupe($post_id,$comment)){
      $cuser = getUser($_SESSION['id_utilisateur']);
      $time = date("Y-m-d H:i:s");
            $response['status']=true;
            $response['comment']='						
								

                                <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="'.$cuser['photo'].'" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <strong class="text-gray-dark"><a href="#" class="fs-8">'.$cuser['nom'].' '.$cuser['pseudo'].'</strong>
                                        <a href="#"><i class='.$style.'></i></a>
                                    </div>
                                    <span class="d-block comment-created-time">'.$time.'</span>
                                    <p class="fs-8 pt-2">'.$comment.'</p>
                                    
                                </div>
                            </li>				
        ';
        }else{
            $response['status']=false;
        }
    
        echo json_encode($response);
    

  
}




if(isset($_GET['recherche'])){
    $mots = $_POST['recherche_utilisateur'];
    $resultat = recherche($mots);
    $affichage="";
    if(count( $resultat)>0){
        $response['status']=true;
     

        foreach($resultat as $utilisateur){
            $fbtn='';
        
        
       $affichage.='  
                        <li>
							<div class="freelancer-overview manage-candidates">
										<div class="freelancer-overview-inner">

											<!-- Avatar -->
											<div class="freelancer-avatar">
												<div class="verified-badge"></div>
												<a href="profile.php?u='.$utilisateur['id_utilisateur'].'"><img src="'.$utilisateur['photo'].'" alt=""></a>
											</div>

											<!-- Name -->
											<div class="freelancer-name">
												<h4><a href="#">'.$utilisateur['nom'].' '.$utilisateur['prenom'].' <img class="flag" src="images/flags/de.svg" alt="" title="Germany" data-tippy-placement="top"></a></h4>

												<!-- Details -->
												<span class="freelancer-detail-item"><a href="gmail.com"><i class="icon-feather-mail"></i> '.$utilisateur['email'].'</a></span>
												<!-- Buttons -->
												<div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
                                                
													<a href="profile.php?u='.$utilisateur['id_utilisateur'].'"  class="popup-with-zoom-anim button ripple-effect" ><i class="icon-material-outline-check" ></i>profil</a>
                                                    
                                                    <a href="#small-dialog-2" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i>Envoyer un message</a>
													<a href="#small-dialog-3" class=" button red ripple-effect"><i class="icon-feather-mail"></i>Desabonne</a>
												</div>
											</div>
										</div>
									</div>
								</li>
                             

                        ';
        
        }
                    
        
$response['affiche']=$affichage;

    }else{
        $response['status']=false;
    }

    echo json_encode($response);
}