$(document).ready(function(){
    var teams = [];

    if($("select.no-material-select").length == 0){
        $('select').material_select();    
    }

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
            else if($('.add-team-model').is(':visible')){
                $('#createTeamForm #createTeamSubmit').click();
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
		loginSubmit();
	});
	
	$("#registerSubmit").click(function(){
		registerSubmit();
	});

	$("#retrievePasswordSubmit").click(function(){
		retrievePasswordSubmit();
	});

    $("#createChallengeForm #createChallengeSubmit").click(function(){
        createChallenge();
    });

    $("#createTeamForm #createTeamSubmit").click(function(){
        creatTeam();
    });
    
	$("#amountForm #amountSubmit").click(function(){
		amountSubmit();
	});

	$("form#amountForm").submit(function(){
		amountSubmit();
		return false;
	});
	
	$("#searchForm #searchSubmit").click(function(){
		searchSubmit();
	});
	
	$("form#searchForm").submit(function(){
		searchSubmit();
		return false;
	});
	
	$(".add-coins-button").click(function(){
		$("#coins").val("");
	});

    $(".challengr-btn").click(function(){
        $('.esc-challenge-date-active').removeClass('esc-challenge-date-active');
        $(this).addClass('esc-challenge-date-active');
        return false;
    });

    $("ul.timing li").click(function(){
        $(".esc-challenge-time-active").removeClass('esc-challenge-time-active');
        $(this).addClass('esc-challenge-time-active');
        return false;
    });

    $("#createTeamForm #name").autocomplete({
        maxResults: 6,
        source: function( request, response ) {
            $.ajax({
                url: '/user/team/fetch-auto-complete-list',
                type: 'POST',
                data: {
                    'name': $('#createTeamForm #name').val(),
                    'challenge_id': $('#createTeamForm #challenge_id').val(),
                },
                success: function(data){
                    var teams = JSON.parse(data.response);
                    response( teams.slice(0, this.options.maxResults) );
                },
                error: function(data){
                    console.log("coming in error");
                }
            });
        },
        appendTo: $("#createTeamForm").parent(),
        select: function( event, ui ){

            console.log(ui);
            return false;
        }

    });
    
    $( "#search-friend").autocomplete({
        source: function( request, response ) {
   		 	$.ajax({
                url: '/user/member/fetch-auto-complete-list',
                type: 'GET',
                data: {
                    'name': $('#search-friend').val(),
                },
                success: function(data){
                    response( JSON.parse(data.response) );
                },
                error: function(data){
                   
                }
            });
        },
       appendTo: "#addFriendModal"
	});
    
    $("#coins").keyup(function(){
    	$.ajax({
        	url:'/user/coins/calculation',
            type:'GET',
            data:{'coins': $("#coins").val()},
            success:function(data){
            	$("#coinMoney").html(data.amount);
            },
            error: function (data) {
            	$("#coinMoney").html('');
            }
        });
    	
    	return false;
    });

    
});

var creatTeam = function(){
    var createTeamForm = $("#createTeamForm");
    var formData = createTeamForm.serialize();
    var postUrl = createTeamForm.attr('action');

    showLoader(createTeamForm, 'createTeamSubmit');
    $("#createTeamForm #createTeamSubmit").html("Processing...");

    $.ajax({
        url: postUrl,
        type:'POST',
        data:formData,
        success:function(data){
            if(data.success == true){
                $("#createTeamForm #createTeamSubmit").html("Redirecting...");
                window.location.reload();
            }
        },
        error: function (data) {
            $("#createTeamForm #createTeamSubmit").html("Submit");
            hideLoader(createTeamForm, 'createTeamSubmit', creatTeam);

            var errors = data.responseJSON;
            if(errors.name != undefined && errors.name[0] != ""){
                $("#createTeamForm #nameLabel").attr("data-error", errors.name[0]);
                $("#createTeamForm #nameLabel").addClass("active");
                $("#createTeamForm #name").addClass("invalid");
                $("#createTeamForm #name").focus();
            }
        }
    });
}

function addFriend(friendID){
	$.ajax({
    	url:'/user/friend/add',
        type:'GET',
        data:{'friendID': friendID},
        success:function(data){
        	$("#addFriend").html(data.html);
        },
        error: function (data) {
        }
    });
	return false;
}

