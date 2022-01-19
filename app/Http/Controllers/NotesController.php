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
        $classe=$request->post('classe');
        if(isset($request)){
            //si c'est une note d'interrogation
            if($request->post('type')==1){
                
                while(($i<=11)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select Interro'.($i+1).' from '.$request->post('cours').$classe);
                       $text='Interro'.($i+1);
                        if(empty($req)){ //Verifier si une note est retrouver
                             //Aucune note enregistrer
                             $next=1;
                             
                        }
                    
                    else{  //Pas de note enregistrer a ce niveau, arreter la boucle et autauriser
                        foreach($req as $note){
                            $val=$note->$text;
                        }
                        if($val==NULL){
                        $next=1;
                        }
                        else{
                            $i++;
                        }         
                       
                    }   
                }

                if(($next==1)&&($i<12)){  //Des notes sont enregistrer mais pas plein
                    return response()->json(['answer' => 'Good', 'nbr'=>$i]);
                    }

                if(($next==0)&&($i==12)){  //Notes pleine
                    return response()->json(['answer' => 'full', 'nbr'=>$i]);
                    }

                    if(($next==1)&&($i==0)){ //Aucune note enregistrer pour l'instant
                        return response()->json(['answer' => 'empty', 'nbr'=>$i]);
                        }   
            }

            //Si c'est une note de Devoir
            if($request->post('type')==2){
                
                while(($i<=11)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select DS'.($i+1).' from '.$request->post('cours').$classe);
                        $text='DS'.($i+1);
                        if(empty($req)){ //Verifier si une note est retrouver
                             //Aucune note enregistrer
                             $next=1;
                             
                        }
                    
                    else{  //Pas de note enregistrer a ce niveau, arreter la boucle et autauriser
                        foreach($req as $note){
                            $val=$note->$text;
                        }
                        if($val==NULL){
                        $next=1;
                        }
                        else{
                            $i++;
                        }         
                       
                    }   
                }

                if(($next==1)&&($i<12)){  //Des notes sont enregistrer mais pas plein
                    return response()->json(['answer' => 'Good', 'nbr'=>$i]);
                    }

                if(($next==0)&&($i==12)){  //Notes pleine
                    return response()->json(['answer' => 'full', 'nbr'=>$i]);
                    }

                    if(($next==1)&&($i==0)){ //Aucune note enregistrer pour l'instant
                        return response()->json(['answer' => 'empty', 'nbr'=>$i]);
                        }  
                
            }
            //Si c'est une note de Composition
            if($request->post('type')==3){
                
                while(($i<=3)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select Comp'.($i+1).' from '.$request->post('cours').$classe);
                        $text='Comp'.($i+1);
                        if(empty($req)){ //Verifier si une note est retrouver
                             //Aucune note enregistrer
                             $next=1;
                             
                        }
                    
                    else{  //Pas de note enregistrer a ce niveau, arreter la boucle et autauriser
                        foreach($req as $note){
                            $val=$note->$text;
                        }
                        if($val==NULL){
                        $next=1;
                        }
                        else{
                            $i++;
                        }         
                       
                    }   
                }

                if(($next==1)&&($i<4)){  //Des notes sont enregistrer mais pas plein
                    return response()->json(['answer' => 'Good', 'nbr'=>$i]);
                    }

                if(($next==0)&&($i==4)){  //Notes pleine
                    return response()->json(['answer' => 'full', 'nbr'=>$i]);
                    }

                    if(($next==1)&&($i==0)){ //Aucune note enregistrer pour l'instant
                        return response()->json(['answer' => 'empty', 'nbr'=>$i]);
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
        $classe=$request->post('classe');

        if(isset($request)){

            //Si c'est une notes d'interrogation
            if($request->post('type')==1){
                
                while(($i<=11)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select Interro'.($i+1).' from '.$request->post('cours').$classe);

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
                        while($up<=((sizeof($request->post('name'))-1))){

                            //Recuperer le id correspondant au nom
                            $req=DB::select(/** @lang text */ 'select id from eleve where nom =:nom and prenom=:prenom', 
                                [
                                    'nom'=>(($request->post('name'))[$up]),
                                    'prenom'=>($request->post('nick'))[$up]
                                ]);

                                foreach($req as $result){
                                    $id=$result->id;
                                }

                                //Insertion de la note pour ce Id d'eleve
                                if($i==0){ //Si c'est la premiere note a inserer
                            DB::insert(/** @lang text */ 'insert into '.$request->post('cours').$classe.' (idEleve, Interro'.($i+1).') values (?, ?)',
                                [
                                    $id,
                                    ($request->post('note'))[$up]
                                ]);		
                            }
                            if($i!=0){ //Si c'est une note differente de la premiere

                                DB::update(/** @lang text */ 'update '.$request->post('cours').$classe.' set Interro'.($i+1).'=:note where idEleve=:id',
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

            //Si c'est une note de devoir
            if($request->post('type')==2){
                
                while(($i<=11)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select DS'.($i+1).' from '.$request->post('cours').$classe);

                        $good=0; //definit si on doit continuer par chercher les notes suivantes ou non
                        $var ="DS".($i+1);
                        foreach($req as $result){
                            if(($result->$var)!=NULL){
                            $good=1;
                            }
                        }

                    if($good==1){ //il ya une note enregistrer a ce niveau
                        $i++; // pour lire le suivant enregistrement de note
                    
                    }
                    else{
                        //A ce niveau il y a pas d'enregistrement, alors proceder a l'enregistrement
                        while($up<=sizeof($request->post('name'))-1){

                            //Recuperer le id correspondant au nom
                            $req=DB::select(/** @lang text */ 'select id from eleve where nom =:nom and prenom=:prenom', 
                                [
                                    'nom'=>(($request->post('name'))[$up]),
                                    'prenom'=>($request->post('nick'))[$up]
                                ]);

                                foreach($req as $result){
                                    $id=$result->id;
                                }

                                //Insertion de la note pour ce Id d'eleve
                                if($i==0){ //Si c'est la premiere note a inserer
                            DB::update(/** @lang text */ 'update '.$request->post('cours').$classe.' set DS'.($i+1).'=:note where idEleve=:id',
                                [
                                    ($request->post('note'))[$up],
                                    $id
                                ]);		
                            }
                            if($i!=0){ //Si c'est une note differente de la premiere

                                DB::update(/** @lang text */ 'update '.$request->post('cours').$classe.' set DS'.($i+1).'=:note where idEleve=:id',
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

            //Si c'est une note de Compo
            if($request->post('type')==3){
                
                while(($i<=3)&&($next==0)){

                    $req=DB::select(/** @lang text */ 'select Comp'.($i+1).' from '.$request->post('cours').$classe);

                        $good=0; //definit si on doit continuer par chercher les notes suivantes ou non
                        $var ="Comp".($i+1);
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
                        while($up<=sizeof($request->post('name'))-1){

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
                            DB::update(/** @lang text */ 'update '.$request->post('cours').$classe.' set Comp'.($i+1).'=:note where idEleve=:id',
                                [
                                    ($request->post('note'))[$up],
                                    $id
                                ]);		
                            }
                            if($i!=0){ //Si c'est une note differente de la premiere

                                DB::update(/** @lang text */ 'update '.$request->post('cours').$classe.' set Comp'.($i+1).'=:note where idEleve=:id',
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