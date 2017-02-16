 $(document).ready(function () {
	 
	 $("table#ticket-table").dataTable({
			"aaSorting": [[4,'desc']]
	});
	 
	 $("table#withdraw-fund-table").dataTable({
			"aaSorting": [[1,'desc']],
			dom: 'Blfrtip',
	        buttons: [
				{
				    extend: 'excelHtml5',
				    text: 'Download Excel',
				    title: 'Withdraw Fund Requests',
				    exportOptions: {
	                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11, 12 ]
	                }
				},
	        ],
	        columnDefs: [ {
	            targets: [9, 10, 11, 12],
	            visible: false
	        } ],
	        /*aoColumns: [ 
	                       null, null, null, null, null, null, null, null, null, 
	                       { "bSearchable": false },
	                       { "bSearchable": false },
	                       { "bSearchable": false },
	                       { "bSearchable": false }
	                    ]*/
	});
	 
	 if($("#ticket-description").length > 0){
		 CKEDITOR.replace( 'ticket-description' ,{
		       toolbar :
		    		[
		 			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
		 			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
		 			{ name: 'colors', items : [ 'TextColor','BGColor' ] }
		 		],
		        uiColor : '#9AB8F3'
		    });
	 }
	 else if($("#page-description").length > 0){
		 CKEDITOR.replace( 'page-description' ,{
		       toolbar :
		    		[
		 			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
		 			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
		 			{ name: 'colors', items : [ 'TextColor','BGColor' ] }
		 		],
		        uiColor : '#9AB8F3'
		    });
	 }
	 else if($("#blog-description").length > 0){
		 CKEDITOR.replace( 'blog-description' ,{
		       toolbar :
		    		[
		 			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
		 			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
		 			{ name: 'colors', items : [ 'TextColor','BGColor' ] }
		 		],
		        uiColor : '#9AB8F3'
		    });
	 }
 });
 
 function deleteUser(userId){
	 var r = confirm("Are you sure that you want to delete this user?");
	 if (r == true) {
		window.location ='/admin/user/delete/'+userId;
	 }
	 return false;
 }
 
 function resetPassword(userId){
	 var r = confirm("Are you sure that you want to send reset password to this user?");
	 if (r == true) {
		window.location ='/admin/user/resetpassword/'+userId;
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
 
 function deletePage(pageId){
	 var r = confirm("Are you sure that you want to delete this page?");
	 if (r == true) {
		window.location ='/admin/page/delete/'+pageId;
	 }
	 return false;
 }
 
 
