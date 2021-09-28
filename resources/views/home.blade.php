<?php session_start();
$_SESSION['classe6']=$classe6;
$_SESSION['classe5']=$classe5;
$_SESSION['classe4']=$classe4;
$_SESSION['classe3']=$classe3;

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    /> 
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <link
      rel="stylesheet"
	  type="text/css" title="perso_style" href="http://192.168.137.1/SControl/resources/css/home.css">
	  <link 
      rel="stylesheet"
	  type="text/css" title="boostrap" href="http://192.168.137.1/SControl/resources/bootstrap/bootstrap.min.css">
    <link
      rel="shortcut icon"
	  href="http://192.168.137.1/SControl/resources/img/logo_taill_off.png">

    <title>S-control, Aceuil personnel administrative</title>
  </head>

  <body class="container-fluid">
	  <div class="col" id="bar">
		  <div id="profile">
			  <p class="info_profile nom">Nom: <?php  //Insertion du Nom du professeur
			   if (isset($professeur)) {
                foreach ($professeur as $value){
                    echo $value->nom;
                }
            }   k
			  ?></p>
			  <p class="info_profile prenom">Prenom: <?php  //Insertion du prenom du professeur
			   if (isset($professeur)) {
                foreach ($professeur as $value){
                    echo $value->prenom;
                }
            } 
			  ?></p>
			  <p class="info_profile tel">Tel: <?php  //Insertion du Tel du professeur
			   if (isset($professeur)) {
                foreach ($professeur as $value){
                    echo $value->tel;
                }
            } 
			  ?></p>
			  <p class="info_profile role">Classe prise en charge: <br/><?php //Ecriture des classes prise en charge
             
			 $strClasse="";
			 $var;
			  if (isset($professeur)) {
                foreach ($professeur as $value){
                    $var = strval($value->classe);

				}
					for($i=0; $i<=strlen($var); $i++){

						if(isset($var[$i])&&($var[$i]!='-')&&($i<strlen($var)-1)){ 
							$strClasse.=$var[$i]."eme, ";
						}
						if(isset($var[$i])&&($var[$i]!='-')&&($i==strlen($var)-1)){
							$strClasse.=$var[$i]."eme";
						}

					}
					echo $strClasse;
                }
			
			 ?> 
			  </p>
		  </div>
		  <div id="search">
			  <p class="search_zone">
				 <input type="text" name="search_zone" id="search_zone" placeholder="Rechercher..." />
		     </p>
			 <p id="search_zone_desc">Vous pouvez rechercher <br/>un eleve</p>
		  </div>
		  <div id="result">
			  <p class="result_element">Voici une proposition </p>
			  <p class="result_element">Voici une proposition </p>
			  <p class="result_element">Voici une proposition </p>
		  </div>
		  <div id="nav">

				  <p class="nav_p"><img alt="home" src="http://192.168.137.1/SControl/resources/img/home.png" class="nav_icon"> <span>Acceuil</span></p>
				  <p class="nav_p"><img alt="note" src="http://192.168.137.1/SControl/resources/img/note.png" class="nav_icon"><span>Notes</span></p>
				  <p class="nav_p"><img alt="message" src="http://192.168.137.1/SControl/resources/img/mess.png" class="nav_icon"><span>Messages</span></p>
				  <p class="nav_p"><img alt="setting" src="http://192.168.137.1/SControl/resources/img/setting.png" class="nav_icon"><span>Parametre</span></p>
				  <p class="nav_p"><img alt="download" src="http://192.168.137.1/SControl/resources/img/Download.png" class="nav_icon lastImg"><span>Telecharger</span></p>
		  </div>
	  </div>

	<div class="col dashboard">
	 <div class="row navButton">	
	  <div class="colo" id="dec_button">
			  <p>
				 <button type="button" id="exit_button" class="bt exit_button">Deconnexion</button>
		     </p>
		  </div>
	 </div>
	 	  
	  <div class="row" id="display_content"> <!--utiliser pour modifier le comportement du tableau de bort -->
	    <div id="table">

		  <h1>Que voulez vous faire ?</h1>
		  <div id="tools">
			<div class="sub_tool">
			  <div class="tools_item item1">
				  <h3>Entrer des notes<br/>de devoirs de classe</h3>
				  <h5>Activite recents: <br/><br/> Aucun</h5>
			  </div>
			  <div class="tools_item item2">
				  <h3>Entrer des notes<br/>de devoirs surveiller</h3>
				  <h5 class="recent_activity">Activite recents: <br>5eme: DS1<br>6eme: DS2</h5>
			  </div>
			  </div>
			<div class="sub_tool">
			  <div class="tools_item item3">
				  <h3>Entrer des notes<br/>de composition</h3>
				  <h5 class="recent_activity">Activite recents: <br/><br/> Aucun</h5>
			  </div>
			  <div class="tools_item item4">
				  <h3>Valider les notes</h3>
				  <h5 class="recent_activity">Passez en revue les notes et
                   valider les  pour les generer
                   sur les bulletins</h5>
			  </div>
			</div>
		  </div>
	    </div>

	  </div>	<!--fin de la parti dynamique-->
	</div>  
	  
  </body>
    <script src="http://192.168.137.1/SControl/resources/js/jquery-ui.min.js"></script> 
	<script src="http://192.168.137.1/SControl/resources/js/jquery-3.6.0.js"></script>
	<script src="http://192.168.137.1/SControl/resources/bootstrap/js/bootstrap.min.js"></script>
	<script src="http://192.168.137.1/SControl/resources/js/home.js"></script>
	<script src="http://192.168.137.1/SControl/resources/js/note.js"></script>
</html>
