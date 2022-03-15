// JavaScript Document
var savedNote; //Interro, devoir, compo
var noteRange;
var lister=0;
var changedNote;
var eleveId;
var classe_;
var eleveNum;
var Time;
$(function(){
	
	//$('#ads').hide();
	//alert("list Note");
	//Initialisation
	document.getElementById("noteList").style.display="none";
		$('.eleveName').remove();
		$('.note_line').remove();
		savedNote=0;

	//Chargement de la select matiere se fait avec les variable de session au debut de list_note>blade
	
	//Charger maintenant les notes enregistrer
	displayPass();

	$(document).on('click', '.note', function(){ //EN cliquant sur ajoute on ouvre la fenetre block et on liste le nom des eleves concerne
		//Pour trouver ces eleves on recupere dabort la valeur de la liste de selection du cours.
        //alert('test');
		if(lister==0){ //Verifier si il y a une feuille de saisi en cours 

		//Verification de la classe selectionne
		  //Charger le cours selectionne
		  var cours = $('#classe').val();
		  var coursObject = $("option:selected");
		  let name=[];
		  nbrName=0;
		  //recuperer le range de note choisie

		  var classe = $(this).text(); //recuperer le rang de type de note cliquer
		  var range =  classe.match(/(\d+)/);  //recuperer le nombre numerique contenu dans la classe
		  noteRange = range[0];
		  //alert(noteRange);

		  //initialisation importante
		  document.getElementById("noteList").style.display="none";
		  $('.eleveName').remove();
		  $('.note_line').remove();
		  $("#selectTypeNote").html("");

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

		if(savedNote==1){
			$("#selectTypeNote").append('<p class="noteTitle">Notes Interrogation N0 '+(noteRange)+'</p>');
			}
			if(savedNote==2){
				$("#selectTypeNote").append('<p class="noteTitle">Notes Devoir surveiller N0 '+(noteRange)+'</p>');
				}
				if(savedNote==3){
					$("#selectTypeNote").append('<p class="noteTitle">Notes Composition N0 '+(noteRange)+'</p>');
					}
					if(savedNote==4){
						//$("#selectTypeNote").append('<p class="noteTitle">Verification des notes '+dec+'</p>');
						}

	}
	else{
		alert("Fermer ou valider la feuille de saisie actuel dabort !"); //DesingAlert
	}
		
	});

	$( "#classe" ).change(function() {
		
		document.getElementById("noteList").style.display="none";
		$('.eleveName').remove();
		$(".note").remove();
		//alert("ddd");
		displayPass();
	  });

	$("#interro").change(function(){
		//alert("change radio")
		$('.eleveName').remove();
		$(".note").remove();
		document.getElementById("noteList").style.display="none";
		savedNote=1;
		displayPass();
	});
	
	$("#devoir").change(function(){
		//alert("change radio")
		$('.eleveName').remove();
		$(".note").remove();
		document.getElementById("noteList").style.display="none";
		savedNote=2;
		displayPass();
	});

	$("#compo").change(function(){
		//alert("change radio")
		$('.eleveName').remove();
		$(".note").remove();
		document.getElementById("noteList").style.display="none";
		savedNote=3;
		displayPass();
	});

	$('#close_button').click(function(){  //Evenement appuis sur close_button
		
		document.getElementById("noteList").style.display="none";
		$('.eleveName').remove();
		$('.note_line').remove();
		//$(".note").remove(); the old note view
	});

	$(document).on('mouseenter', '.noInput',function(event){

		var classe = $(this).attr('class'); //recuperer le nom de la class
		var range =  classe.match(/(\d+)/);  //recuperer le nombre numerique contenue dans le nom de classe pour identifier l'eleve
		eleveNum = range[0]; //recuperation effective
		top = event.pageX;
		left= event.pageY;
		//alert(event.pageX);
		//hoverOnNoteList(eleveId, event.pageX, event.pageY);
		changedNote=this;
		clearTimeout(Time);
		$(this).css({
			border:"2px solid red",
			'background-color':"white"
		});

		$("#alertChangeNote").css({
			position:"absolute",
			top:event.pageY,
			left:event.pageX,
			border:"1px solid white",
			'background-color':"white",
			'color':"blue",
			'box-shadow': "1px 1px 9px 1px",
			display:"block"
		});		
		});

		$(document).on('mouseleave', '.noInput', function(){
			//first initialised the hovered note
			$(changedNote).css({
				display: "inline-block",
				width: "60px",
				border: "2px solid rgba(89, 89, 248, 0.39)",
				'border-radius': "5px",
				'background-color':"rgba(89, 89, 248, 0.39)"
			});
			Time=setTimeout(function(){ leavingNote(); }, 600);
		
			});

			//if user go on chngeAlert panel
			$(document).on('mouseenter','#alertChangeNote', function(event){
				clearTimeout(Time);
				$(changedNote).css({
					border:"2px solid red",
					'background-color':"white"
				});
				

			});


			$(document).on('mouseleave', '#alertChangeNote', function(event){
				$("#alertChangeNote").hide();
				
				$(changedNote).css({
					display: "inline-block",
	                width: "60px",
	                border: "2px solid rgba(89, 89, 248, 0.39)",
	                'border-radius': "5px",
					'background-color':"rgba(89, 89, 248, 0.39)"
				});
		
			});

			$("#changeNoteBt").click(function(){
				//alert("enter change note click")
				if(changeNote()){//If true, note is correct
					changeTheModifiedNote();
				}
			});

	

});