function acceptFriend(friendID){
	$.ajax({
    	url:'/user/friend/accept',
        type:'GET',
        data:{'friendID': friendID},
        success:function(data){
        	$("#addFriend").html(data.html);
        	$("#rejectFriend").hide();
        },
        error: function (data) {
        }
    });
	return false;
}

function rejectFriend(friendID){
	/*$.ajax({
    	url:'/user/friend/accept',
        type:'GET',
        data:{'friendID': friendID},
        success:function(data){
        	$("#addFriend").html(data.html);
        	$("#rejectFriend").hide();
        },
        error: function (data) {
        }
    });*/
	return false;
}

var createChallenge = function(){
    var createChallengeForm = $("#createChallengeForm");
    var formData = createChallengeForm.serialize();
    var postUrl = createChallengeForm.attr('action');

    showLoader(createChallengeForm, 'createChallengeSubmit');
    $("#createChallengeForm #createChallengeSubmit").html("Processing...");

    $.ajax({
        url: postUrl,
        type:'POST',
        data:formData,
        success:function(data){
            if(data.success == true){
                $("#createChallengeForm #createChallengeSubmit").html("Redirecting...");
                window.location = data.intended;
            }
        },
        error: function (data) {
            $("#createChallengeForm #createChallengeSubmit").html("Create");
            hideLoader(createChallengeForm, 'createChallengeSubmit', createChallenge);

            var errors = data.responseJSON;
            if(errors.coins != undefined && errors.coins[0] != ""){
                $("#createChallengeForm #coinsLabel").attr("data-error", errors.coins[0]);
                $("#createChallengeForm #coinsLabel").addClass("active");
                $("#createChallengeForm #coins").addClass("invalid");
                $("#createChallengeForm #coins").focus();
            }
            else if(errors.region_id != undefined && errors.region_id[0] != ""){
                $("#createChallengeForm #regionLabel").attr("data-error", errors.region_id[0]);
                $("#createChallengeForm #regionLabel").addClass("active");
                $("#createChallengeForm #region_id").addClass("invalid");
                $("#createChallengeForm #region_id").focus();
            }
            else if(errors.challenge_sub_type != undefined && errors.challenge_sub_type[0] != ""){
                $("#createChallengeForm #challengeSubTypeLabel").attr("data-error", errors.challenge_sub_type[0]);
                $("#createChallengeForm #challengeSubTypeLabel").addClass("active");
                $("#createChallengeForm #challenge_sub_type").addClass("invalid");
                $("#createChallengeForm #challenge_sub_type").focus();
            }
        }
    });
}

