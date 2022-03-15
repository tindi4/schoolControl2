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

    public function listNote(Request $request){

        if(isset($request)){
            $rangNote=$request->post('range'); //Enieme note selectionner
            $typeNote=$request->post('type'); //Type 1, 2, 3
            $cours=$request->post('cours');
            $classe=$request->post('classe');

            //First get the name and ID of the concerned student
            $student=getStudentList($classe);
            $id=$student[0];
            $nom=$student[1];
            $nick=$student[2];
            $up=0;
            $notes;

            while($up<=(sizeof($id)-1)){

                //Rcuperations des notes concerner
                if($typeNote==1){ //Interro
                $req=DB::select(/** @lang text */ 'select interro'.$rangNote.' from '.$cours.''.$classe.' where idEleve=:id', 
                    [
                        'id'=>$id[$up]
                    ]);

                    //Charger la note dans une variable
                    $type='interro'.$rangNote;
                    foreach($req as $note){
                        $notes[$up]=$note->$type;
                    }

                $up++;

                if($up>(sizeof($id)-1)){
                    return response()->json(['answer'=>'Good','nom'=>$nom, 'nick'=>$nick, 'note'=>$notes, 'id'=>$id]);
                }
            }

            if($typeNote==2){ //Devoir
                $req=DB::select(/** @lang text */ 'select DS'.$rangNote.' from '.$cours.''.$classe.' where idEleve=:id', 
                    [
                        'id'=>$id[$up]
                    ]);

                    //Charger la note dans une variable
                    $type='DS'.$rangNote;
                    foreach($req as $note){
                        $notes[$up]=$note->$type;
                    }

                $up++;

                if($up>(sizeof($id)-1)){
                    return response()->json(['answer'=>'Good','nom'=>$nom, 'nick'=>$nick, 'note'=>$notes,  'id'=>$id]);
                }
            }

            if($typeNote==3){ //Compo
                $req=DB::select(/** @lang text */ 'select Comp'.$rangNote.' from '.$cours.''.$classe.' where idEleve=:id', 
                    [
                        'id'=>$id[$up]
                    ]);

                    //Charger la note dans une variable
                    $type='Comp'.$rangNote;
                    foreach($req as $note){
                        $notes[$up]=$note->$type;
                    }

                $up++;

                if($up>(sizeof($id)-1)){
                    return response()->json(['answer'=>'Good','nom'=>$nom, 'nick'=>$nick, 'note'=>$notes,  'id'=>$id]);
                }
            }
        }
        }

    }

    public function changeNote(Request $request){

        if(isset($request)){
            $rangNote=$request->post('range'); //Enieme note selectionner
            $typeNote=$request->post('typeNote'); //Type 1, 2, 3
            $cours=$request->post('cours');
            $classe=$request->post('classe');
            $eleveId=$request->post('eleveId');
            $newNote=$request->post('newNote');

            if($typeNote==1){ //Interro
               $succes= DB::update(/** @lang text */ 'update '.$cours.$classe.' set interro'.($rangNote).'=:note where idEleve=:id',
                    [
                        $newNote,
                        $eleveId
                    ]);	

                    //Verifier la reussite
                if($succes){
                    return response()->json(['answer'=>'Good']);
                }
                else{
                    return response()->json(['answer'=>'False']);
                }
            }

            if($typeNote==2){ //Devoir
                
                $succes= DB::update(/** @lang text */ 'update '.$cours.$classe.' set DS'.($rangNote).'=:note where idEleve=:id',
                     [
                         $newNote,
                         $eleveId
                     ]);	
 
                     //Verifier la reussite ??????/
                
                     if($succes!=0){
                        return response()->json(['answer'=>'Good']);
                    }
                    else{
                        return response()->json(['answer'=>'False']);
                    }
                
             }

             if($typeNote==3){ //Composition
                $succes= DB::update(/** @lang text */ 'update '.$cours.$classe.' set Comp'.($rangNote).'=:note where idEleve=:id',
                     [
                         $newNote,
                         $eleveId
                     ]);	
 
                     //Verifier la reussite
                 if($succes!=0){
                     return response()->json(['answer'=>'Good']);
                 }
                 else{
                     return response()->json(['answer'=>'False']);
                 }
             }

        }

    }

}

function getStudentList($classe){ //Function recevant en request la classe demande

    if(isset($classe)){

        $ClasseNo=$classe;  //Recuperation de la valeur numerique de la classe

        $results = DB::select(/** @lang text */ 'select id, nom, prenom from eleve where classe = :classe',
            [
                'classe' => $ClasseNo
            ]);
    

    if($results!=NULL){ // Verifier si le resultat est bien sortie
        $i=0;
        foreach($results as $identification){
            $id[$i]=$identification->id;
            $nom[$i]=$identification->nom; // On enregistre dans un tableau de une colonne le nom
            $nick[$i]=$identification->prenom;
            //des etudiants.
            $i++;
        }

        return array($id,$nom,$nick);


    }
    else{

    }
}

}