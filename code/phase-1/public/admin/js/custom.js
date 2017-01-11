 $(document).ready(function () {
	 

 });
 
 function deleteUser(uid){
	 var r = confirm("Are you sure that you want to delete this user?");
	 if (r == true) {
		window.location ='/admin/user/delete/'+uid;
	 }
	 return false;
 }