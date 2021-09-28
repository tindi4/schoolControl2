<?php

//enregistrement enseigent

//fonction enregistrer le cours

function saveCours($classe, $matiere, $id){
	
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }
		
		if($classe=='6'){
			$req = $bdd->prepare('INSERT INTO classe6(id_prof, matiere) VALUES(:id_prof, :matiere)');
		}
	    if($classe=='5'){
			$req = $bdd->prepare('INSERT INTO classe5(id_prof, matiere) VALUES(:id_prof, :matiere)');
		}
	    if($classe=='4'){
			$req = $bdd->prepare('INSERT INTO classe4(id_prof, matiere) VALUES(:id_prof, :matiere)');
		}
	    if($classe=='3'){
			$req = $bdd->prepare('INSERT INTO classe3(id_prof, matiere) VALUES(:id_prof, :matiere)');
		}
	
	    $req->execute(array(
	    'id_prof' => $id,
		'matiere'=>$matiere
		));
		$req->closeCursor();	
}

//fonction verifier si existe dejas

function already($num){
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }

       $answer = $bdd->query('SELECT tel FROM professeur');
		
		$true='ok';
		$continue=1; /* if it 1, authoriezed to continue and search value in data_base*/

       while (($donnees=$answer->fetch())&&($continue==1)) /* verification continuation*/
       {
	      if(($num==$donnees['tel'])){ /*verification for secure connection*/
			  
			  $continue=0; /*commande the exit of the boucle*/
			  			  
		  }
		
       }
		
		$answer->closeCursor(); /*close access to data_base*/
	
	if($continue==1){
		return(true);
	}
	if($continue==0){
		return(false);
	}
		
}

//function to insert classe of teacher

function insertClasse($classe,$id){
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }
	$req= $bdd->prepare('UPDATE professeur SET classe = :classe WHERE id=:id');
	$req->execute(array(
	'classe'=>$classe,
	'id'=>$id	
	));
	
	$req->closeCursor();
}

function alreadyEleve($nom, $prenom){
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }

       $answer = $bdd->query('SELECT nom, prenom FROM eleve');
		
		$true='ok';
		$continue=1; /* if it 1, authoriezed to continue and search value in data_base*/

       while (($donnees=$answer->fetch())&&($continue==1)) /* verification continuation*/
       {
	      if(($nom==$donnees['nom'])&&($prenom==$donnees['prenom'])){ /*verification for secure connection*/
			  
			  $continue=0; /*commande the exit of the boucle*/
			  $true='ko';
			  			  
		  }
		
       }
		
		$answer->closeCursor(); /*close access to data_base*/
	
	
	
		return($true);
	
		
}

//identifier le code de type d'enregistrement envoyer

