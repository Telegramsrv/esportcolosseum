$(document).ready(function(){

	$('select').material_select();
	
	$("body").keypress(function(event) {
	    if (event.keyCode == 13) {
	        if($('#loginModal').is(':visible')){
	        	$("#loginSubmit").click();
	        }
	        else if($('#signUpModal').is(':visible')){
	        	$("#registerSubmit").click();	
	        }
	        else if($('#forgotPasswordModal').is(':visible')){
	        	$("#retrievePasswordSubmit").click();	
	        }
	    }
	});

	$(".signup-btn").on("click",function(data){
        $('#loginModal').closeModal();
        $('#forgotPasswordModal').closeModal();
        $('#signUpModal').openModal();
        $('#registerForm')[0].reset();

    });

    $(".login-btn").on("click",function(data){
        $('#signUpModal').closeModal();
        $('#forgotPasswordModal').closeModal();
        $('#loginModal').openModal();
        $('#loginForm')[0].reset();
    });

    $(".forgot-password-btn").on("click", function(data){
    	$('#signUpModal').closeModal();
        $('#loginModal').closeModal();
        $('#forgotPasswordModal').openModal();	
        $('#forgotPasswordForm')[0].reset();
    });

	$("#loginSubmit").click(function(){
		var loginForm = $("#loginForm");
		var formData = loginForm.serialize();
		var postUrl = loginForm.attr('action');
	    $.ajax({
	    	url:postUrl,
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
		var postUrl = registerForm.attr('action');
		$('#registerForm .error-label').attr('data-error', "");
	    $.ajax({
	        url:postUrl,
	        type:'POST',
	        data:formData,
	        success:function(data){
	        	if(data.success == true){
        			Materialize.toast(data.message, 4000,'',function(){
        				$('#signUpModal').closeModal();
            			$(".login-btn").click();
        			});
	        	}
	        },
	        error: function (data) {
	        	var errors = data.responseJSON;
	        	if(errors.first_name != undefined && errors.first_name[0] != ""){
	        		$("#registerForm #firstNameLabel").attr("data-error", errors.first_name[0]);
	        		$("#registerForm #firstNameLabel").addClass("active");
	        		$("#registerForm #first_name").addClass("invalid");
	        		$("#registerForm #first_name").focus();
	        	}
	        	else if(errors.last_name != undefined && errors.last_name[0] != ""){
	        		$("#registerForm #lastNameLabel").attr("data-error", errors.last_name[0]);
	        		$("#registerForm #lastNameLabel").addClass("active");
	        		$("#registerForm #last_name").addClass("invalid");
	        		$("#registerForm #last_name").focus();
	        	}
	        	else if(errors.gamer_name != undefined && errors.gamer_name[0] != ""){
	        		$("#registerForm #gamerNameLabel").attr("data-error", errors.gamer_name[0]);
	        		$("#registerForm #gamerNameLabel").addClass("active");
	        		$("#registerForm #gamer_name").addClass("invalid");
	        		$("#registerForm #gamer_name").focus();
	        	}
	        	else if(errors.email != undefined && errors.email[0] != ""){
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
		var postUrl = forgotPasswordForm.attr('action');
		$.ajax({
	        url:postUrl,
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

	$(".game-type").change(function(){
		var gameType = $(this).attr("value");
		if(gameType == "team"){
			$(".challenge-team-field").slideDown();
		}
		else{
			$(".challenge-team-field").slideUp();	
		}
		return false;
	});

	$("#createChallengeSubmit").click(function(){
		var createChallengeForm = $("#createChallengeForm");
		var formData = createChallengeForm.serialize();
		var postUrl = createChallengeForm.attr('action');

	    $.ajax({
	        url: postUrl,
	        type:'POST',
	        data:formData,
	        success:function(data){
	        	if(data.success == true){
	        		Materialize.toast(data.message, 4000,'',function(){
        				window.location = data.intended;
        			});
	        	}
	        },
	        error: function (data) {
	        	var errors = data.responseJSON;
	        	if(errors.coins != undefined && errors.coins[0] != ""){
	        		$("#coinsLabel").attr("data-error", errors.coins[0]);
	        		$("#coinsLabel").addClass("active");
	        		$("#coins").addClass("invalid");
	        		$("#coins").focus();
	        	}
	        	else if(errors.region_id != undefined && errors.region_id[0] != ""){
	        		$("#regionLabel").attr("data-error", errors.region_id[0]);
	        		$("#regionLabel").addClass("active");
	        		$("#region_id").addClass("invalid");
	        		$("#region_id").focus();
	        	}
	        	else if(errors.team_name != undefined && errors.team_name[0] != ""){
	        		$("#teamLabel").attr("data-error", errors.team_name[0]);
	        		$("#teamLabel").addClass("active");
	        		$("#team_name").addClass("invalid");
	        		$("#team_name").focus();
	        	}
	        	else if(errors.challenge_type != undefined && errors.challenge_type[0] != ""){
	        		$("#challengeTypeLabel").attr("data-error", errors.challenge_type[0]);
	        		$("#challengeTypeLabel").addClass("active");
	        		$("#challenge_type").addClass("invalid");
	        		$("#challenge_type").focus();
	        	}
	        }
	    });
	});
});