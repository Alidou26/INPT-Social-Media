<?php include('head1.php')?>

<?php

?>
<body>
    <nav>
        <div class="container">
            <h2 class="log">
        INPT-SM
            </h2>
            <div class="create">
               <a href="profil.php?id=<?php echo $_SESSION['id_utilisateur'];?>">
                <div class="profile-photo">
                    <img src="<?php echo $_SESSION['photo'];?>">
                </div>
                </a> 
                <button id="menu-btn"><i class="uil uil-bars"></i></button>
            </div>
        </div>
    </nav>

    <!------------------------- MAIN -------------------------->
    <main>
        <div class="container">
            <!--======================== LEFT ==========================-->
            <div class="left">
                <a class="profile">
                    <div class="profile-photo">
                        <img src="<?php echo $_SESSION['photo'];?>">
                    </div>
                    <div class="handle">
                        <h4><?php echo $_SESSION['nom'].' '.$_SESSION['prenom'];?></h4>
                        <p class="text-muted">
                            @<?php echo $_SESSION['pseudo'];?>
                        </p>
                    </div>
                </a>

                <!-- close button -->
                <span id="close-btn"><i class="uil uil-multiply"></i></span>

                <!-------------------- SIDEBAR ------------------------->
                <div class="sidebar">
                    <a class="menu-item active">
                        <span><i class="uil uil-home"></i></span><h3>Accueil</h3>
                    </a>
                    
                    <a href="../vchat/message.php" class="menu-item" id="messages-notification">
                        <span><i class="uil uil-envelope-alt"></i></span><h3>Message</h3>
                    </a>
                   
                    <a class="menu-item" id="theme">
                        <span><i class="uil uil-palette"></i></span><h3>Theme</h3>
                    </a>
                    <a class="menu-item" href="profil.php?id=<?=$_SESSION['id_utilisateur']?>">
                        <span><i class="uil uil-user"></i></span><h3>Profil</h3>
                    </a>   
                    
                    <a href="../PageAction/deconnexionAction.php" class="menu-item" href="profil.php?id=<?=$_SESSION['id_utilisateur']?>">
                        <span><i class="uil uil-sign-out-alt"></i></span><h3>Déconnexion</h3>
                    </a>  
                </div>
                <!------------------- END OF SIDEBAR -------------------->
              
            </div>
            <!------------------- END OF LEFT -------------------->



            <!--======================== MIDDLE ==========================-->
            <div class="middle">
                <!------------------- STORIES -------------------->

                
                <div class="stories" >
                  
                    <?php foreach($groupe as $g){ ?>
                      
                    <div class="story" style=" background: url('<?=$g['photo_groupe']?>') no-repeat center center/cover;">
                    <a href="groupe.php?id=<?=$g['id_groupe']?>">
                        <div class="profile-photo">
                            <img src="<?=$g['photo_groupe']?>">
                        </div>
                        </a>
                        <p class="name"><?=$g['nom_groupe']?></p>
                   
                    </div>
                  
                    <?php }?>
                 
                 
                </div>
                <!------------------- END OF STORIES -------------------->
                <form method="post"  id="poste" class="create-post">
         
                    <div class="profile-photo">

                        <img src="<?php echo $_SESSION['photo'];?>">
                    </div>
                    <input type="text"  name="texte" placeholder="Faire un poste <?php echo$_SESSION['nom'];?> ?" id="create-post" required>

                    <label style="display:flex;">
                    <input type="file" name="photoVideo"/>
                    <img src="icons/post-image.png" alt="" style="height:35px;margin-left:10%;">
                       </label>
                    <button type="submit" class="btn btn-primary btn-sm  status" form="poste" style="width:5.5rem;">publier</button>
                </form>

                <!------------------- FEEDS --------------------->
                <div class="feeds">
                    <!------------------- FEED 1 --------------------->

                    <?php foreach($poste as $pos){
                         $likes = getLikes($pos['id_poste']);
                         $comments = getComments($pos['id_poste']);
                        
                         $liker=Userlike($pos['id_poste']);
                        
                                    ?>
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                            <a href="profil.php?id=<?php echo $pos['id_utilisateur'];?>">
                                <div class="profile-photo">
                                    <img src="<?=$pos['photo']?>">
                                </div>
                                </a>
                                <div class="ingo">
                                    <h3><?=$pos['nom']?> <?=$pos['prenom']?></h3>
                                    <small><?=$pos['date_poste']?></small>
                                </div>
                            </div>
                              <!-- suppression -->
                            <span class="edit">
                              
                                <?php if($pos['uid'] == $_SESSION['id_utilisateur']){ ?>
							<div class="post-block__user-options">
								
                        
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
									<a class="dropdown-item text-danger" href="actions.php?deletepost=<?=$pos['id_poste']?>"> <i class="fa fa-trash mr-1"></i>Supprimer</a>
								</div>
							</div>
                            <?php } ?>
                            </span>


                        </div>

                        <div class="photo">
                            <br>
                              <div style="margin-left:15px;"><p><?=$pos['poste_texte']?></p></div>

                            <?php if(!empty($pos['poste_image'])){?>

							<img src="<?= $pos['poste_image']?>">

                            <?php }?>

                        </div>
                       
                       <?php
                        if(checkLikeStatus($pos['id_poste'])){
            $like_btn_display='none';
              $unlike_btn_display='';
                }else{
        $like_btn_display='';
         $unlike_btn_display='none';  
             }
                   ?>

                        <div class="action-buttons">
                            <div class="interaction-buttons">

                                  <?=$likes?>
                                <i class="bi bi-heart-fill unlike_btn text-danger"  data-post-id='<?=$pos['id_poste']?>'  style="display:<?=$unlike_btn_display?>; color: red;" ></i>

                                <i class="bi bi-heart like_btn"  data-post-id='<?=$pos['id_poste']?>'  style="display:<?=$like_btn_display?>;"></i>

                                   <a class="post-card-buttons" id="show-comments" style=" text-decoration: none; color:black;"> <?=count($comments)?>  <i class="uil uil-comment-dots   com_btn"  data-aff="show-comments<?=$pos['id_poste']?>"  data-cache="hide-comments<?=$pos['id_poste']?>" ></i><span data-bs-target="#postview<?=$pos['id_poste']?>"></i></a>
                                
                                   
                            </div>
                          
                        </div>

                         <div class="border-top pt-3 hide-comments<?=$pos['id_poste']?>" style="display: none;">
                                    <div class="row bootstrap snippets">
                                        <div class="col-md-12">
                                            <div class="comment-wrapper">
                                                <div class="panel panel-info">
                                                    <div class="panel-body">
                                                   

                                                    <li class="media comment-form">
                                                        
                                                                
                                                                <div class="media-body">
                                                                    <form action="" method="" role="form">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                   
                                                                                    <!-- ecrire un commentaire -->
                                                                                <div class="input-group p-2 <?=$pos['id_poste']?'border-top':''?>" style="margin-left:15%; padding-top:5%;" >
                           
                                                                                <input type="text" class="form-control rounded-0 border-0 comment-input<?=$pos['id_poste']?>" placeholder="Commenter.."
                                                                                aria-label="Recipient's username" aria-describedby="button-addon2" 
                                                                                style="background:whitesmoke;height:1.9rem;border-radius:8px;border:2px solid black;" required>

                                                                                <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page=INPTsm'  data-input="comment-input<?=$pos['id_poste']?>" data-cs="comment-section<?=$pos['id_poste']?>" data-post-id="<?=$pos['id_poste']?>" type="button" id="button-addon2"
                                                                                style="background: hsl(252, 75%, 60%); color:#fff;">commenter</button>
  
                                                                                   </div>


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </li>
                                                         <br>

                                                        <ul class="media-list comment-section<?=$pos['id_poste']?>">
                                                          

                                                            <?php if(count($comments)<1){ ?>
                                                   <p class="p-3 text-center my-2 nce" style="margin-left:32%;">Pas de commentaire</p>
                                                    <?php }?>
                                                       
                                                 

                                                    <?php foreach($comments as $coms){?>
														<li class="media">
                                                
															<a href="#" class="pull-left">
																<img src="<?=$coms->photo?>" alt="" class="img-circle">
															</a>
                                                            <br>
															<div class="media-body">
																<div class="d-flex justify-content-between align-items-center w-100">
																	<strong class="text-gray-dark"><a href="#" class="fs-8"><?=$coms->nom?> <?=$coms->pseudo?></a></strong>
																	<a href="#"><i class='bx bx-dots-horizontal-rounded'></i></a>
																</div>
																<span class="d-block comment-created-time"><?= $coms->date_creation?></span>
																<p class="fs-8 pt-2"> <?=$coms->commentaire?></p>
																
															</div>
														</li>
                                                        <?php }?>
                                                         

                
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                    </div>
                    <?php } ?>
                   

                    <!---------------- END OF FEED ----------------->




                </div>
                <!------------------------------- END OF FEEDS ------------------------------------>
            </div>
            <!--======================== END OF MIDDLE ==========================-->


            <!--======================== RIGHT ==========================-->
            <div class="right">
                <div class="messages">
                    <div class="heading">
                        <h4>Recherche</h4><i class="uil uil-search"></i>
                    </div>
                    <!------------ SEARCH BAR -------------->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <form action="">
                        <input type="search" placeholder="Recherche" id="message-search">
                        </form>
                      
                    </div>
                    <!------------ MESSAGES CATEGORY -------------->
                    <div class="category">
                       
                    </div>
                    <!------------ MESSAGE -------------->
                    
            
                    <!----- MESSAGE ----->
                    <?php foreach($groupes as $g){?>

                        <a href="ajaxAction.php?integrerGroupeHome=<?=$g['id_groupe']?>">
                    <div class="message" style="display:none;">
                 
                        <div class="profile-photo">
                            <img src="<?=$g['photo_groupe']?>">
                            
                            </button>
                        </div>
                        <div class="message-body">
                            <h5><?=$g['nom_groupe']?></h5>
                        </div>
                    </div>
                    </a>
                   <?php } ?>

                   <?php foreach($utilisateurs as $u){?>
                    <a href="ajaxAction.php?invitationH=<?=$u['id_utilisateur']?>">
                    <div class="message" style="display:none;">
                
                        <div class="profile-photo">
                            <img src="<?=$u['photo']?>">
                            
                        </div>
                        <div class="message-body">
                            <h5><?=$u['nom']?> <?=$u['prenom']?></h5>
                        </div>
                  
                    </div>
                    </a>
                   <?php } ?>
                 

                </div>

                <!------------ END OF MESSAGES -------------->
      
                <!------------ FRIEND REQUESTS -------------->
                <div class="friend-requests">
                    <h4>Demande</h4>
                    <!----- REQUEST 1----->
                    <?php foreach( $demandes as $d){?>
    <div class="request">
        <div class="info">
            <div class="profile-photo">
                <img src="<?=$d['photo']?>">
            </div>
            <div>
                <h5><?=$d['nom']?> <?=$d['prenom']?></h5>
            </div>
        </div>
        <div class="action">
            <button class="btn btn-primary followbtn"  data-user-id='<?=$d['id_utilisateur']?>'>Accepter</button>
            <button class="btn  refuser" data-user-id='<?=$d['id_utilisateur']?>'>Refuser</button>
        </div>
    </div>
    <?php  }?>
                  
                </div>


                <div class="friend-requests">
                    <h4>Suggestion d'Amis</h4>
                    <!----- REQUEST 1----->
                    <?php foreach($follow as $fo){?>
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="<?=$fo['photo']?> ">
                            </div>
                            <div>
                                <h5><?=$fo['nom']?> <?=$fo['prenom']?></h5>
                                
                            </div>
                        </div>
                        <div class="action" style="margin-left:70px;">
                            <button class="btn btn-primary   invitation" data-user-id='<?=$fo['id_utilisateur']?>'>Suivre</button>
                         
                        </div>
                    </div>
                  <?php  }?>
                <!----- FIN----->
                 
                </div>

                </div>
            </div>
            <!--====================== END OF RIGHT ==========================-->

            
        </div>
    </main>

<?php  include('footer1.php') ?>


</body>
</html>