<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class personControler extends Controller
{

    public function savePerson(Request $request){

//enregistrement enseigent

//fonction enregistrer le cours

function saveCours($classe, $matiere, $id){
	

		if($classe=='6'){

            DB::insert(/** @lang text */ 'insert into classe6 (id_prof, matiere) values (?, ?)',
                [
                    $id,
                    $matiere
                ]);
		}
	    if($classe=='5'){

            DB::insert(/** @lang text */ 'insert into classe5 (id_prof, matiere) values (?, ?)',
                [
                    $id,
                    $matiere
                ]);		
            }
	    if($classe=='4'){

            DB::insert(/** @lang text */ 'insert into classe4 (id_prof, matiere) values (?, ?)',
                [
                    $id,
                    $matiere
                ]);		
            }
	    if($classe=='3')
        {
            DB::insert(/** @lang text */ 'insert into classe3 (id_prof, matiere) values (?, ?)',
                [
                    $id,
                    $matiere
                ]);		
            }
	
}

//fonction verifier si existe dejas

function already($num){
	
       $answer = DB::select(/** @lang text */ 'select tel from professeur');
        
		$true='ok';
		$continue=1; /* if it 1, authoriezed to continue and search value in data_base*/

        foreach($answer as $donnees) /* verification continuation*/
       {
	      if(($num==$donnees->tel)){ /*verification for secure connection*/
			  
			  $continue=0; /*commande the exit of the boucle*/
			  			  
		  }
		
       }
		
		//$answer->closeCursor(); /*close access to data_base*/
	
	if($continue==1){
		return(true);
	}
	if($continue==0){
		return(false);
	}
		
}

//function to insert classe of teacher

function insertClasse($classe,$id){
	

    $req=DB::update(/** @lang text */ 'update professeur set classe = ? where id = ?',
        [
           $classe,
           $id
        ]);
	
	//$req->closeCursor();
}

function alreadyEleve($nom, $prenom){

       $answer = DB::select(/** @lang text */ 'select nom, prenom from eleve');


		
		$true='ok';
		$continue=1; /* if it 1, authoriezed to continue and search value in data_base*/

       foreach($answer as $donnees) /* verification continuation*/
       {
	      if(($nom==$donnees->nom)&&($prenom==$donnees->prenom)){ /*verification for secure connection*/
			  
			  $continue=0; /*commande the exit of the boucle*/
			  $true='ko';
			  			  
		  }
		
       }
		
		//$answer->closeCursor(); /*close access to data_base*/
	
	
	
		return($true);
	
		
}

//identifier le code de type d'enregistrement envoyer

if((($request->post('code')!=NULL))&&($request->post('code')=='21314151667788')){ //commencer enregistrement enseignent

	$test=1;
	$newId;
	$classe='';
	$ok6=1;
	$ok5=1;
	$ok4=1;
	$ok3=1;	
	
	if((($request->post('nom_t')!=NULL))&&(($request->post('prenom_t')!=NULL))&&(($request->post('tel_t')!=NULL))
	&&(NULL!=($request->post('diplome')))&&(NULL!=($request->post('naissance_t')))&&(NULL!=($request->post('lieu_t')))
	&&(NULL!=($request->post('addr_t')))&&(NULL!=($request->post('entrer_t')))&&(NULL!=($request->post('cours')))){
		
		$ecole='NOTHING';
		$date_nomer='INDISPONIBLE';

		//************************************************************Determiner la classe
		$coursEncode=strval($request->post('cours'));
		$size=strlen($coursEncode);
		for($i=0; $i<=$size; $i++){
						
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='6'){		
				if($ok6==1){
					$classe.='6-';
					$ok6=2;
				}
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='5'){
				if($ok5==1){
					$classe.='5-';
					$ok5=2;
				}
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='4'){
				if($ok4==1){
					$classe.='4-';
					$ok4=2;
				}
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='3'){
				if($ok3==1){
					$classe.='3';
					$ok3=2;
				}
			}
			
		}//*********************************************Fin de la determination des classe concerne par ce prof
		
	
	
		if(NULL!=($request->post('autre_ecole'))&&($request->post('autre_ecole'))!=''){
			$ecole=$request->post('autre_ecole');
		}
		if(NULL!=($request->post('date_nomer'))&&($request->post('date_nomer'))!=''){
			$date_nomer=$request->post('date_nomer');
		}
		
		$ans=already($request->post('tel_t'));
		
		
		if(already($request->post('tel_t'))){
		
		$var=strval($request->post('nom_t'));
		$varb=strval($request->post('prenom_t'));
		$pass=$varb[1].$request->post('tel').$var[2].$varb[0]; //encodement du mot de passe temporaire
		
		

        $req = DB::insert(/** @lang text */ 'insert into professeur (nom, prenom, tel, classe, pass, date_naiss, lieu_naiss, 
			autre_ecole, date_nomer, date_entrer, diplome, addresse) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
             $request->post('nom_t'),
		     $request->post('prenom_t'),	
	         $request->post('tel_t'),
			 $classe,
	         $pass,
		     $request->post('naissance_t'),
		     $request->post('lieu_t'),
		     $ecole,
		     $date_nomer,
		     $request->post('entrer_t'),
		     $request->post('diplome'),
		     $request->post('addr_t')
            ]);
		
			
		//$req->closeCursor();
		
		//Ici on selectionne le id sous lequel est enregistrer le prof
		$GLOBALS['newId']='';
       $answer = DB::select(/** @lang text */ 'select id from professeur where tel = :tel',
        [
            'tel' => $request->post('tel_t')
        ]);

       foreach ($answer as $donnees) /* verification continuation*/
       {
		$GLOBALS['newId']=$donnees->id;		 
       }

	   //Ensuite enregistrement sur l'interface generale avec le id selectionner
			$inter = DB::insert(/** @lang text */ 'insert into interface (id, contact, password, nom, prenom) values (?, ?, ?, ?, ?)',
				[
				 $GLOBALS['newId'],
				 $request->post('tel_t'),
				 $pass,
				 $request->post('nom_t'),
				 $request->post('prenom_t')
				]);
			

       //$answer->closeCursor(); /*close access to data_base*/
		
	//enregistrement des cours concerner par ce enseignent
	
	    $varClasse;
		$GLOBALS['classe']='';	
		$GLOBALS['test']=0;
		$coursUnity='';	
	    $coursEncode=strval($request->post('cours'));
		$size=strlen($coursEncode);
		$ok6=1;
		$ok5=1;
		$ok4=1;
		$ok3=1;	
		for($i=0; $i<=$size; $i++){
			
			$GLOBALS['test']=1;
			
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='6'){		
				$varClasse='6';
				if($ok6==1){
					$GLOBALS['classe'].='6-';
					$ok6=2;
				}
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='5'){
				$varClasse='5';
				if($ok5==1){
					$GLOBALS['classe'].='5-';
					$ok5=2;
				}
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='4'){
				$varClasse='4';
				if($ok4==1){
					$GLOBALS['classe'].='4-';
					$ok4=2;
				}
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]=='3'){
				$varClasse='3';
				if($ok3==1){
					$GLOBALS['classe'].='3';
					$ok3=2;
				}
			}
			if(isset($coursEncode[$i])&&($coursEncode[$i]!='6')&&($coursEncode[$i]!='5')&&($coursEncode[$i]!='4')&&($coursEncode[$i]!='3')&&
			($coursEncode[$i]!=',')){
				$coursUnity.=$coursEncode[$i];
			}
			if(isset($coursEncode[$i])&&$coursEncode[$i]==','){
				saveCours($varClasse, $coursUnity, $GLOBALS['newId']);
				$coursUnity='';
			}
			
		}
		
       }//fin enregistrement et retour

	  
		
		

}// fin test des variables envoyer 

