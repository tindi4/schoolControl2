<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	  <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
      rel="stylesheet"
	  type="text/css" title="perso_style" href="http://192.168.137.1/SControl/resources/css/index.css">
	<link 
      rel="stylesheet"
	  type="text/css" title="boostrap" href="http://192.168.137.1/SControl/resources/bootstrap/bootstrap.min.css">
    <link
      rel="shortcut icon"
	  href="http://192.168.137.1/SControl/resources/logo_taill_off.png">

    <title>S-control, connexion personnel administrative</title>
  </head>

  <body class="container-fluid body">
	  <div class="connex_box"> <!-- we create here the connection login box-->
		 <p class="connex_box_desc">Connexion</p>
		 <h5 id="error"></h5>
		 <form class="connex_prof_form"> <!-- login_box to create account -->
			 <p class="id focus">
				 <input class="form-control" type="text" name="id_name" id="id_name" placeholder="Identifiant" />
		     </p>
			 <p>
				 <input class="form-control" type="password" name="pass_word" id="id_password" placeholder="Votre mot de passe"/>
		     </p>
			 <p>
				 <button type="button" id="valide_form" class="bt submit_connex_prof">Connexion</button>
		     </p>
		</form>
	  </div>
	  <footer>
		  <p>Parametrer ici la description de l'ecole, nom, address,contact</p>
	  </footer>
  </body>
  <script src="http://192.168.137.1/SControl/resources/js/jquery-ui.min.js"></script>
  <script src="http://192.168.137.1/SControl/resources/js/jquery-3.6.0.js"></script>
  <script src="http://192.168.137.1/SControl/resources/bootstrap/js/bootstrap.min.js"></script>
  <script src="http://192.168.137.1/SControl/resources/js/control_index.js"></script>
</html>
