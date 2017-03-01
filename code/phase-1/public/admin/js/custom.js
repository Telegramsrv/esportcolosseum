 $(document).ready(function () {
	 
	 $("table#ticket-table").dataTable({
			"aaSorting": [[4,'desc']]
	});
	 
	
	 if($("table#match-table").length > 0){
		 $('#dateStart, #dateEnd').datepicker({
			 autoclose: true,
			 todayHighlight: true,
			 format:"yyyy-mm-dd",
			 toggleActive: true
		 });
		 /* Custom filtering function which will search data in column four between two values */
		 $.fn.dataTable.ext.search.push(
		     function( settings, data, dataIndex ) {
		         var min = parseInt( $('#minCoin').val(), 10 );
		         var max = parseInt( $('#maxCoin').val(), 10 );
		         var coin = parseFloat( data[8] ) || 0; // use data for the age column
		  
		         if ( ( isNaN( min ) && isNaN( max ) ) ||
		              ( isNaN( min ) && coin <= max ) ||
		              ( min <= coin   && isNaN( max ) ) ||
		              ( min <= coin   && coin <= max ) )
		         {
		             return true;
		         }
		         return false;
	    	}
		 );
		 
		 $.fn.dataTable.ext.search.push(
		     function( settings, data, dataIndex ) {
		    	 	var dateStart = parseDateValue($("#dateStart").val());
					var dateEnd = parseDateValue($("#dateEnd").val());
					// aData represents the table structure as an array of columns, so the script access the date value 
					// in the first column of the table via aData[0]
					var evalDate= parseDateValue(data[4].split(" ")[0]);
					
					if ( dateStart == "" && dateEnd == "" )
                    {
                        return true;
                    }
                    else if ( dateStart == "" && evalDate <= dateEnd )
                    {
                        return true;
                    }
                    else if ( dateStart <= evalDate && "" == dateEnd )
                    {
                        return true;
                    }
                    else if ( dateStart <= evalDate && evalDate <= dateEnd )
                    {
                        return true;
                    }
                                         
                    return false;
	    	}
		 );
		 
		// Function for converting a mm/dd/yyyy date value into a numeric string for comparison (example 08/12/2010 becomes 20100812
		 function parseDateValue(rawDate) {
			var parsedDate = '';
			if(rawDate != ''){
				var dateArray= rawDate.split("-");
			 	if(dateArray.length > 0){
			 		//parsedDate= dateArray[2] + dateArray[0] + dateArray[1];
			 		parsedDate = dateArray[0] + dateArray[1] + dateArray[2];
			 	}
			}
		 	return parsedDate;
		 }

		 
	 	// Event listener to the two range filtering inputs to redraw on input
		var matchTable = $('table#match-table').DataTable();
	    $('#minCoin, #maxCoin').keyup( function() {
	    	matchTable.draw();
	    } );
	    
		 // Add event listeners to the two range filtering inputs
	      $('#dateStart').change( function() { matchTable.draw(); } );
	      $('#dateEnd').change( function() { matchTable.draw(); } );
	    
	 }
	    
	 
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
 
 
