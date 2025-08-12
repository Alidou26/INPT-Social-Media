<?php include('head2.php') ?>


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
                        <h4 style="font-size:1.1rem;"><?php echo $_SESSION['nom'].' '.$_SESSION['prenom'];?></h4>
                        <p class="text-muted">
                            @<?php echo $_SESSION['pseudo'];?>
                        </p>
                    </div>
                </a>

                <!-- close button -->
                <span id="close-btn"><i class="uil uil-multiply"></i></span>

                <!-------------------- SIDEBAR ------------------------->
                <div class="sidebar">
                    <a href="home.php" class="menu-item" style="text-decoration:none;font-weight:bold;color:black;">
                        <span><i class="uil uil-home"></i></span><h3>Accueil</h3>
                    </a>
                    
                    <a href="../vchat/message.php" class="menu-item" id="messages-notification" style="text-decoration:none;font-weight:bold;color:black;">
                        <span><i class="uil uil-envelope-alt"></i></span><h3>Message</h3>
                    </a>
                   
                    <a class="menu-item" id="theme" style="text-decoration:none;font-weight:bold;color:black;">
                        <span><i class="uil uil-palette"></i></span><h3>Theme</h3>
                    </a>
                    <a class="menu-item" href="profil.php?id=<?=$_SESSION['id_utilisateur']?>" style="text-decoration:none;font-weight:bold;color:black;">
                        <span><i class="uil uil-user"></i></span><h3>Profil</h3>
                    </a>  
                    <a href="../PageAction/deconnexionAction.php" class="menu-item" style="text-decoration:none;font-weight:bold;color:black;">
                        <span><i class="uil uil-sign-out-alt"></i></span><h3>Déconnexion</h3>
                    </a>                        
                </div>
                <!------------------- END OF SIDEBAR -------------------->
              
            </div>
            <!------------------- END OF LEFT -------------------->



            <!--======================== MIDDLE ==========================-->
            <div class="middle">

                
                    <div class="profile-page tx-13">
                    <div class="row">
                    <div class="col-12 grid-margin">
                    <div class="profile-header">
                    <div class="cover">
                    <div class="gray-shade"></div>
                    <figure>
                    <img src="<?php echo $user['photo'];?>" class="img-fluid" style="height:20rem;">
                    </figure>
                    <div class="cover-body d-flex justify-content-between align-items-center">
                    <div>
                    <img class="profile-pic" src="<?php echo $user['photo'];?>" alt="profile">

                    <span class="profile-name"><?php echo $user['nom'];?></span>

                    </div>
                    <div class="d-none d-md-block">
                    <?php if($user['id_utilisateur']==$_SESSION['id_utilisateur']){?>
                    <button class="btn btn-primary btn-icon-text btn-edit-profile" data-bs-toggle="modal" data-bs-target="#myModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit btn-icon-prepend">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg> Editer profil
                    </button>
                   <?php } ?>
                    </div>
                    </div>
                    </div>
                    <div class="header-links">

                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="row profile-body">
                    
                    <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
                    <div class="card rounded">
                    <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="card-title mb-0">A propos</h6>
                    <div class="dropdown">
              
                    </div>
                    </div>
                    <p><?=$user['description']?></p>
                    <div class="mt-3">
                    <label class="tx-11 font-weight-bold mb-0 text-uppercase">date Inscription:</label>
                    <p class="text-muted"><?=$user['date_inscription']?></p>
                    </div>
        
                 
                    </div>
                    </div>
                    </div>
                    
                    
                    <div class="col-md-8 col-xl-6 middle-wrapper">
                    <div class="row">


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
                                <div class="profile-photo">
                                    <img src="<?=$pos['photo']?>">
                                </div>
                                <div class="ingo">
                                    <p><?=$pos['nom']?> <?=$pos['prenom']?></p>
                                    <small><?=$pos['date_poste']?></small>
                                </div>
                            </div>
                              <!-- suppression -->
                            <span class="edit">
                              
                                <?php if($pos['uid'] == $_SESSION['id_utilisateur']){ ?>
							<div class="post-block__user-options">
								
                        
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
									<a class="dropdown-item text-danger" href="actions.php?deletepost=<?=$pos['id_poste']?>"> <i class="fa fa-trash mr-1"></i>  Supprimer</a>
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
                                <span ><i class="uil uil-heart unlike_btn "  data-post-id='<?=$pos['id_poste']?>'  style="display:<?=$unlike_btn_display?>; color: red;" ></i></span>

                                <span><i class="uil uil-heart like_btn"  data-post-id='<?=$pos['id_poste']?>'  style="display:<?=$like_btn_display?>;"></i></span>

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
                                                                <a href="#" class="pull-left">
                                                                    <img src="assets/images/users/user-4.jpg" alt="" class="img-circle">
                                                                </a>
                                                                <div class="media-body">
                                                                    <form action="" method="" role="form">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="input-group">
                                                                                   
                                                                                    <!-- ecrire un commentaire -->
                                                                                <div class="input-group p-2 <?=$pos['id_poste']?'border-top':''?>" style="margin-left:1%; padding-top:5%;" >
                           
                                                                                <input type="text" class="form-control rounded-0 border-0 comment-input<?=$pos['id_poste']?>" placeholder="commenter.."
                                                                                aria-label="Recipient's username" aria-describedby="button-addon2" 
                                                                                style="background:whitesmoke;height:1.9rem;border-radius:8px;border:2px solid black;" required>

                                                                                <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='estdsm'  data-input="comment-input<?=$pos['id_poste']?>" data-cs="comment-section<?=$pos['id_poste']?>" data-post-id="<?=$pos['id_poste']?>" type="button" id="button-addon2"
                                                                                style="background: hsl(252, 75%, 60%); color:#fff;   border-radius: 25% 10%;">commenter</button>
  
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
																<img src="<?=$coms->photo?>" alt="" class="img-xs rounded-circle">
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
                    </div>
                    
                    
                    <div class="d-none d-xl-block col-xl-3 right-wrapper">
                    <div class="row">
                    <div class="col-md-12 grid-margin">
                    <div class="card rounded">

                    <div class="card-body">
                
                    <!-- les suggesstions -->

                <?php foreach($follow as $fo){?>
                    <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                    <div class="d-flex align-items-center hover-pointer" >
                    <img class="img-xs rounded-circle" src="<?=$fo['photo']?>" alt="">
                    <div class="ml-2">
                    <p style="font-size:0.7rem;"><?=$fo['nom']?> <?=$fo['prenom']?></p>
                    </div>
                    </div>
                    <button class="btn btn-icon invitation" data-user-id='<?=$fo['id_utilisateur']?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <line x1="20" y1="8" x2="20" y2="14"></line>
                     <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    </button>
                    </div>
                    <?php  }?>

                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    
                    </div>
                    </div>
                    




            </div>
            <!--======================== END OF MIDDLE ==========================-->

                        <!--======================== RIGHT ==========================-->
            <div class="right" hidden>
                <div class="messages">
                    <div class="heading">
                        <h4>Messages</h4><i class="uil uil-edit"></i>
                    </div>
                    <!------------ SEARCH BAR -------------->
                    <div class="search-bar">
                        <i class="uil uil-search"></i>
                        <input type="search" placeholder="Search messages" id="message-search">
                    </div>
                    <!------------ MESSAGES CATEGORY -------------->
                    <div class="category">
                        <h6 class="active">Primary</h6>
                        <h6>General</h6>
                        <h6 class="message-requests">Requests(7)</h6>
                    </div>
                    <!------------ MESSAGE -------------->
                    <!----- MESSAGE ----->
                    <div class="message">
                        <div class="profile-photo">
                            <img src="./images/profile-2.jpg">
                        </div>
                        <div class="message-body">
                            <h5>Edem Quist</h5>
                            <p class="text-muted">Just woke up bruh</p>
                        </div>
                    </div>
                  
                </div>
                <!------------ END OF MESSAGES -------------->


                <!------------ FRIEND REQUESTS -------------->
                <div class="friend-requests">
                    <h4>Requests</h4>
                    <!----- REQUEST 1----->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./images/profile-8.jpg">
                            </div>
                            <div>
                                <h5>Hajia Bintu</h5>
                                <p class="text-muted">8 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                    </div>
                    <!----- REQUEST 2----->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./images/profile-9.jpg">
                            </div>
                            <div>
                                <h5>Jackline Mensah</h5>
                                <p class="text-muted">2 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                    </div>
                    <!----- REQUEST 3----->
                    <div class="request">
                        <div class="info">
                            <div class="profile-photo">
                                <img src="./images/profile-10.jpg">
                            </div>
                            <div>
                                <h5>Jennifer Lawrence</h5>
                                <p class="text-muted">19 mutual friends</p>
                            </div>
                        </div>
                        <div class="action">
                            <button class="btn btn-primary">Accept</button>
                            <button class="btn">Decline</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <!--====================== END OF RIGHT ==========================-->


           
        </div>


    </main>

  <?php include('footer2.php') ?>


</body>
</html>