<?php 


   if((isset($_POST['nom_t']))&&(isset($_POST['prenom_t']))&&(isset($_POST['classe']))&&(isset($_POST['tel_t']))&&(isset($_POST['d_diplome']))&&(isset($_POST['naissance_t']))&&(isset($_POST['lieu_t']))&&(isset($_POST['entrer_t']))&&(isset($_POST['nom_pere']))&&(isset($_POST['nom_mere']))&&(isset($_POST['nom_tuteur']))&&(isset($_POST['addr_tuteur']))){
		
		$ecole='NOTHING';
		$prof_pere='INDISPONIBLE';
		$prof_mere='INDISPONIBLE';
	
	
		if(isset($_POST['autre_ecole'])&&($_POST['autre_ecole'])!=''){
			$ecole=$_POST['autre_ecole'];
		}
		if(isset($_POST['prof_pere'])&&($_POST['prof_pere'])!=''){
			$prof_pere=$_POST['prof_pere'];
		}
		if(isset($_POST['prof_mere'])&&($_POST['prof_mere'])!=''){
			$prof_mere=$_POST['prof_mere'];
		}
		
		$ans=alreadyEleve($_POST['nom'], $_POST['prenom']);
		
		if(true){
		
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }
		
		$req = $bdd->prepare('INSERT INTO eleve(nom, prenom, date_naiss, lieu_naiss, classe, date_cepd, date_entrer, ecole_recent, nom_pere, prof_pere, nom_mere, prof_mere, nom_tuteur, tel_tuteur, addr_tuteur) VALUES(:nom, :prenom, :date_naiss, :lieu_naiss, :classe :date_cepd, :date_entrer, :ecole_recent, :nom_pere, :prof_pere, :nom_mere, :prof_mere, :nom_tuteur, :tel_tuteur, :addr_tuteur)');
        $req->execute(array(
	    'nom' => $_POST['nom_t'],
		'prenom'=>$_POST['prenom_t'],	
		'date_naiss' => $_POST['naissance_t'],
		'lieu_naiss' => $_POST['lieu_t'],
		'classe' => $_POST['classe'],
		'date_cepd' => $_POST['d_diplome'],
		'date_entrer' => $_POST['entrer_t'],
		'ecole_recent' => $ecole,
	    'nom_pere' => $_POST['nom_pere'],
		'nom_mere' => $_POST['nom_mere'],		
	    'prof_pere' => $prof_pere,
		'prof_mere' =>$prof_mere,
		'nom_tuteur' =>$_POST['nom_tuteur'],
		'tel_tuteur' =>$_POST['tel_t'],
		'addr_tuteur' =>$_POST['addr_tuteur']	
		
		));
		
		$req->closeCursor();
		
			$data=array();
			$data["accepte"]='ok';
			echo json_encode($data); 
       }//fin enregistrement et retour
		
		if(alreadyEleve($_POST['nom'], $_POST['prenom'])==false){	//numero dejas existant, proposer une mise a jours
	    $data=array();
	    $data["accepte"]='ko';
		echo json_encode($data); 
			
	    }	

}// fin test des variables envoyer 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Document sans titre</title>
</head>

<body>
</body>
</html>