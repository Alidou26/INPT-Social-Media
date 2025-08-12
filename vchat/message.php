<?php

include 'core/init.php';
include('../PageAction/nombreAmis.php');

$userOBJ->updateSession();

 $user = $userOBJ->userData();
 if(isset($_GET['pseudo']) && !empty($_GET['pseudo'])){
   
    $profileData = $userOBJ->getUserByUsername($_GET['pseudo']);
   
    $user = $userOBJ->userData();
   
    if(!$profileData){
        $userOBJ->redirect('../home.php');
    }else 
    if($profileData->pseudo === $user->pseudo ){
        $userOBJ->redirect('../home.php');
    }
   
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>INPT-SM</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="./style.css">
<link rel='stylesheet' type='text/css' media='screen' href='styles/popup.css'>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
       const conn = new WebSocket('ws://localhost:8080/?token=<?php echo $userOBJ->sessionID;?>');
    </script>

</head>
<body>


<div class="app-container">
  <div class="app-left">
    <div class="app-left-header">
      <div class="app-logo">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
          <defs/>
          <path class="path-1" fill="#3eb798" d="M448 193.108h-32v80c0 44.176-35.824 80-80 80H192v32c0 35.344 28.656 64 64 64h96l69.76 58.08c6.784 5.648 16.88 4.736 22.528-2.048A16.035 16.035 0 00448 494.868v-45.76c35.344 0 64-28.656 64-64v-128c0-35.344-28.656-64-64-64z" opacity=".4"/>
          <path class="path-2" fill="#3eb798" d="M320 1.108H64c-35.344 0-64 28.656-64 64v192c0 35.344 28.656 64 64 64v61.28c0 8.832 7.168 16 16 16a16 16 0 0010.4-3.84l85.6-73.44h144c35.344 0 64-28.656 64-64v-192c0-35.344-28.656-64-64-64zm-201.44 182.56a22.555 22.555 0 01-4.8 4 35.515 35.515 0 01-5.44 3.04 42.555 42.555 0 01-6.08 1.76 28.204 28.204 0 01-6.24.64c-17.68 0-32-14.32-32-32-.336-17.664 13.712-32.272 31.376-32.608 2.304-.048 4.608.16 6.864.608a42.555 42.555 0 016.08 1.76c1.936.8 3.76 1.808 5.44 3.04a27.78 27.78 0 014.8 3.84 32.028 32.028 0 019.44 23.36 31.935 31.935 0 01-9.44 22.56zm96 0a31.935 31.935 0 01-22.56 9.44c-2.08.24-4.16.24-6.24 0a42.555 42.555 0 01-6.08-1.76 35.515 35.515 0 01-5.44-3.04 29.053 29.053 0 01-4.96-4 32.006 32.006 0 01-9.28-23.2 27.13 27.13 0 010-6.24 42.555 42.555 0 011.76-6.08c.8-1.936 1.808-3.76 3.04-5.44a37.305 37.305 0 013.84-4.96 37.305 37.305 0 014.96-3.84 25.881 25.881 0 015.44-3.04 42.017 42.017 0 016.72-2.4c17.328-3.456 34.176 7.808 37.632 25.136.448 2.256.656 4.56.608 6.864 0 8.448-3.328 16.56-9.28 22.56h-.16zm96 0a22.555 22.555 0 01-4.8 4 35.515 35.515 0 01-5.44 3.04 42.555 42.555 0 01-6.08 1.76 28.204 28.204 0 01-6.24.64c-17.68 0-32-14.32-32-32-.336-17.664 13.712-32.272 31.376-32.608 2.304-.048 4.608.16 6.864.608a42.555 42.555 0 016.08 1.76c1.936.8 3.76 1.808 5.44 3.04a27.78 27.78 0 014.8 3.84 32.028 32.028 0 019.44 23.36 31.935 31.935 0 01-9.44 22.56z"/>
        </svg>
      </div>
      <a href="../Page/home.php" style="text-decoration:none;"><h1 style="font-size:2.3rem;">INPT-SM</h1></a>
    </div>
    <div class="app-profile-box">
      <img src="<?= $_SESSION['photo'] ?>" alt="profil">
      <div class="app-profile-box-name">

        <?= $_SESSION['nom'].' '.$_SESSION['prenom'] ?>

      </div>
      <p class="app-profile-box-title"><?= $_SESSION['filiere'] ?></p>
      <div class="switch-status">
        <input type="checkbox" name="switchStatus" id="switchStatus" checked disabled>
        <label class="label-toggle" for="switchStatus"></label>
        <span class="toggle-text toggle-online"><a href="../pageAction/deconnexionAction.php" style="text-decoration:none;color:white;">Déconnexion</a></span>
      </div>
    </div>
    <div class="chat-list-wrapper">
      <div class="chat-list-header">Mes Amis<span class="c-number"><?=  $nombre['total']?></span>
        <svg class="list-header-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="feather feather-chevron-up" viewBox="0 0 24 24">
          <defs/>
          <path d="M18 15l-6-6-6 6"/>
        </svg>
      </div>
      <ul class="chat-list active">

      <?php include('../PageAction/afficheFollower.php') ?>


      </ul>
    </div>
  </div>
      <!-- popup -->
<div id="callBox" class="box hidden">
<div class="popup" id="success">
      <div class="popup-content">
        <div class="imgbox">
          <img src="" alt="" class="img" id="profileImage" style="width:9rem;height:9rem;">
        </div>
        <div class="title">
            <div id="username"><h3>Appel Video!</h3></div>
        </div>

        
          <button id="answerBtn" class="s_button" onclick="cacheBalise('messages','deo');">Accepter</button>
        
      
          <button id="declineBtn" class="e_button">Refuser</button>
        
      </div>
    </div>
    </div>
<!-- popup -->

<?php if(isset($_GET['pseudo'])){ ?>

  <div class="app-main">

  <div class="chat-wrapper" style="display:none;" id="deo">
  <div class="order-2 h-full" id="video">
          <video id="remoteVideo" class="h-full object-cover" style="height:15rem;width:100%;margin:auto;"></video>

          <video id="localVideo" class="vid-2 Z-1 right-0 bottom" style="height:15rem;width:100%;margin:auto;" ></video>

      </div>
      </div>

    <div class="chat-wrapper" id="messages">


    </div>


    <div class="chat-input-wrapper">
      <button class="chat-attachment-btn" id="hangupBtn" style="display:none;" onclick="cacheBalise('hangupBtn','callBtn');">
      <i class="fa-solid fa-video-slash" style="color:red;font-size:1.3rem;"></i>
      </button>
      <button class="chat-attachment-btn" data-user="<?php echo $profileData->id_utilisateur;?>" id="callBtn" style="display:block;" onclick="cacheBalise('callBtn','hangupBtn');cacheBalise('messages','deo');">
      <i class="fa-solid fa-video" style="color:green;font-size:1.5rem;"></i></button>
      <div class="input-wrapper">
        <form id="message__form">
        <input type="text" class="chat-input" placeholder="Entrer votre Message..." name="message">
        <input type="hidden" value="<?=$_GET['pseudo'] ?>" name="pseudo_recepteur" id="pseudo_recepteur">
        <input type="hidden" value="<?=$_SESSION['pseudo'] ?>" name="pseudo_envoyeur" >
     
      </div>
      <button type="submit" class="chat-send-btn">Envoyer</button>
    </div>
    </form>
  </div>


  <div class="app-right">
    <div class="app-profile-box">
      <img src="<?= $profileData->photo;?>" alt="profil">
      <p class="app-profile-box-title name"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg><?= $profileData->nom.' '.$profileData->prenom ;?></p>
      <p class="app-profile-box-title mail"><i class="fa-solid fa-graduation-cap"></i><?= $profileData->filiere;?></p>
    </div>

    <?php } else{ ?>

      

<div class="chat-wrapper">

<img src="lgf.jpg" alt="" style="width:100%; border-radius:20px;">


</div>
<div class="app-right">
   
      <img src="../I1.JPG" alt="profil" style="border-radius:10px;">

        <?php } ?>
      
    <div class="app-right-bottom">
      <div class="app-theme-selector">
      <button class="theme-color indigo" data-color="indigo">
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512" >
          <defs/>
          <path fill="#fff" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
      <button class="theme-color pink" data-color="pink" >
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512" >
          <defs/>
          <path fill="#fff" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
      <button class="theme-color navy-dark active" data-color="navy-dark" >
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
          <defs/>
          <path fill="#fff" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
      <button class="theme-color dark" data-color="dark" >
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
          <defs/>
          <path fill="currentColor" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
    </div>
    </div>
  </div>
  <div class="app-right-bottom" id="wrapper">
      <div class="app-theme-selector">
      <button class="theme-color indigo" data-color="indigo">
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512" >
          <defs/>
          <path fill="#fff" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
      <button class="theme-color pink" data-color="pink" >
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512" >
          <defs/>
          <path fill="#fff" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
      <button class="theme-color navy-dark active" data-color="navy-dark" >
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
          <defs/>
          <path fill="#fff" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
      <button class="theme-color dark" data-color="dark" >
        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
          <defs/>
          <path fill="currentColor" d="M451.648.356c-25.777 2.712-56.79 19.872-94.811 52.46-68.786 58.958-149.927 160.756-202.185 234-38.158-5.951-78.375 10.368-102.187 40.133C8.758 381.584 45.347 430.34 4.12 473.811c-7.179 7.569-4.618 20.005 4.98 24.114 67.447 28.876 153.664 10.879 194.109-31.768 24.718-26.063 38.167-64.54 31.411-100.762 72.281-55.462 172.147-140.956 228.7-211.885 31.316-39.277 47.208-70.872 48.584-96.59C513.759 22.273 486.87-3.346 451.648.356zM181.443 445.511c-27.362 28.85-87.899 45.654-141.767 31.287 30.12-48.043 4.229-91.124 36.214-131.106 26.246-32.808 79.034-41.993 109.709-11.317 35.839 35.843 19.145 86.566-4.156 111.136zm3.07-148.841c7.354-10.167 18.887-25.865 33.29-44.659l49.22 49.224c-18.125 14.906-33.263 26.86-43.077 34.494-8.842-15.879-22.526-30.108-39.433-39.059zM481.948 55.316c-3.368 63.004-143.842 186.021-191.797 226.621l-53.785-53.79c39.458-49.96 155.261-191.312 218.422-197.954 16.851-1.775 28.03 8.858 27.16 25.123z"/>
        </svg>
      </button>
    </div>
    </div>
</div>


<script>

function cacheBalise(id,af){
    let div=document.querySelector("#"+id);
    div.style.display='none';
    let div1=document.querySelector("#"+af);
    div1.style.display='block';
}


      </script>

  <script  src="./script.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="js/ajaxMessage.js"></script>
<script src="js/afficheConversation.js"></script>

  <script  src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>assets/js/main.js"></script>

</body>
</html>