function displayPass(){ 
	
	var coursObject = $("option:selected");
	var nbr=savedNote;

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
				//$("#ads").show();
				if(dec==0){
					alert('Aucune note enregistrer, Rendez vous dans le menu Acceuil pour ajouter une note'); //DesignAlert
				}
				while(dec!=0){ //alert(dec);

					if(nbr==1){
						$("#old_note").append('<p class="note '+dec+'">Interro '+dec+'</p>');
						}
						if(nbr==2){
							$("#old_note").append('<p class="note '+dec+'">Devoir '+dec+'</p>');
							}
							if(nbr==3){
								$("#old_note").append('<p class="note '+dec+'">Compo '+dec+'</p>');
								}
								if(nbr==4){
									//$("#old_note").append('<p class="note">Interro '+dec+'</p>');
									}	
					dec--;
				}
				
			}
			else if(data.answer=='full'){
				var dec =data.nbr;
				//$("#ads").hide();
				while(dec!=0){

					if(nbr==1){
						$("#old_note").append('<p class="note '+dec+'">Interro '+dec+'</p>');
						}
						if(nbr==2){
							$("#old_note").append('<p class="note '+dec+'">Devoir '+dec+'</p>');
							}
							if(nbr==3){
								$("#old_note").append('<p class="note '+dec+'">Compo '+dec+'</p>');
								}
								if(nbr==4){
									//$("#old_note").append('<p class="note">Interro '+dec+'</p>');
									}	
					dec--;
				}

				$("#old_note").append('<p class="note" style="color:red">Limite de note atteinte!</p>');
				alert('Vous avez atteint la limite d\'enregistrement disponible.Vous pouvez effacer une fiche de note pour enregistrer une nouvelle.'); //DesignAlert
			}
			else if(data.answer=='empty'){
				alert('Aucune note enregistrer, Rendez vous dans le menu Acceuil pour ajouter une note'); //DesignAlert
			}
			else{
				alert("Erreur interne du serveur. Veuillez contacter le developper SVP."); //DesingAlert
			}
        }});

}

function getEleve(classeValue){ //Fonction servant a lister la classe et les note enregistrers

	
      
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/listStudent-and-note', 
        data: {
            'classe': classeValue,
			'type':savedNote,
			'range':noteRange,
			'cours':$("option:selected").val()
        },
        dataType: 'json',
        success: function(data){
            if(data.answer=='Good'){
				ads=1;
				names=data.nom;
				nicks=data.nick;
				notes=data.note;
				eleveId=data.id;
				listEleve(names, nicks, notes);
				
			}

			else{
				alert('Echec de generation de la fiche de note. Verifier si les eleves de la classe de '+classe_+' eme '+ 'sont enregistrer'); //DesignAlert
			}
        }});

}

function changeTheModifiedNote(){
	newNote = $(".note_val").val();

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/changeNotes', 
        data: {
            'eleveId': eleveId[eleveNum],
			'newNote':$(".note_val").val(),
			'typeNote':savedNote,
			'classe':classe_,
			'range':noteRange,
			'cours':$("option:selected").val()
        },
        dataType: 'json',
        success: function(data){
            if(data.answer=='Good'){
				alert('La note de '+nicks[eleveNum]+' '+names[eleveNum]+' a ete mise a jours avec succes.'); //DesignAlert
				$(changedNote).html(newNote);
				$(".note_val").val('');
	
			}

			else{
				alert('Echec de mise a jours de la note de '+nicks[eleveNum]+' '+names[eleveNum]+'. Ressayer SVP.'); //DesignAlert
			}
        }});

}

function listEleve(name, nick, notes){
	//alert(name[0]); for debogage manuel
	document.getElementById("noteList").style.display="block";
	$(".head").after("<div class=\"eleveName\"></div>"); //Element parent flexbox recevant la list nom eleve

	for(let i=0; i<name.length ;i++){

		//alert(notes[i]);
		$(".eleveName").append("<div class=\"note_line\"><div class=\"nameList\">"+name[i]+" "+nick[i]+" :</div><div><span class=\"note_val noInput name"+i+"\">"+notes[i]+"</span/></div></div>");
		nbrName++;
	}
	
}



function leavingNote(){
	$("#alertChangeNote").hide();
	//reinitialised the notelist style
	$(changedNote).css({
		display: "inline-block",
		width: "60px",
		border: "2px solid rgba(89, 89, 248, 0.39)",
		'border-radius': "5px",
		'background-color':"rgba(89, 89, 248, 0.39)"
	});

}

function changeNote(){

	ch=false;
	if(($(".note_val").val()!='')&&($(".note_val").val()!=null)){

		if((parseFloat($(".note_val").val())>=0)&&(parseFloat($(".note_val").val())<=20)){
			//alert(ch);
			//alert(parseFloat($(".name"+next).val()));
			ch=true;
		}
	}
	//alert(ch);
	return ch;
}