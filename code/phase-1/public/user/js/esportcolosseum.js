$(document).ready(function(){
	$("#loginBtn").click(function(){
		var loginForm = $("#loginForm");
		var formData = loginForm.serialize();
//	    console.log(formData);
//	    return false;

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
});