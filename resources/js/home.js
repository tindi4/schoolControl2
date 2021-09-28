// JavaScript Document

$(function(){

	$('.item1').click(function(){

		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.item2').click(function(){

		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.item3').click(function(){

		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.item4').click(function(){

		$('#display_content').load('http://192.168.137.1/SControl/resources/views/enter_note.blade.php');
	});

	$('.nav_p:nth-child(1)').click(function(){

		$('#display_content').load('http://192.168.137.1/SControl/resources/views/home_refresh.blade.php');

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
