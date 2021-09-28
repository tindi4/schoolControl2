// JavaScript Document

$(function(){
	
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
	
	$('#close_button').click(function(){  //Evenement appuis sur close_button
		
		document.getElementById("enter_note").style.display="none";
		$('.eleveName').remove();
	});
	
});

function getEleve(classeValue){ //Fonction servant a lister la classe

	let name=[];
      
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
				name=data.name;
				listEleve(name);
				
			}
			else{
				alert('No eleve maybe : iam at note.js ligne 59');
			}
        }});

}

function listEleve(name){
	alert(name[0]);
	document.getElementById("enter_note").style.display="block";
	$(".head").after("<div class=\"eleveName\"></div>"); //Element parent flexbox recevant la list nom eleve

	for(let i=0; i<name.length ;i++){

		$(".eleveName").append("<div class=\"note_line\"><div class=\"nameList\">"+name[i]+" :</div><div><input type=\"text\" class=\"note_val\" name=\"note_val\" placeholder=\"00\" maxlength=\"5\" /></div></div>");

	}
}