//login submit
var loginSubmit = function () {
	var loginForm = $("#loginForm");
	var formData = loginForm.serialize();
	var postUrl = loginForm.attr('action');
	showLoader(loginForm, 'loginSubmit');
    $("#loginForm #loginSubmit").html("Processing...");
    $.ajax({
    	url:postUrl,
        type:'POST',
        data:formData,
        success:function(data){
            if(data.intended != undefined && data.intended != ""){
            	$("#loginForm #loginSubmit").html("Redirecting...");
            	window.location = data.intended;
            }
        },
        error: function (data) {
        	var errors = data.responseJSON;
        	$("#loginForm #loginSubmit").html("LOGIN");
        	hideLoader(loginForm, 'loginSubmit', loginSubmit);
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
}

var registerSubmit = function() {
	var registerForm = $("#registerForm");
	var formData = registerForm.serialize();
	var postUrl = registerForm.attr('action');
	$('#registerForm .error-label').attr('data-error', "");
	showLoader(registerForm, 'registerSubmit');
    $("#registerForm #registerSubmit").html("Processing...");
    $.ajax({
        url:postUrl,
        type:'POST',
        data:formData,
        success:function(data){
        	if(data.success == true){
        		$("#registerForm #registerSubmit").html("SIGN UP");
        		hideLoader(registerForm, 'registerSubmit');
                window.location = data.intended;
        	}
        },
        error: function (data) {
        	$("#registerForm #registerSubmit").html("SIGN UP");
        	hideLoader(registerForm, 'registerSubmit', registerSubmit);
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
}

var retrievePasswordSubmit = function () {
	var forgotPasswordForm = $("#forgotPasswordForm");
	var formData = forgotPasswordForm.serialize();
	var postUrl = forgotPasswordForm.attr('action');
	showLoader(forgotPasswordForm, 'retrievePasswordSubmit');
    $("#forgotPasswordForm #retrievePasswordSubmit").html("Processing...");
	$.ajax({
        url:postUrl,
        type:'POST',
        data:formData,
        success:function(data){
        	if(data.success == true){
        		if(data.intended != undefined && data.intended != ""){
        			Materialize.toast(data.message, 4000,'',function(){
        				$("#forgotPasswordForm #retrievePasswordSubmit").html("Redirecting...");
        				window.location = data.intended;
        			});
	            }
        	}
        },
        error: function (data) {
        	$("#forgotPasswordForm #retrievePasswordSubmit").html("Retrieve Password");
        	hideLoader(forgotPasswordForm, 'retrievePasswordSubmit', retrievePasswordSubmit);
        	var errors = data.responseJSON;
        	if(errors.email != undefined && errors.email[0] != ""){
        		$("#forgotPasswordForm #emailLabel").attr("data-error", errors.email[0]);
        		$("#forgotPasswordForm #emailLabel").addClass("active");
        		$("#forgotPasswordForm #email").addClass("invalid");
        		$("#forgotPasswordForm #email").focus();
        	}
        }
    });
}

//amount submit
var amountSubmit = function () {
	var amountForm = $("#amountForm");
	var formData = amountForm.serialize();
	var postUrl = amountForm.attr('action');
	
	showLoader(amountForm, 'amountSubmit');
    $("#amountForm #amountSubmit").html("Processing...");
    
    $.ajax({
    	url:postUrl,
        type:'POST',
        data:formData,
        success:function(data){
            if(data.intended != undefined && data.intended != ""){
            	$("#amountForm #amountSubmit").html("Redirecting...");
            	window.location = data.intended;
            }
        },
        error: function (data) {
        	var errors = data.responseJSON;
        	$("#amountForm #amountSubmit").html("ADD");
        	hideLoader(amountForm, 'amountSubmit', amountSubmit);
        	if(errors.coins != undefined && errors.coins[0] != ""){
        		$("#amountLabel").attr("data-error", errors.coins[0]);
        		$("#amountLabel").addClass("active");
        		$("#coins").addClass("invalid");
        		$("#coins").focus();
        	}
        }
    });
}

//Search submit
var searchSubmit = function () {
	$(".searchResults").html('');
	var searchForm = $("#searchForm");
	var formData = searchForm.serialize();
	var postUrl = searchForm.attr('action');
	
	showLoader(searchForm, 'searchSubmit');
    $("#searchForm #searchSubmit").html("Processing...");
    
    $.ajax({
    	url:postUrl,
        type:'POST',
        data:formData,
        success:function(data){
        	hideLoader(searchForm, 'searchSubmit', searchSubmit);
        	$("#searchForm #searchSubmit").html("SEARCH");
            $(".searchResults").html(data.html);
        },
        error: function (data) {
        	var errors = data.responseJSON;
        	$("#searchForm #searchSubmit").html("SEARCH");
        	hideLoader(searchForm, 'searchSubmit', searchSubmit);
        	if(errors.search != undefined && errors.search[0] != ""){
        		$("#searchLabel").attr("data-error", errors.search[0]);
        		$("#searchLabel").addClass("active");
        		$("#search").addClass("invalid");
        		$("#search").focus();
        	}
        }
    });
}
//show Loader on signup.login
function showLoader(_this, btnID) {
	if(btnID != undefined && btnID != "") {
		$(_this).find("#" + btnID).unbind("click");
		$(_this).find("#" + btnID).attr( "disabled", true );
	}
	$(_this).find(".progress").css("display", "block");
}

//hide Loader on signup.login
function hideLoader(_this, btnID, bindFunction) {
	if(btnID != undefined && btnID != "") {
		if(bindFunction != undefined && bindFunction != "" &&  jQuery.isFunction( bindFunction)) {
			$(_this).find("#" + btnID).bind("click", bindFunction);
		}
		
		$(_this).find("#" + btnID).attr( "disabled", false );
	}
	$(_this).find(".progress").css("display", "none");
}