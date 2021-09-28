$(function () {

    $('#valide_form').click(function () {
        alert("k");
         phone = $('#id_name').val();
         password = $('#id_password').val();
        login(phone, password);
        //alert("k");
    });

});


//Divers fonction

function login(phone, password){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',  
        url: '/SControl/public/loginInterface/check_login', 
        data: {
            'phone': phone,
            'password': password
        },
        dataType: 'json',
        success: function(data){
            alert(data.answer);
            if(data.answer==='Bad'){
                document.getElementById("Lerror").style.display="block";
            }
            if(data.answer==='Good'){
                window.location.href= "http://192.168.137.1/SControl/public/loginInterface/"+data.idL;
            }
        }});

}
