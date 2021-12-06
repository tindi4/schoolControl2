<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    //Get nomber of previous notes for any course
    public function getNoteNb(Request $request){
        $i=0;
        $next=0;
        if(isset($request)){
            //si c'est une note d'interrogation
            if($request->post('type')==1){
                
                while(($i<=11)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select Interro'.($i+1).' from '.$request->post('cours').' where Interro'.($i+1).' is NULL');
                    if($req==NULL){ //il y a une note enregistrer a ce niveau
                        $i++;
                    }
                    else{
                        $next=1;
                       
                    }
                    if($next==1){
                    return response()->json(['answer' => 'Good', 'nbr'=>$i]);
                    }
                }
                
            }
        }
    }

    public function saveNote(Request $request){
        $i=0;
        $next=0;
        $up=0;
        $id;
        $good=0;
        if(isset($request)){

            //Si c'est une notes d'interrogation
            if($request->post('type')==1){
                
                while(($i<=11)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select Interro'.($i+1).' from '.$request->post('cours'));

                        $good=0; //definit si on doit continuer par chercher les notes suivantes ou non
                        $var ="Interro".($i+1);
                        foreach($req as $result){
                            if(($result->$var)!=NULL){
                            $good=1;
                            }
                        }

                    if($good==1){ //il ya une note enregistrer a ce niveau
                        $i++;
                    
                    }
                    else{
                        //A ce niveau il y a pas d'enregistrement, alors proceder a l'enregistrement
                        while($up<=sizeof($request->post('name'))){

                            //Recuperer le id correspondant au nom
                            $req=DB::select(/** @lang text */ 'select id from eleve where nom =:nom and prenom=:prenom', 
                                [
                                    'nom'=>($request->post('name'))[$up],
                                    'prenom'=>($request->post('nick'))[$up]
                                ]);

                                foreach($req as $result){
                                    $id=$result->id;
                                }

                                //Insertion de la note pour ce Id d'eleve
                                if($i==0){ //Si c'est la premiere note a inserer
                            DB::insert(/** @lang text */ 'insert into '.$request->post('cours').' (idEleve, Interro'.($i+1).') values (?, ?)',
                                [
                                    $id,
                                    ($request->post('note'))[$up]
                                ]);		
                            }
                            if($i!=0){ //Si c'est une note differente de la premiere

                                DB::update(/** @lang text */ 'update '.$request->post('cours').' set Interro'.($i+1).'=:note where idEleve=:id',
                                    [
                                        ($request->post('note'))[$up],
                                        $id,
                                    ]);		

                            }
                                $up++;
                        }
                        $next=1;
                       
                    }
                    if($next==1){
                    return response()->json(['answer' => 'Good']);
                    }
                }
                
            }
        }
    }

}