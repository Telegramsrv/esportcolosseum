$(document).ready(function(){

	$(".signup-btn").on("click",function(data){
        $('#loginModal').closeModal();
        $('#forgotPasswordModal').closeModal();
        $('#signUpModal').openModal();

    });

    $(".login-btn").on("click",function(data){
        $('#signUpModal').closeModal();
        $('#forgotPasswordModal').closeModal();
        $('#loginModal').openModal();
    });

    $(".forgot-password-btn").on("click", function(data){
    	$('#signUpModal').closeModal();
        $('#loginModal').closeModal();
        $('#forgotPasswordModal').openModal();	
    });

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
	        	else if(errors.CaptchaCode != undefined && errors.CaptchaCode[0] != ""){
	        		$("#registerForm #captchaLabel").attr("data-error", errors.CaptchaCode[0]);
	        		$("#registerForm #captchaLabel").addClass("active");
	        		$("#registerForm #CaptchaCode").addClass("invalid");
	        		$("#registerForm #CaptchaCode").focus();	
	        	}
	        }
	    });
	});

	$("#retrievePasswordSubmit").click(function(){
		var forgotPasswordForm = $("#forgotPasswordForm");
		var formData = forgotPasswordForm.serialize();
		$.ajax({
	        url:'forgot-password',
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
	        },
	        error: function (data) {
	        	var errors = data.responseJSON;
	        	if(errors.email != undefined && errors.email[0] != ""){
	        		$("#forgotPasswordForm #emailLabel").attr("data-error", errors.email[0]);
	        		$("#forgotPasswordForm #emailLabel").addClass("active");
	        		$("#forgotPasswordForm #email").addClass("invalid");
	        		$("#forgotPasswordForm #email").focus();
	        	}
	        }
	    });
	});
	
});