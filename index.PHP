<?php  include 'vchat/core/init.php';  ?>

<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>INPT-SM</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="./form/style.css">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="cont bg">
	<div class="mouse"></div>
	<div class="app">
		<div class="app__bgimg">
			<div class="app__bgimg-image app__bgimg-image--1">
			</div>
			<div class="app__bgimg-image app__bgimg-image--2">
			</div>
		</div>
		<div class="app__img">
			<img onmousedown="return false" src="images/whiteTest4.png" />
		</div>
		
		<div class="app__text app__text--1">
			<div class="container">
				<div class="logo">
				  <img style="  width: 100%;height: 100%; border-radius: 50%;" src="./I4.jpg" alt="">
				</div>
			
				<div class="tab-body">
				  <form id="formConnexion">

                    <!-- reponse -->
                    <div class="alert alert-danger alert-inscription-danger" role="alert">   </div>


					<div class="row">
					  <i class="far fa-user"></i>
					  <input name="pseudo" type="text" class="input" placeholder="Pseudo" required>
					</div>
					<div class="row">
					  <i class="fas fa-lock"></i>
					  <input name="mot_de_passe" placeholder="Mot de Passe" type="password" class="input" required>
					</div>
					<button style="  
                    position: absolute;
					left: 50%;
					bottom: 0;
					transform: translate(-50%, 50%);
					width: 120px;
					height: 45px;
					border-radius: 50px;
					background-color: #6ba1f9;
					border: none;
					outline: none;
					color: #fff;
					cursor: pointer;" 
                    type="submit" form="formConnexion">Connexion</button>
				  </form>
				</div>
			

			  </div>
		</div>
		
		<div class="app__text app__text--2">
			<div class="container" style="background-color:#ccc">
				<div class="logo">
					<img style="  width: 100%;height: 100%; border-radius: 50%;" src="./I4.jpg" alt="">
				</div>
			
				<div class="tab-body">
				  <form id="formInscription">

                    <!-- reponse -->
                  <div class="alert alert-danger alert-inscription-danger" role="alert">   </div>


					<div class="row">
					  <i class="far fa-user"></i>
					  <input name="nom" type="text" class="input" placeholder="Nom" required>
					</div>
					<div class="row">
						<i class="far fa-user"></i>
						<input name="prenom" type="text" class="input" placeholder="Prenom" required>
					  </div>
					  <div class="row">
						<i class="far fa-user"></i>
						<select name="filiere" class="input" required>
							<option value="">Filiere</option>
                            <option value="AMOA">AMOA</option>
                            <option value="ASEDS">ASEDS</option>
                            <option value="DATA">DATA</option>
                            <option value="SMART">SMART</option>
                            <option value="SESNUM">SESNUM</option>
                            <option value="CLOUD">CLOUD</option>
							<option value="ICCN">ICCN</option>
						</select>
					  </div>
					  <div class="row">
						<i class="far fa-user"></i>
						<input name="pseudo" type="text" class="input" placeholder="Pseudo" required>
					  </div>
					<div class="row">
					  <i class="fas fa-lock"></i>
					  <input name="mot_de_passe" placeholder="Mot de Passe" type="password" class="input" required>
					</div>
					<div class="row">
						<i class="far fa-user"></i>
						<input name="photo" type="file" class="input" placeholder="Photo" required>
					  </div>

                      
					<button style="  position: absolute;
					left: 50%;
					bottom: 2rem;
					transform: translate(-50%, 50%);
					width: 120px;
					height: 45px;
					border-radius: 50px;
					background-color: #6ba1f9;
					border: none;
					outline: none;
					color: #fff;
					cursor: pointer;" 
                    type="submit" form="formInscription">Inscription</button>
				  </form>
				</div>
			  </div>
		</div>
	</div>
	<div class="pages">
		<ul class='pages__list'>
			<li data-target='1' class='pages__item pages__item--1 page__item-active' title="Connexion"></li>
			<li data-target='2' class='pages__item pages__item--2' title="Inscription"></li>
		</ul>
	</div>
</div>
<a href="#" class="icon-link" >
    <img  style="border-radius:10%;height:7rem;" src="./I2.jpg">
  </a>
  <a href="#" class="icon-link icon-link--twitter">
    <img style="border-radius:10%;height:7rem;" src="I3.jpg">
  </a>

<!-- ****************************************reconnaisance faciale******************************************* -->

<div id="faceio-modal"></div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script> 
$(".alert-inscription-danger").hide();
</script>
  <script  src="./js/script.js"></script>
  <script  src="./js/ajax.js"></script>
</body>
</html>
