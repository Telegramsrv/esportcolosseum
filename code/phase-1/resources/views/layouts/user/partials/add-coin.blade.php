<div id="addCoinModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'user.coins.update', 'method' => 'post', 'id' => 'amountForm']) !!}
	    <div class="modal-content">
	      	<h5 class="white-text center-align">Add Coins</h5>
	      	<div id="amountForm" class="modal-form-container">
	            <div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::text('coins', '', ['class' => 'validate input-field col s9 m9', 'id' => 'coins', 'name' => 'coins', 'maxlength' => 8]) !!}
	        			{!! Form::label('Coins', 'Coins', ['data-error' => '', 'id' => 'amountLabel']) !!}
	        			<span class="input-field col s3 m3" id="coinMoney">&nbsp;</span>
	        			<span class="input-field col s12 m12">{{ $options->coins_per_dollar }} coins = 1$</span>
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