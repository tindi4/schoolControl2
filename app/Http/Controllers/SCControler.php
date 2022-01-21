<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SCControler extends Controller
{
    //
    public function signIn(){
        return view('index');
    }

    public function checkLogin(Request $request){ //verifier si les information de login de carte sont correct

        if(isset($request)){ 
            $results = DB::select(/** @lang text */ 'select password from interface where contact = :contact',
                [
                    'contact' => $request->post('phone')
                ]);

            if($results!=NULL) {
                foreach ($results as $user) {

                    if (($user->password) == ($request->post('password'))) { //si le mot de passe est bon

                        $results2 = DB::select(/** @lang text */ 'select id from interface where contact = :contact', 
                            
                            [
                                'contact' => $request->post('phone')
                            ]);

                        foreach ($results2 as $userId) {
                            $id = $userId->id;
                        }

                        if($id==200){
                            session(['authSecre' => $id]); //cree la variable de session particulier a l'utilisateur
                        session(['userSecre' . $id => $id]); // utilisateur authentifier
                        }
                        if(($id!=100)&&($id!=200)&&($id!=300)){
                            session(['authProf' => $id]); //cree la variable de session particulier a l'utilisateur
                        session(['userProf' . $id => $id]); // utilisateur authentifier

                        }
                        
                        return response()->json(['answer' => 'Good', 'idL'=>$id]);

                    }
                     else {
                        return response()->json(['answer' => 'Bad']);
                    }
                }
            }
            else{
                return response()->json(['answer'=>'Bad']);
            }
        }
        else{
            return view('index');
        }

    }

    //Ouvrire l'interface d'administration du personel
    public function openInterface($id){

        //Verifier si ce utilisateur est vraiment authentifier
        if(isset($id)){
            $userSecre = session('authSecre');
            $userProf=session('authProf');
            if(($id==$userSecre)||($id==$userProf)){ //En verifiant la variable de session

                if($id==100){ //Si c'est le directeur

                }
                if($id==200){// Si c'est le service secretariat
                    $results1 = DB::select(/** @lang text */ 'select * from interface where id = :id', 
                        [
                            'id' => $id
                        
                        ]);
                    return view('home_secre', ['secre'=>$results1]);

                }
                if($id==300){// Si c'est l'econome
                    //Pour le moment le service secretariat gere l'economat

                }
                if(($id!=100)&&($id!=200)&&($id!=300)){
                    
                    //Pour un prof nous allons recuperer tous les informations disponible
                    $results = DB::select(/** @lang text */ 'select * from professeur where id = :id', // Information de 
                        // base sur le professeur
                        
                        [
                            'id' => $id
                        ]);

                        $Cours6 = DB::select(/** @lang text */ 'select * from classe6 where id_prof = :id', // Cours de 6eme ?
                            
                            [
                                'id' => $id
                            ]);
                            $Cours5 = DB::select(/** @lang text */ 'select * from classe5 where id_prof = :id', // Cours de 6eme ?
                            
                                [
                                    'id' => $id
                                ]);
                                $Cours4 = DB::select(/** @lang text */ 'select * from classe4 where id_prof = :id', // Cours de 6eme ?
                            
                                    [
                                        'id' => $id
                                    ]);
                                    $Cours3 = DB::select(/** @lang text */ 'select * from classe3 where id_prof = :id', // Cours de 6eme ?
                            
                                        [
                                            'id' => $id
                                        ]);

                        if($results!=NULL){
                            session(['classe6'=>$Cours6]); //Creation de session pour utiliser cree le select list dans les autres vue
                            session(['classe5'=>$Cours5]);
                            session(['classe4'=>$Cours4]);
                            session(['classe3'=>$Cours3]);
                            return view('home', ['professeur'=>$results, 'classe6'=>$Cours6, 'classe5'=>$Cours5, 'classe4'=>$Cours4,
                        'classe3'=>$Cours3]); //Envoyer au niveau de la vue, les classes du prof et cours.
                        }
                        
                       else{
                            return response()->json(['answer'=>'Bad']);
                        }

                }

            }
            else{
                return response()->json(['answer'=>'Bad']);
            }
        }

    }

}
