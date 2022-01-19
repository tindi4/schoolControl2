// JavaScript Document
var typeNote;
$(function(){

	$('.item1').click(function(){

		typeNote=1;
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.item2').click(function(){
		typeNote=2;
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.item3').click(function(){
		typeNote=3;
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.item4').click(function(){
		typeNote=4;
		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.nav_p:nth-child(1)').click(function(){

		//$('#display_content').load('http://192.168.137.1/SControl/resources/views/home_refresh.blade.php');
		location.reload();


	});

	$('.nav_p:nth-child(2)').click(function(){

		$('#display_content').load('http://192.168.137.1/SControl/resources/views/liste_note.blade.php');

	});

	//Click sur un element du bar droit de navigation
	$('.nav_p').click(function(){

		$('.nav_p').css('background-color', "");
		$(this).css('background-color', 'lightgrey');

	});

});
