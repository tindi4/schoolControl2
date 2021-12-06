// JavaScript Document
var classe_;
var nbrName=0;
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

		//Verification de la classe selectionne
		  //Charger le cours selectionne
		  var cours = $('#classe').val();
		  var coursObject = $("option:selected");
		  let name=[];

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

		
	});
	
	$( "#classe" ).change(function() {
		
		$("#selectTypeNote").html("");
		$(".note").remove();
		displayPass();
	  });

	$('#close_button').click(function(){  //Evenement appuis sur close_button
		
		document.getElementById("enter_note").style.display="none";
		$('.eleveName').remove();
	});


	//SAUVEGARDE DES NOTES ENTRER
	$("#save_button").click(function(){

		var notes =getNote();
		sendNote(notes);

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
				var dec = data.nbr;  //if we have previous notes dec would be differente from 0, so we can customise the view
				var decc=data.nbr;
				while(dec!=0){
					$("#old_note").append('<p class="note">Interro '+dec+'</p>');
					
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
			else{
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
				names=data.name;
				nicks=data.nick;
				listEleve(names, nicks);
				
			}
			else{
				alert('No eleve maybe : iam at note.js ligne 59');
			}
        }});

}

function listEleve(name, nick){
	//alert(name[0]); for debogage manuel
	document.getElementById("enter_note").style.display="block";
	$(".head").after("<div class=\"eleveName\"></div>"); //Element parent flexbox recevant la list nom eleve

	for(let i=0; i<name.length ;i++){

		$(".eleveName").append("<div class=\"note_line\"><div class=\"nameList\">"+name[i]+" "+nick[i]+" :</div><div><input type=\"text\" class=\"note_val name"+i+"\" name=\"note_val\" placeholder=\"00\" maxlength=\"5\" /></div></div>");
		nbrName++;
	}
	
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

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/sendNotes', 
        data: {
            'note': noteVal,
			'name':names,
			'nick':nicks,
			'cours':$("option:selected").val(),
			'type':nbr
        },
        dataType: 'json',
        success: function(data){
            if(data.answer=='Good'){
				alert("goog")
			}
			else{
				alert('No eleve maybe : iam at note.js ligne 59');
			}
        }});

}