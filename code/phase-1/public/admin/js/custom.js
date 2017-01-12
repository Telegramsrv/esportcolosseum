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