<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link
      rel="stylesheet"
	  type="text/css" href="http://192.168.137.1/SControl/resources/css/home.css">
<title>Document sans nom</title>
</head>

<body>
	<div id="enter_box">
			<div id="select">
			  <p>
				<label for="classe">Matiere :&nbsp;</label>
				  <select name="classe" id="classe">
					  <option value="none" selected>----</option>
					  <option value="5eme">SVT</option>
				      <option value="6eme">ECM</option>
				  </select>
				</p>
			</div>
			<div id="old_note">
				<p id="ads"><img alt="ads" src="resources/img/ads.png" width="25px"></p>
				<p class="note">DC1</p>
				<p class="note">DC2</p>
				<p class="note">DS1</p>
			</div>
			<div id="enter_note">
				<div id="close_button">
				  <p><img alt="close" src="resources/img/close.png" width="30px"></p>
				</div>
				<div id="enter_zone">
					<div class="head">
						<h3>Nom</h3>
						<h3>Notes</h3>
					</div>
					<p> <!-- Charger cette partie en recuperant la liste des eleve concerne par -->
						<label for="note_val">Nom eleve :</label>
				        <input type="text" name="note_val" id="note_val" placeholder="00" maxlength="4" />
		            </p>

					<div id="save_button">
			          <p>
				        <button type="button" id="save_note" class="bt save_note">Enregistrer</button>
		              </p>
		            </div>
				</div>
			</div>
		</div>

</body>
    <script src="http://192.168.137.1/SControl/resources/js/jquery-ui.min.js"></script>
    <script src="http://192.168.137.1/SControl/resources/js/jquery-3.6.0.js"></script>
	<script src="http://192.168.137.1/SControl/resources/js/liste_note.js"></script>
</html>