if(isset($GLOBALS['test'])&&$GLOBALS['test'] ==1){
	insertClasse(strval($GLOBALS['classe']), $GLOBALS['newId']);
	//enregistrement terminer: retouner la valeur du mot de pass temporaire
	$var=strval($request->post('nom_t'));
	$varb=strval($request->post('prenom_t'));
	$pass=$varb[1].$request->post('tel').$var[2].$varb[0];

	$data=array();
	$data["accepte"]='ok';
	$data["pass"]=$pass;

	return response()->json($data); 
   }

   if(!isset($GLOBALS['test'])){
	$data=array();
	$data["accepte"]='ko';
	return response()->json($data); 
   }
}
//fin test du code d'enregistrement envoyer

//enregistrement du type eleve
if((NULL!=($request->post('code')))&&($request->post('code')=='21314991667700')){ //commencer enregistrement eleve
	
	 if((NULL!=($request->post('nom_t')))&&(NULL!=($request->post('prenom_t')))&&(NULL!=($request->post('classe')))&&
	 (NULL!=($request->post('tel_t')))&&(NULL!=($request->post('d_diplome')))&&(NULL!=($request->post('naissance_t')))&&
	 (NULL!=($request->post('lieu_t')))&&(NULL!=($request->post('entrer_t')))&&(NULL!=($request->post('nom_pere')))&&
	 (NULL!=($request->post('nom_mere')))&&(NULL!=($request->post('nom_tuteur')))&&(NULL!=($request->post('addr_tuteur')))){
		 
		 $ecole='NOTHING';
		$prof_pere='INDISPONIBLE';
		$prof_mere='INDISPONIBLE';
	
	
		if(NULL!=($request->post('autre_ecole'))&&($request->post('autre_ecole'))!=''){
			$ecole=$request->post('autre_ecole');
		}
		if(NULL!=($request->post('prof_pere'))&&($request->post('prof_pere'))!=''){
			$prof_pere=$request->post('prof_pere');
		}
		if(NULL!=($request->post('prof_mere'))&&($request->post('prof_mere'))!=''){
			$prof_mere=$request->post('prof_mere');
		}
		
		$ans=alreadyEleve($request->post('nom_t'), $request->post('prenom_t'));
		
		if($ans=='ok'){
		
        $req = DB::insert(/** @lang text */ 'insert into eleve (nom, prenom, date_naiss, lieu_naiss, classe, date_cepd, 
			date_entrer, ecole_recent, nom_pere, prof_pere, nom_mere, prof_mere, nom_tuteur, tel_tuteur, addr_tuteur) 
			values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $request->post('nom_t'),
                $request->post('prenom_t'),	
                $request->post('naissance_t'),
                $request->post('lieu_t'),
                $request->post('classe'),
                $request->post('d_diplome'),
                $request->post('entrer_t'),
                $ecole,
                $request->post('nom_pere'),
                $request->post('nom_mere'),		
                $prof_pere,
                $prof_mere,
                $request->post('nom_tuteur'),
                $request->post('tel_t'),
                $request->post('addr_tuteur')	
            ]);
		
		//$req->closeCursor();
			
			$data=array();
			$data["accepte"]='ok';
			return response()->json($data); 
		}
		if($ans=='ko'){	//numero dejas existant, proposer une mise a jours
	    $data=array();
	    $data["accepte"]='ko';
		return response()->json($data); 
			
	    }	 
} //Fin test info eleve
} //Fin enregistrement eleve

    
}


}    