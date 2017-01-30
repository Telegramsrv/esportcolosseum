<div id="addCoinModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'user.coins.update', 'method' => 'post', 'id' => 'amountForm']) !!}
	    <div class="modal-content">
	      	<h5 class="white-text center-align">Add Coins</h5>
	      	<div id="amountForm" class="modal-form-container">
	            <div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::email('amount', '', ['class' => 'validate', 'id' => 'amount', 'name' => 'amount']) !!}
	        			{!! Form::label('Amount', 'Amount', ['data-error' => '', 'id' => 'amountLabel']) !!}
	        		</div>
	    		</div>
	            <div class="row">
	    			<a id="amountSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">ADD</a>
	    			<div class="progress">
	                	<div class="indeterminate"></div>
	                </div>
	    		</div>
	      	</div>
	    </div>
    {!! Form::close() !!}
    <div class="modal-footer black"></div>
</div>