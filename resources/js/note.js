// JavaScript Document
var classe_;
var saveNo; //Contient le nombre total d'enregistrement de note passee lorsque la selection de la classe est faite
var nbrName=0;
var ads=0;
let note=[];
let names=[];
let nicks=[];
//var typeNote;
//var typeNote = sessionStorage.getItem("notePrev");
//import{typeNote} from './secre_home.js'
$(function(){ 

	
	displayPass();
	
	$('#ads').click(function(){ //EN cliquant sur ajoute on ouvre la fenetre block et on liste le nom des eleves concerne
		//Pour trouver ces eleves on recupere dabort la valeur de la liste de selection du cours.

		if(ads==0){ //Verifier si il y a une feuille de saisi en cours

		//Verification de la classe selectionne
		  //Charger le cours selectionne
		  var cours = $('#classe').val();
		  var coursObject = $("option:selected");
		  let name=[];
		  nbrName=0;

		if(coursObject.parent()[0].id=="6eme"){ // SI la matiere choisie est celui de la classe de 6eme
			 name=getEleve("6");
		}
		
		if(coursObject.parent()[0].id=="5eme"){ // SI la matiere choisie est celui de la classe de 5eme
			 name=getEleve("5");
		}

		if(coursObject.parent()[0].id=="4eme"){ // SI la matiere choisie est celui de la classe de 4eme
			 name=getEleve("4");
		}

		if(coursObject.parent()[0].id=="3eme"){ // SI la matiere choisie est celui de la classe de 3eme
			 name=getEleve("3");
		}
	}
	else{
		alert("Fermer ou valider la feuille de saisie actuel dabort !"); //DesingAlert
	}
		
	});
	
	$( "#classe" ).change(function() {
		
		ads=0;
		nbrName=0;
		$("#selectTypeNote").html("");
		document.getElementById("enter_note").style.display="none";
		$('.eleveName').remove();
		$(".note").remove();
		displayPass();
	  });

	$('#close_button').click(function(){  //Evenement appuis sur close_button
		
		ads=0;
		nbrName=0;
		document.getElementById("enter_note").style.display="none";
		$('.eleveName').remove();
		//$(".note").remove(); the old note view
	});

	//SAUVEGARDE DES NOTES ENTRER
	$("#save_button").click(function(){

		var ch = checkNote();
		if(ch){
		var notes =getNote();
		sendNote(notes);
		}
		else{
			alert("*Verifier les notes. Une note doit etre superieur ou egale a zero et ne doit pas depasser 20. Remplissez egalement toutes les champs");
		}

	});
	
});


function displayPass(){ 
	
	var coursObject = $("option:selected");
	var nbr=typeNote;

	if(coursObject.parent()[0].id=="6eme"){ // SI la matiere choisie est celui de la classe de 6eme
		classe_=6;
   }
   
   if(coursObject.parent()[0].id=="5eme"){ // SI la matiere choisie est celui de la classe de 5eme
		classe_=5;
   }

   if(coursObject.parent()[0].id=="4eme"){ // SI la matiere choisie est celui de la classe de 4eme
		classe_=4;
   }

   if(coursObject.parent()[0].id=="3eme"){ // SI la matiere choisie est celui de la classe de 3eme
		classe_=3;
   }
	//alert(nbr)
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/get-passe-save', 
        data: {
            'classe': classe_,
			'cours':$("option:selected").val(),
			'type':nbr
        },
        dataType: 'json',
        success: function(data){
            if(data.answer=='Good'){
				var dec =data.nbr;  //if we have previous notes dec would be differente from 0, so we can customise the view
				saveNo= data.nbr+1;
				var decc=data.nbr;
				$("#ads").show();
				if(dec==0){
					alert('Aucune note enregistrer, Veuillez cliquer sur le signe (+) pour ajouter une note'); //DesignAlert
				}
				while(dec!=0){

					if(nbr==1){
						$("#old_note").append('<p class="note">Interro '+dec+'</p>');
						}
						if(nbr==2){
							$("#old_note").append('<p class="note">Devoir '+dec+'</p>');
							}
							if(nbr==3){
								$("#old_note").append('<p class="note">Compo '+dec+'</p>');
								}
								if(nbr==4){
									//$("#old_note").append('<p class="note">Interro '+dec+'</p>');
									}	
					dec--;
				}
				//Customisation de la feuille d'entrer
				if(nbr==1){
					$("#selectTypeNote").append('<p class="noteTitle">Notes Interrogation N0 '+(decc+1)+'</p>');
					}
					if(nbr==2){
						$("#selectTypeNote").append('<p class="noteTitle">Notes Devoir surveiller N0 '+(decc+1)+'</p>');
						}
						if(nbr==3){
							$("#selectTypeNote").append('<p class="noteTitle">Notes Composition N0 '+(decc+1)+'</p>');
							}
							if(nbr==4){
								//$("#selectTypeNote").append('<p class="noteTitle">Verification des notes '+dec+'</p>');
								}
		
			}
			else if(data.answer=='full'){
				var dec =data.nbr;
				$("#ads").hide();
				while(dec!=0){

					if(nbr==1){
						$("#old_note").append('<p class="note">Interro '+dec+'</p>');
						}
						if(nbr==2){
							$("#old_note").append('<p class="note">Devoir '+dec+'</p>');
							}
							if(nbr==3){
								$("#old_note").append('<p class="note">Compo '+dec+'</p>');
								}
								if(nbr==4){
									//$("#old_note").append('<p class="note">Interro '+dec+'</p>');
									}	
					dec--;
				}
				$("#old_note").append('<p class="note" style="color:red">Limite de note atteinte!</p>');
				alert('Limite enregistrement atteint. Veuillez effacer une note et reesayer.'); //DesignAlert
			}
			else if(data.answer=='empty'){
				alert('Aucune note entrer. Veuillez ajouter une note en cliquant sur (+)'); //DesignAlert
			}
			else{
				alert("Erreur interne du serveur. Veuillez contacter le developper SVP."); //DesingAlert
			}
        }});

}

