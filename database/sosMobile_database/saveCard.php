<?php
// Recuperation information de la carte

$variable = $_POST;
$nbrVariable = count($variable);

if($nbrVariable!=0){

    if(true){

        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=sosmobile;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        $req = $bdd->prepare('INSERT INTO card(name, nick, password, compagnieName, service, location, contact, slogant, describe) VALUES(:name, :nick, :password, :compagnieName, :service, :location, :contact, :slogant, :describe)');
        $req->execute(array(
            'name' => $_POST['name'],
            'nick' => $_POST['nick'],
            'password'=> $_POST['password'],
            'compagnieName'=> $_POST['compagnieName'],
            'service'=> $_POST['service'],
            'location'=> $_POST['location'],
            'contact'=> $_POST['contact'],
            'slogant' => $_POST['slogant'],
            'describe'=> $_POST['describe']
        ));

        $req->closeCursor();
    }
    /*else{
        $data=array();
        $data['accepte']=strval('Vous etes dejas enregistrer !');
        echo json_encode($data);
    }*/
}

/*function to verif newGoalMember, function_name acceptNewGoalMember(); return true if the data is not pre
sent in the database*/


function acceptNewGoalMember($name){

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=sosmobile;charset=utf8', 'root', '');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $answer = $bdd->query('SELECT contact FROM card');

    $true='ok';
    $continue=1; /* if it 1, authoriezed to continue and search value in data_base*/

    while (($donnees=$answer->fetch())&&($continue==1)) /* verification continuation*/
    {
        if(($name==$donnees['name'])){ /*verification for secure connection*/

            $continue=0; /*commande the exit of the boucle*/

            /*good, continue, set the variable below and return it*/
            $true='ko';

        }

    }

    $answer->closeCursor(); /*close access to data_base*/
    return($true);

}
