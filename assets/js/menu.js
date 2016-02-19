$(document).ready(function(){
		$.post(
			'/planit/auth/check_login_status/',
		  	function(response){
				if(response){
					document.getElementById("login-out").href="/planit/auth/logout/";	
					document.getElementById("login-out").innerHTML="<span class='glyphicon glyphicon-log-out'></span> Logout";
				} else {
					document.getElementById("login-out").href="/planit/auth/login/";
                                        document.getElementById("login-out").innerHTML="<span class='glyphicon glyphicon-log-in'></span> Login";
				}
			}
		);

$(function(){

$('#slide-submenu').on('click',function() {			        
        $(this).closest('.list-group').fadeOut('slide',function(){
        	$('.mini-submenu').fadeIn();	
        });
});

$('.mini-submenu').on('click',function(){		
        $(this).next('.list-group').toggle('slide');
 	       $('.mini-submenu').hide();
	});
});

});

