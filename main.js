'use strict';
var url = '/eas/amado/mainpage/pb_API/registration.class.php';
var add = true;
var id = 0;


$(document).ready(function(e) {  
	$("#form_reg").submit(function(e) {
        e.preventDefault(); 
          register();  
          // $(location).attr('href', 'index.php');
    });

    $("#form_login").submit(function(e) {
      e.preventDefault(); 
        login();  
        $(location).attr('href', 'https://www.youtube.com/');
      // register();
  });

    // $("#submit_summary").submit(function(e) {
    //     e.preventDefault();  
    //     $('.hide_submit').hide(); 
    //     $('.show_submit').show(); 
		// loadOrderSummary();
    // });
});






function register() {   
  $.ajax({
      dataType: 'json',
      type:'POST',
      url: url,
      data:{
        type: 'insert',
          fname: $("#fname").val(),
          email: $("#email").val(),
          number: $("#number").val(),
          username: $("#username").val(),
          password: $("#password").val(), 
          user: $('#user').find('option:selected').val(),

      },
  }).done(function(result){
          alert(result.status);
          
   }); 
}

function login() {   
  $.ajax({
      dataType: 'json',
      type:'GET',
      url: url,
      data:{
        type: 'signin',
          lusername: $("#lusername").val(),
          lpassword: $("#lpassword").val(),
      },
  }).done(function(result){
          alert(result.status);
          
   }); 
}
