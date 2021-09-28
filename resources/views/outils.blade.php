<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
	<link
      rel="stylesheet"
	  type="text/css" href="http://192.168.137.1/SControl/resources/css/outils.css">
<title>Document sans nom</title>
</head>

<body>
	<div id="table">

		  <h1>Que voulez vous faire ?</h1>
		  <div id="tools">
			<div class="sub_tool">
			  <div class="tools_items item1s"> <!-- s pour dire secretaire-->
				  <h3>Imprimer<br/>des bulletins</h3>
				  <h5>Vous avez une autorisaation pour<br/>imprimer les bulletins ?<br/>Commencer ici.</h5>
			  </div>
			  <div class="tools_items item2s">
				  <h3>Demande<br/>d'autorisation</h3>
				  <h5 class="recent_activity">Demander une autorisation<br>pour imprimer des bulletins</h5>
			  </div>
			  </div>
			<div class="sub_tool">
			  <div class="tools_items item3s">
				  <h3>Registre <br/>eleves</h3>
				  <h5 class="recent_activity">Ajouter un nouveau <br/>eleve dans le registre</h5>
			  </div>
			  <div class="tools_items item4s">
				  <h3>Registre enseignent</h3>
				  <h5 class="recent_activity">Enregistrer un enseignent au registre</h5>
			  </div>
			</div>
		  </div>
	    </div>
	<div id="save_student">
				<div id="close_button">
				  <p><img alt="close" src="http://192.168.137.1/SControl/resources/img/close.png" width="30px"></p>
				</div>
				<div id="save_eleve">
					<div>
						<h3>Information generale</h3>
					</div>
					<p>
				        <input type="text" name="nom" id="nom" placeholder="Nom:"  />
		            </p>
					<p>
				        <input type="text" name="prenom" id="prenom" placeholder="Prenom:" />
		            </p>
					<p><label for="naissance">Date de naissance :</label>
				        <input type="date" name="naissance" id="naissance" placeholder="jj/mm/aaaa:"/>
		            </p>
					<p><label for="naissance">Lieu de naissance :</label>
				        <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de naissance:"/>
		            </p>
					<p><label for="date_cepd">Date obtention du CEPD :</label>
				        <input type="date" name="date_cepd" id="date_cepd" placeholder="jj/mm/aaaa:"/>
		            </p>
					<p><label for="date_entrer">Date d'entrer dans l'etablissement :</label>
				        <input type="date" name="date_entrer" id="date_entrer" placeholder="jj/mm/aaaa:"/>
		            </p>
					<p>
				        <input type="text" name="ecole_recent" id="ecole_recent" placeholder="Ecole recemment frequenter:"/>
		            </p>
					<p>
				        <input type="text" name="nom_pere" id="nom_pere" placeholder="Nom et prenom du pere:"/>
		            </p>
					<p>
				        <input type="text" name="profession_pere" id="prof_pere" placeholder="Profession du pere:"/>
		            </p>
					<p>
				        <input type="text" name="nom_mere" id="nom_mere" placeholder="Nom et prenom de la mere:"/>
		            </p>
					<p>
				        <input type="text" name="profession_mere" id="prof_mere" placeholder="Profession de la mere:"/>
		            </p>
					<p>
				        <input type="text" name="nom_tuteur" id="nom_tuteur" placeholder="Nom du tuteur:"/>
		            </p>
					<p>
				        <input type="text" name="tel_tuteur" id="tel_tuteur" placeholder="Numero de telephone du tuteur:"/>
		            </p>
					<p>
				        <input type="text" name="addr_tuteur" id="addr_tuteur" placeholder="Addresse du tuteur:"/>
		            </p>
					<h3>Admis pour la classe de :</h3>
					<div class="choixClass">
					<div class="Cbox">
						<p><label for="e6">6eme</label>
							<input type="radio" name="class" id="e6"/></p>
					</div>
					<div class="Cbox">
						<p><label for="e5">5eme</label>
						<input type="radio" name="class" id="e5"/></p>
					</div>
					<div class="Cbox">
						<p><label for="e4">4eme</label>
							<input type="radio" name="class" id="e4"/></p>
					</div>
					<div class="Cbox">
						<p><label for="e3">3eme</label>
							<input type="radio" name="class" id="e3"/></p>
					</div>

					</div>


					<div id="save_button">
			          <p>
				        <button type="button" id="bt_save_eleve" class="bt_save_eleve">Enregistrer</button>
		              </p>
		            </div>
				</div>
			</div>

	         <div id="save_teacher">
				<div id="close_button_teacher">
				  <p><img alt="close" src="http://192.168.137.1/SControl/resources/img/close.png" width="30px"></p>
				</div>
				<div id="save_enseignent">
					<div>
						<h3>Information generale</h3>
					</div>
					<p>
				        <input type="text" name="nom_teacher" id="nom_teacher" placeholder="Nom:"  />
		            </p>
					<p>
				        <input type="text" name="prenom_teacher" id="prenom_teacher" placeholder="Prenom:" />
		            </p>
					<p><label for="naissance">Date de naissance :</label>
				        <input type="date" name="naissance_teacher" id="naissance_teacher" placeholder="jj/mm/aaaa:"/>
		            </p>
					<p><label for="naissance">Lieu de naissance :</label>
				        <input type="text" name="lieu_naissance_teacher" id="lieu_naissance_teacher" placeholder="Lieu de naissance:"/>
		            </p>
					<p><label for="date_nomination">Date de nomination :</label>
				        <input type="date" name="date_nomination" id="date_nomination" placeholder="jj/mm/aaaa:"/>
		            </p>
					<p><label for="date_entrer">Date d'entrer dans l'etablissement :</label>
				        <input type="date" name="date_entrer_teacher" id="date_entrer_teacher" placeholder="jj/mm/aaaa:"/>
		            </p>
					<p>
				        <input type="text" name="ecole_autre" id="ecole_autre" placeholder="Travail dans les ecoles suivante:"/>
		            </p>
					<p>
						<label for="diplome">Le ou les diplome obtenues :</label>
				        <input type="text" name="diplome" id="diplome" placeholder="Separer les par des virgules (EX: BAC,LICENCE) :"/>
		            </p>

					<p>
				        <input type="text" name="tel_teacher" id="tel_teacher" placeholder="Numero de telephone :"/>
		            </p>
					<p>
				        <input type="text" name="addr_teacher" id="addr_teacher" placeholder="Addresse:"/>
		            </p>
                    <h3>Classe et matiere enseigner</h3>
					<p id="search2"><input type="text" id="searchCours" placeholder="Ajouter une matiere :"/><img id="adsCours" src="http://192.168.137.1/SControl/resources/img/ads.png" alt="ads" width="20px"/></p>
					<div class="choixClass">
					<div class="Cbox">
						<p><label for="c6">6eme</label>
							<input type="radio" name="class" id="c6"/></p>
						<p id="cours6"></p>
					</div>
					<div class="Cbox">
						<p><label for="c5">5eme</label>
						<input type="radio" name="class" id="c5"/></p>
						<p id="cours5"></p>
					</div>
					<div class="Cbox">
						<p><label for="c4">4eme</label>
							<input type="radio" name="class" id="c4"/></p>
						<p id="cours4"></p>
					</div>
					<div class="Cbox">
						<p><label for="c3">3eme</label>
							<input type="radio" name="class" id="c3"/></p>
						<p id="cours3"></p>
					</div>

					</div>



					<div id="save_button_teacher">
			          <p>
				        <button type="button" id="bt_save_teacher" class="bt_save">Enregistrer</button>
		              </p>
		            </div>
				</div>
			</div>
</body>
		<script src="http://192.168.137.1/SControl/resources/js/jquery-3.6.0.js"></script>
		<script src="http://192.168.137.1/SControl/resources/js/jquery-ui.min.js"></script>
		<script src="http://192.168.137.1/SControl/resources/js/secre_home.js"></script>
</html>
