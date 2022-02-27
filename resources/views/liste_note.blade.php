<?php session_start();
$classe6=$_SESSION['classe6'];
$classe5=$_SESSION['classe5'];
$classe4=$_SESSION['classe4'];
$classe3=$_SESSION['classe3'];

?>

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
                    <optgroup id="6eme" label="6eme">
                        <?php  //Charger les cours de la classe de 6eme
				  if(isset($classe6)&&($classe6!=NULL)){
					  foreach($classe6 as $value){ ?>
                        <option value="<?php echo $value->matiere ?>"><?php echo $value->matiere ?></option>
                        <?php
					  }
				  }
				  ?>
                    </optgroup>

                    <optgroup id="5eme" label="5eme">
                        <?php  //Charger les cours de la classe de 5eme
				  if(isset($classe5)&&($classe5!=NULL)){
					  foreach($classe5 as $value){ ?>
                        <option value="<?php echo $value->matiere ?>"><?php echo $value->matiere ?></option>
                        <?php
					  }
				  }
				  ?>
                    </optgroup>

                    <optgroup id="4eme" label="4eme">
                        <?php  //Charger les cours de la classe de 4eme
				  if(isset($classe4)&&($classe4!=NULL)){
					  foreach($classe4 as $value){ ?>
                        <option value="<?php echo $value->matiere ?>"><?php echo $value->matiere ?></option>
                        <?php
					  }
				  }
				  ?>
                    </optgroup>

                    <optgroup id="3eme" label="3eme">
                        <?php  //Charger les cours de la classe de 3eme
				  if(isset($classe3)&&($classe3!=NULL)){
					  foreach($classe3 as $value){ ?>
                        <option value="<?php echo $value->matiere ?>"><?php echo $value->matiere ?></option>
                        <?php
					  }
				  }
				  ?>
                    </optgroup>

                </select>
            </p>
        </div>
		<div id="typeNote">
		    <input type="radio" id="interro" name="typeNote" value="interro">
            <label for="interro">Interrogations</label><br>
            <input type="radio" id="devoir" name="typeNote" value="devoir">
            <label for="devoir">Devoirs</label><br>
            <input type="radio" id="compo" name="typeNote" value="compo">
            <label for="compo">Compositions</label>
		</div>
		<div id="old_note">
            <!--<p id="ads"><img alt="ads" src="http://192.168.137.1/SControl/resources/img/ads.png" width="25px"></p>-->

        </div>
			<div id="noteList">
				<div id="close_button">
				  <p><img alt="close" src="http://192.168.137.1/SControl/resources/img/close.png" width="30px"></p>
				</div>
				<div id="enter_zone">
				    <div id="selectTypeNote">
                
				    </div>

					<div id="alertChangeNote">
			<h3>Modifer cette note</h3>
			<input type="number" placeholder="00" maxlength="5"/>
			<button>Valider</button>
		</div>


					<div class="head">
						<h3>Nom</h3>
						<h3>Notes</h3>
					</div>
					<!-- <p> ||Paertie de listage des notes dynamique avec Jquerry
						<label for="note_val">Nom eleve :</label>
				        <input type="text" name="note_val" id="note_val" placeholder="00" maxlength="4" />
		            </p> -->

					<div id="save_button">
			          <p>
				        <button type="button" id="save_note" class="bt save_note">Enregistrer</button>
		              </p>
		            </div>
				</div>
			</div>
		</div>
		
</body>
	<script src="http://192.168.137.1/SControl/resources/js/liste_note.js"></script>
</html>

