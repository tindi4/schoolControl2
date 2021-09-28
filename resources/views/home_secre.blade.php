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
	  type="text/css" href="http://192.168.137.1/SControl/resources/css/home.css">
    <link
      rel="shortcut icon"
	  href="http://192.168.137.1/SControl/resources/img/logo_taill_off.png">

    <title>S-control, Aceuil personnel administrative</title>
  </head>

  <body>
	  <div id="bar">
		  <div id="profile">
			  <p class="info_profile nom">Nom: <?php  //Insertion du Nom de la secretaire
			   if (isset($secre)) {
                foreach ($secre as $value){
                    echo $value->nom;
                }
            } 
			  ?></p>
			  <p class="info_profile prenom">Prenom: <?php  //Insertion du prenom de la secretaire
			   if (isset($secre)) {
                foreach ($secre as $value){
                    echo $value->prenom;
                }
            } 
			  ?></p>
			  <p class="info_profile tel">Tel: <?php  //Insertion du Tel de la secretaire
			   if (isset($secre)) {
                foreach ($secre as $value){
                    echo $value->contact;
                }
            } 
			  ?></p>
			  <p class="info_profile role">Poste: <br/> Secretaire, comptable</p>

		  </div>
		  <div id="search">
			  <p class="search_zone">
				 <input type="text" name="search_zone" id="search_zone" placeholder="Rechercher..." />
		     </p>
			 <p id="search_zone_desc">Vous pouvez rechercher <br/>un eleve, un personnel administrative</p>
		  </div>
		  <div id="result">
			  <p class="result_element">Voici une proposition </p>
			  <p class="result_element">Voici une proposition </p>
			  <p class="result_element">Voici une proposition </p>
		  </div>
		  <div id="nav">

				  <p class="nav_p" id="openHome"><img alt="home" src="http://192.168.137.1/SControl/resources/img/home.png" class="nav_icon"> <span>Acceuil</span></p>
				  <p class="nav_p" id="tool"><img alt="note" src="http://192.168.137.1/SControl/resources/img/note.png" class="nav_icon"><span>Outils</span></p>
				  <p class="nav_p"><img alt="message" src="http://192.168.137.1/SControl/resources/img/mess.png" class="nav_icon"><span>Messages</span></p>
				  <p class="nav_p"><img alt="setting" src="http://192.168.137.1/SControl/resources/img/setting.png" class="nav_icon"><span>Parametre</span></p>
				  <p class="nav_p"><img alt="download" src="http://192.168.137.1/SControl/resources/img/Download.png" class="nav_icon lastImg"><span>Sauvegarder</span></p>
		  </div>
	  </div>
	  <div id="display_content"> <!--utiliser pour modifier le comportement du tableau de bort -->
		<div id="secreHome">
	      <h1>Vos activites recentes</h1>
			<p class="activite">Voici une activite recenteipsum deltom</p>
			<p class="activite">Voici une activite recenteipsum deltom</p>
			<p class="activite">Voici une activite recenteipsum deltom</p>
		  <h1>Quelque lien utiles</h1>
			<p class="lien"><a>A quoi sert cet espace secretaire ?</a></p>
			<p class="lien"><a>Comment utiliser les outils ?</a></p>
			<p class="lien"><a>Vous rencontrer des difficulte, cliquer ici.</a></p>
			<p class="lien"><a>Signaler un bug ou mauvais fonctionnement du systeme.</a></p>

		</div>

	  </div>	<!--fin de la parti dynamique-->

	  <div id="dec_button">
			  <p>
				 <button type="button" id="exit_button" class="bt exit_button">Deconnexion</button>
		     </p>
		  </div>
  </body>
  <script src="http://192.168.137.1/SControl/resources/js/jquery-ui.min.js"></script>
	<script src="http://192.168.137.1/SControl/resources/js/jquery-3.6.0.js"></script>
	<script src="http://192.168.137.1/SControl/resources/js/secre_home.js"></script>
</html>