function getEleve(classeValue){ //Fonction servant a lister la classe

	
      
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/listStudent', 
        data: {
            'classe': classeValue
        },
        dataType: 'json',
        success: function(data){
            if(data.answer=='Good'){
				ads=1;
				names=data.name;
				nicks=data.nick;
				listEleve(names, nicks);
				
			}

			else{
				alert('Echec de generation de la fiche de note. Verifier si les eleves de la classe de '+classe_+' eme '+ 'sont enregistrer'); //DesignAlert
			}
        }});

}

function listEleve(name, nick){
	//alert(name[0]); for debogage manuel
	document.getElementById("enter_note").style.display="block";
	$(".head").after("<div class=\"eleveName\"></div>"); //Element parent flexbox recevant la list nom eleve

	for(let i=0; i<name.length ;i++){

		$(".eleveName").append("<div class=\"note_line\"><div class=\"nameList\">"+name[i]+" "+nick[i]+" :</div><div><input type=\"number\" class=\"note_val name"+i+"\" name=\"note_val\" placeholder=\"00\" maxlength=\"5\" /></div></div>");
		nbrName++;
	}
	
}

function checkNote(){ //Verifier les notes  inserer
	

	var next =0;
	var ch=true;
	while(nbrName>=next){
		//alert(next);
		if(($(".name"+next).val()!='')&&($(".name"+next).val()!=null)){

			if((parseFloat($(".name"+next).val())>=0)&&(parseFloat($(".name"+next).val())<=20)){
				//alert(ch);
				//alert(parseFloat($(".name"+next).val()));
				
			}
			else{
				ch=false;
				//alert(ch);
				//alert(parseFloat($(".name"+next).val()));
			}

		
		}
		else{
			//alert("last else");
			if(next==nbrName){

			}
			else{
				//alert("alert in last else");
			ch=false;
			}
		}

		next++;
	}
	return ch;
}

function getNote(){

	var next =0;
	while(nbrName>=next){
		note[next]=$(".name"+next).val();
		next++;
	}
	return note;
}

function sendNote(noteVal){
	var nbr=typeNote;
    //alert(nbr);
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/sendNotes', 
        data: {
			'classe':classe_,
            'note': noteVal,
			'name':names,
			'nick':nicks,
			'cours':$("option:selected").val(),
			'type':nbr
        },
        dataType: 'json',
        success: function(data){
            if(data.answer=='Good'){
				alert("Notes "+saveNo+" enregistrer avec succes.Pour la classe de "+classe_+"eme"); //DesingAlert
				location.reload(); //Recharger la page et mettre a jour les variables du script
			}
			else{
				alert('Enregistrement echouer. Verifier si les eleves de la classe de '+classe_+' eme '+ 'sont enregistrer'); //DesignAlert
			}
        }});

}