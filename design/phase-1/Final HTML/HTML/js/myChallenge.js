var teamData = {
		"RK troopers": null,
		"KV Wizards": null,
		"RP Riders": null,
		"Darky Killers": null,
		"Serious Players": null,
		"Anonymous Hackers": null
	};

$(function(){
	loadTeams(teamData);
});

function loadTeams(teamList)
{
	$('input#teamNameAutoComplete').autocomplete({
		data: teamList,
		limit: 6, // The max amount of results that can be shown at once. Default: Infinity.
		onComplete: function(selectedValue){
			if($('input#teamNameAutoComplete').val() in teamList)
			{
				loadSelectedTeam(selectedValue);
			}
		}
	});
	$('input#teamNameAutoComplete').on("input",function(){
		$("#teamPlayerList").hide();
	});
}


function loadSelectedTeam(teamName)
{
	//search db for selected team name and get players in the team
	$("#noTeamMessage").hide();
	$("#teamPlayerList").fadeIn(300);
}