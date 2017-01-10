$(document).ready(function(){
	$("#loginSubmit").click(function(){
		var loginForm = $("#loginForm");
		var formData = loginForm.serialize();
	    $.ajax({
	        url:'login',
	        type:'POST',
	        data:formData,
	        success:function(data){
	            if(data.intended != undefined && data.intended != ""){
	            	window.location = data.intended;
	            }
	        },
	        error: function (data) {
	        	var errors = data.responseJSON;
	        	if(errors.email != undefined && errors.email[0] != ""){
	        		$("#emailLabel").attr("data-error", errors.email[0]);
	        		$("#emailLabel").addClass("active");
	        		$("#email").addClass("invalid");
	        		$("#email").focus();
	        	}
	        	else if(errors.password != undefined && errors.password[0] != ""){
	        		$("#passwordLabel").attr("data-error", errors.password[0]);
	        		$("#passwordLabel").addClass("active");
	        		$("#password").addClass("invalid");
	        		$("#password").focus();
	        	}
	        }
	    });
	});
	
	$("#registerSubmit").click(function(){
		var registerForm = $("#registerForm");
		var formData = registerForm.serialize();
	    $.ajax({
	        url:'register',
	        type:'POST',
	        data:formData,
	        success:function(data){
	        	if(data.success == true){
	        		if(data.intended != undefined && data.intended != ""){
	        			Materialize.toast(data.message, 4000,'',function(){
	        				window.location = data.intended;
	        			});
		            	
		            }
	        	}
	        	console.log(data); return false;
	        	
	        },
	        error: function (data) {
	        	var errors = data.responseJSON;
	        	if(errors.email != undefined && errors.email[0] != ""){
	        		$("#registerForm #emailLabel").attr("data-error", errors.email[0]);
	        		$("#registerForm #emailLabel").addClass("active");
	        		$("#registerForm #email").addClass("invalid");
	        		$("#registerForm #email").focus();
	        	}
	        	else if(errors.password != undefined && errors.password[0] != ""){
	        		$("#registerForm #passwordLabel").attr("data-error", errors.password[0]);
	        		$("#registerForm #passwordLabel").addClass("active");
	        		$("#registerForm #password").addClass("invalid");
	        		$("#registerForm #password").focus();
	        	}
	        }
	    });
	});
	
});