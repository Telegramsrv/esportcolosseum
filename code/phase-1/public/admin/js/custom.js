 $(document).ready(function () {
	 

 });
 
 function deleteUser(uid){
	 var r = confirm("Are you sure that you want to delete this user?");
	 if (r == true) {
		window.location ='/admin/user/delete/'+uid;
	 }
	 return false;
 }
 
 function resetPassword(uid){
	 var r = confirm("Are you sure that you want to send reset password link to this user?");
	 if (r == true) {
		window.location ='/admin/user/resetpassword/'+uid;
	 }
	 return false;
 }
 
 function deleteEscChallengeTemplate(challengeId){
	 var r = confirm("Are you sure that you want to delete this esc challenge template?");
	 if (r == true) {
		window.location ='/admin/esc-challenge-template/delete/'+challengeId;
	 }
	 return false;
 }
 
 function deleteBlog(blogId){
	 var r = confirm("Are you sure that you want to delete this blog?");
	 if (r == true) {
		window.location ='/admin/blog/delete/'+blogId;
	 }
	 return false;
 }
 
 function deleteGame(gameId){
	 var r = confirm("Are you sure that you want to delete this game?");
	 if (r == true) {
		window.location ='/admin/game/delete/'+gameId;
	 }
	 return false;
 }
 
 
 