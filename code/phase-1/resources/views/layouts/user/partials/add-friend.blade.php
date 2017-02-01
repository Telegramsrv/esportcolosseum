<div id="addFriendModal" class="modal blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'user.member.search', 'method' => 'post', 'id' => 'searchForm']) !!}
	    <div class="modal-content">
	      	<h5 class="white-text center-align">Search Members</h5>
	      	<div id="searchForm" class="modal-form-container">
	            <div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::text('search', '', ['class' => 'validate input-field col s12 m12', 'id' => 'search', 'name' => 'search']) !!}
	        			{!! Form::label('Search', 'Gamer Name OR Email', ['data-error' => '', 'id' => 'searchLabel']) !!}
	        		</div>
	    		</div>
	            <div class="row">
	    			<a id="searchSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">SEARCH</a>
	    			<div class="progress">
	                	<div class="indeterminate"></div>
	                </div>
	    		</div>
	    		
	    		<div class="row searchResults">
					
				</div>
				
			
	      	</div>
	    </div>
    {!! Form::close() !!}
</div>