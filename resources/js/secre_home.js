// JavaScript Document
$(function(){

	/*script for secretaire outils*/

	modal= 1;
	var c6=60;
	var c5=50;
	var c4=40;
	var c3=30;
	var classe='';
	var cours6='';
	var cours5='';
	var cours4='';
	var cours3='';
	var cours_t;
	var cours = [
    "SVT",
    "Science-Physique",
    "Mathematique",
    "ECM",
    "Histoire-Geographie",
	"Francais",
	"Anglais",
	"EPS"


];

	$('#close_button').click(function(){  /*button de fermetture*/

		document.getElementById("save_student").style.display="none";
		modal=1;
	});
	$('#close_button_teacher').click(function(){  /*button de fermetture*/

		document.getElementById("save_teacher").style.display="none";
		modal=1;
	});

	//Configuration des bouton de navigation
	$('#openHome').click(function(){

		if(modal!=3){
			$('#display_content').load('http://192.168.137.1/SControl/resources/views/home_secre_refresh.blade.php');
			modal=2;
			}
			else{
				alert('vous avez une fenetre ouverte !');
			}

	});

	$('#tool').click(function(){

		if(modal!=3){
			$('#display_content').load('http://192.168.137.1/SControl/resources/views/outils.blade.php');
			modal=2;
			}
			else{
				alert('vous avez une fenetre ouverte !');
			}

	});

	$('.item1s').click(function(){

		if(modal!=3){
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
		modal=3;
		}
		else{
			alert('vous avez une fenetre ouverte !');
		}
	});

	$('.item2s').click(function(){

		if(modal!=3){
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
		modal=3;
		}
		else{
			alert('vous avez une fenetre ouverte !');
		}
	});

	$('.item3s').click(function(){ /*button ouvertur enregistrement eleves*/

		if(modal!=3){
		document.getElementById("save_student").style.display="block"; /*afficher l'enregistreur eleves*/
		modal=3;
		}
		else{
			alert('vous avez une fenetre ouverte !');
		}
	});

	$('.item4s').click(function(){
		if(modal!=3){
		document.getElementById("save_teacher").style.display="block"; /*afficher l'enregistreur eleves*/
		modal=3;
		}
		else{
			alert('vous avez une fenetre ouverte !');
		}
	});

	$('#searchCours').autocomplete({
    source : cours,
	minLength:1,

        my : 'bottom',
        at : 'top'
    // ici, ma liste se placera au-dessus et à l'extérieur de mon champ de texte
});

	$('#adsCours').click(function(){  //ajouter des cours au enseignant selon classe choisie

		if(isFormGood('#searchCours')){ //verifier si le input est !=nul

			if(isItemInArray($('#searchCours').val(), cours)){ //verifier si le cours est valide

		if(document.getElementById('c6').checked==true){

			if(isPresente($('#searchCours').val(), c6, 60)){
			$('<p class="cours i'+c6+'">'+$('#searchCours').val()+'</p>').appendTo($('#cours6'));
			c6++;
			cours6+='6'+$('#searchCours').val()+',';
		}
			else{
				alert('Matiere deja ajouter !');
			}
		}


		else if(document.getElementById('c5').checked==true){
			if(isPresente($('#searchCours').val(), c5, 50)){
			$('<p class="cours i'+c5+'">'+$('#searchCours').val()+'</p>').appendTo($('#cours5'));
			c5++;
			cours5+='5'+$('#searchCours').val()+',';
		}
			else{
				alert('Matiere deja ajouter !');
			}
		}



		else if(document.getElementById('c4').checked==true){
			if(isPresente($('#searchCours').val(), c4, 40)){
			$('<p class="cours i'+c4+'">'+$('#searchCours').val()+'</p>').appendTo($('#cours4'));
			c4++;
			cours4+='4'+$('#searchCours').val()+',';
		}
			else{
				alert('Matiere deja ajouter !');
			}
		}



		else if(document.getElementById('c3').checked==true){
			if(isPresente($('#searchCours').val(), c3, 30)){
			$('<p class="cours i'+c3+'">'+$('#searchCours').val()+'</p>').appendTo($('#cours3'));
			c3++;
			cours3+='3'+$('#searchCours').val()+',';
		}
			else{
				alert('Matiere deja ajouter !');
			}
		}

		else{
			alert('Veuillez selectionner une salle de classe ci-dessous !');
		}

		}

		else{
			alert('Veuillez ajouter un nom de cours valide !');
		}

		}

		else{
			alert('Ajouter dabort une matiere !');
		}
	});
	//fin ajout de cours aux enseignent;
	//Supression de cours
	$('.cours').click(function(){

		alert('cliquer');
		var clas =$(this).attr('class');
		$('.'+clas).remove();
	});

	$('#bt_save_teacher').click(function(){ //Enregistrer la creation d'un nouveau enseignent

		if(isFormGood('#nom_teacher')&&isFormGood('#prenom_teacher')&&isFormGood('#diplome')&&isFormGood('#naissance_teacher')&&isFormGood('#lieu_naissance_teacher')&&isFormGood('#addr_teacher')&&isFormGood('#date_entrer_teacher')){
			if(isGoodPhoneNum('#tel_teacher')){
				if((c6!=60)||(c5!=50)||(c4!=40)||(c3!=30)){
					alert('good form ):');

					cours_t=cours6+cours5+cours4+cours3;
					var code='21314151667788';
					alert(cours_t);

//variable a envoyer pour enregistrement enseignent
var nom_t=$('#nom_teacher').val();
var prenom_t=$('#prenom_teacher').val();
var tel_t=$('#tel_teacher').val();
var diplome=$('#diplome').val();
var naissance_t=$('#naissance_teacher').val();
var lieu_t=$('#lieu_naissance_teacher').val();
var addr_t=$('#addr_teacher').val();
var entrer_t=$('#date_entrer_teacher').val();
var autre_ecole=$('#ecole_autre').val();
var date_nomer=$('#date_nomination').val();


                    $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax({ //debut du script d'envoir du formulaire enregistrement enseignent
			type:'POST',
			url:'/SControl/public/api/createPerson',
			data:{ 
				'code':code , 
				'nom_t':nom_t , 
				'prenom_t':prenom_t , 
				'tel_t':tel_t , 
				'diplome':diplome ,  
				'lieu_t':lieu_t , 
				'addr_t':addr_t , 
				'cours':cours_t , 
				'autre_ecole':autre_ecole , 
				'naissance_t':naissance_t , 
				'entrer_t':entrer_t , 
				'date_nomer':date_nomer 
			},
			dataType:'json',
			success: function(data){



				if(data.accepte=='ko'){
				alert('Utilisateur dejas existant. Si vous voulez modifier des informations sur ce ensignent, veuillez proceder plutot a une mise a jours !');
			}

				if(data.accepte=='ok'){

					alert('Enregistrement effectuer avec succes.');
					alert('Mots de passe pour Mr. '+$('#nom_teacher').val()+' : '+data.pass);

					}
				}



		}); //fin script enregistrement enseignent

				}
				else{
					alert('Veuillez choisir le cours et la salle pour ce enseignent. Merci');
				}
			}
			else{
				alert('Entrer un numero de telephone correct');
			}

		}
		else{
			alert('Veuillez remplire tous le formulaire. Seul la date de nomination et autres ecole sont optionels !');
		}


	});


	//Enregistrer eleve

	$('#bt_save_eleve').click(function(){

		if(isFormGood('#nom')&&isFormGood('#prenom')&&isFormGood('#naissance')&&isFormGood('#date_cepd')&&isFormGood('#lieu_naissance')&&isFormGood('#date_entrer')&&
		isFormGood('#ecole_recent')&&isFormGood('#nom_pere')&&isFormGood('#nom_tuteur')&&isFormGood('#addr_tuteur')&&
		isFormGood('#nom_mere')){
			if(isGoodPhoneNum('#tel_tuteur')){

				if(document.getElementById('e6').checked==true){

					classe='6';
				}
				if(document.getElementById('e5').checked==true){

					classe='5';
				}
				if(document.getElementById('e4').checked==true){

					classe='4';
				}
				if(document.getElementById('e3').checked==true){

					classe='3';
				}

				if((document.getElementById('e6').checked==true)||(document.getElementById('e5').checked==true)||(document.getElementById('e4').checked==true)||(document.getElementById('e3').checked==true)){

					alert('good form ):');
						var code1='21314991667700';

//variable a envoyer pour enregistrement eleve
var nom_t=$('#nom').val();
var prenom_t=$('#prenom').val();
var tel_t=$('#tel_tuteur').val();
var d_diplome=$('#date_cepd').val();
var naissance_t=$('#naissance').val();
var lieu_t=$('#lieu_naissance').val();
var entrer_t=$('#date_entrer').val();
var autre_ecole=$('#ecole_recent').val();
var nom_pere=$('#nom_pere').val();
var nom_mere=$('#nom_mere').val();
var prof_pere=$('#prof_pere').val();
var prof_mere=$('#prof_mere').val();
var nom_tuteur=$('#nom_tuteur').val();
var addr_tuteur=$('#addr_tuteur').val();


                    $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});

					$.ajax({ //debut du script d'envoir du formulaire enregistrement eleve
			type:'POST',
			url:'/SControl/public/api/createPerson',
			data:{ 
				'code':code1 , 
				'nom_t':nom_t , 
				'prenom_t':prenom_t , 
				'classe':classe , 
				'tel_t':tel_t , 
				'd_diplome':d_diplome ,  
				'lieu_t':lieu_t , 
				'autre_ecole':autre_ecole , 
				'naissance_t':naissance_t , 
				'entrer_t':entrer_t , 
				'nom_pere':nom_pere ,  
				'nom_mere':nom_mere , 
				'prof_pere':prof_pere , 
				'prof_mere':prof_mere , 
				'nom_tuteur':nom_tuteur ,  
				'addr_tuteur':addr_tuteur  
			},
			dataType:'json',
			success: function(data){



				if(data.accepte=='ko'){
				alert('Eleve dejas existant. Si vous voulez modifier des informations sur ce eleve, veuillez proceder plutot a une mise a jours !');
			}

				if(data.accepte=='ok'){

					alert('Enregistrement effectuer avec succes.');
					}
				}



		}); //fin script enregistrement enseignent

				}
				else{
					alert('Veuillez choisir la salle pour cet eleve. Merci');
				}
			}
			else{
				alert('Entrer un numero de telephone correct');
			}

		}
		else{
			alert('Veuillez remplire tous le formulaire. Seul la profession du pere et de la mere sont optionels !');
		}


	});


	/*script for no dynamique box: nav bar and deconection button*/
	$('.nav_p:nth-child(1)').click(function(){

		if(modal!=3){
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/home_secre_refresh.blade.php');
		}
		
	});

	$('.nav_p:nth-child(2)').click(function(){

		if(modal!=3){
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/outils.blade.php');
		}
		
	});

	/*utilisateur click partous, juste fermer fenetre pop up ouvert*/

});

/*declaration de fonctions */

function isFormGood(form){
	if($(form).val()!=''){
		return true;
	}

	else{
		return false;
	}
}

function isItemInArray(item, array){
	for (var i = 0; i < array.length; i++) {
            if(array[i]==item){
				var testVar=1;
				i=array.length+1;
			}
			}
	if(testVar==1){
		return true;
	}
	else{
		return false;
	}
}

function isPresente(item, numSave, limit){
	if(numSave>limit){
		var i=numSave-1;
	if($(".i"+i).text()!=item){
		return true;
	}

	else{
		return false;
	}
	}

	else{
		return true;
	}
}

function isGoodPhoneNum(form){
	if(($(form).val()).length==8){
		return true;
	}
	else{
		return false;
	}
}