if((isset($_POST['code']))&&($_POST['code']=='21314151667788')){ //commencer enregistrement enseignent
	
	if((isset($_POST['nom_t']))&&(isset($_POST['prenom_t']))&&(isset($_POST['tel_t']))&&(isset($_POST['diplome']))&&(isset($_POST['naissance_t']))&&(isset($_POST['lieu_t']))&&(isset($_POST['addr_t']))&&(isset($_POST['entrer_t']))&&(isset($_POST['cours']))){
		
		$ecole='NOTHING';
		$date_nomer='INDISPONIBLE';
	
	
		if(isset($_POST['autre_ecole'])&&($_POST['autre_ecole'])!=''){
			$ecole=$_POST['autre_ecole'];
		}
		if(isset($_POST['date_nomer'])&&($_POST['date_nomer'])!=''){
			$date_nomer=$_POST['date_nomer'];
		}
		
		$ans=already($_POST['tel_t']);
		
		if(already($_POST['tel_t'])){
		
		$var=strval($_POST['nom_t']);
		$varb=strval($_POST['prenom_t']);
		$pass=$varb[1].[0].$_POST['tel'].$var[2].$varb[0]; //encodement du mot de passe temporaire
		
		
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }
		
		$req = $bdd->prepare('INSERT INTO professeur(nom, prenom, tel, pass, date_naiss, lieu_naiss, autre_ecole, date_nomer, date_entrer, diplome, addresse) VALUES(:nom, :prenom, :tel, :pass, :date_naiss, :lieu_naiss, :autre_ecole, :date_nomer, :date_entrer, :diplome, :addresse)');
        $req->execute(array(
	    'nom' => $_POST['nom_t'],
		'prenom'=>$_POST['prenom_t'],	
	    'tel' => $_POST['tel_t'],
	    'pass' => $pass,
		'date_naiss' => $_POST['naissance_t'],
		'lieu_naiss' => $_POST['lieu_t'],
		'autre_ecole' => $ecole,
		'date_nomer' => $date_nomer,
		'date_entrer' => $_POST['entrer_t'],
		'diplome' => $_POST['diplome'],
		'addresse' => $_POST['addr_t']	
		));
		
		$req->closeCursor();
		
	   $answer = $bdd->prepare('SELECT id FROM professeur WHERE tel = ? ');
       $answer->execute(array($_POST['tel_t']));
		
       while ($donnees = $answer->fetch()) /* verification continuation*/
       {
	          $newId=$donnees['id'];		 
       }
       $answer->closeCursor(); /*close access to data_base*/
		
	//enregistrement des cours concerner par ce enseignent
	
	    $varClasse;
		$classe='';	
		$coursUnity='';	
	    $coursEncode=$_POST['cours'];
		$size=strlen($coursEncode);
		$ok6=1;
		$ok5=1;
		$ok4=1;
		$ok3=1;	
		for($i=0; $i<=$size; $i++){
			
			if($coursEncode[$i]=='6'){		
				$varClasse='6';
				if($ok6==1){
				$classe.='6-';
					$ok6=2;
				}
			}
			if($coursEncode[$i]=='5'){
				$varClasse='5';
				if($ok5==1){
				$classe.='5-';
					$ok5=2;
				}
			}
			if($coursEncode[$i]=='4'){
				$varClasse='4';
				if($ok4==1){
				$classe.='4-';
					$ok4=2;
				}
			}
			if($coursEncode[$i]=='3'){
				$varClasse='3';
				if($ok3==1){
				$classe.='3';
					$ok3=2;
				}
			}
			if(($coursEncode[$i]!='6')&&($coursEncode[$i]!='5')&&($coursEncode[$i]!='4')&&($coursEncode[$i]!='3')&&($coursEncode[$i]!=',')){
				$coursUnity.=$coursEncode[$i];
			}
			if($coursEncode[$i]==','){
				saveCours($varClasse, $coursUnity, $newId);
				$coursUnity='';
			}
			
		}
			insertClasse($classe, $newId);
			//enregistrement terminer: retouner la valeur du mot de pass temporaire
			$data=array();
			$data["accepte"]='ok';
			echo json_encode($data); 
       }//fin enregistrement et retour
		
		if(already($_POST['tel_t'])==false){	//numero dejas existant, proposer une mise a jours
	    $data=array();
	    $data["accepte"]='ko';
		echo json_encode($data); 
			
	    }	

}// fin test des variables envoyer 
}
//fin test du code d'enregistrement envoyer

//enregistrement du type eleve
if((isset($_POST['code']))&&($_POST['code']=='21314991667700')){ //commencer enregistrement eleve
	
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
		
		$ans=alreadyEleve($_POST['nom_t'], $_POST['prenom_t']);
		
		if($ans=='ok'){
		
	
	try
       {
	       $bdd = new PDO('mysql:host=localhost;dbname=school_contoler;charset=utf8', 'root', '');
       }
       catch(Exception $e)
       {
        die('Erreur : '.$e->getMessage());
       }
		
		$req = $bdd->prepare('INSERT INTO eleve(nom, prenom, date_naiss, lieu_naiss, classe, date_cepd, date_entrer, ecole_recent, nom_pere, prof_pere, nom_mere, prof_mere, nom_tuteur, tel_tuteur, addr_tuteur) VALUES(:nom, :prenom, :date_naiss, :lieu_naiss, :classe, :date_cepd, :date_entrer, :ecole_recent, :nom_pere, :prof_pere, :nom_mere, :prof_mere, :nom_tuteur, :tel_tuteur, :addr_tuteur)');
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
		}
		if($ans=='ko'){	//numero dejas existant, proposer une mise a jours
	    $data=array();
	    $data["accepte"]='ko';
		echo json_encode($data); 
			
	    }	 
}
}
?>