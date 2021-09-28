<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class GetStudentController extends Controller
{
    //
    public function getStudentList(Request $request){ //Function recevant en request la classe demande

        if(isset($request)){

            $ClasseNo=$request->post('classe');  //Recuperation de la valeur numerique de la classe
    
            $results = DB::select(/** @lang text */ 'select nom, prenom from eleve where classe = :classe',
                [
                    'classe' => $ClasseNo
                ]);
        

        if($results!=NULL){ // Verifier si le resultat est bien sortie
            $i=0;
            foreach($results as $identification){
                $nom[$i]=$identification->nom.' '.$identification->prenom; // On enregistre dans un tableau de une colonne le nom
                //des etudiants.
                $i++;
            }

            return response()->json(['answer' => 'Good', 'name'=>$nom]); // On retourne le resultat au script de controle

        }
        else{
            return response()->json(['answer' => 'Bad']);

        }
    }

    }
}
