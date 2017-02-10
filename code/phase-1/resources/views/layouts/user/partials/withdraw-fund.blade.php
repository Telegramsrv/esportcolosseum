<div id="withdrawFundModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'user.coins.update', 'method' => 'post', 'id' => 'withdrawFundForm']) !!}
	    <div class="modal-content">
	      	<h5 class="white-text center-align">Withdraw Fund</h5>
	      	<div id="withdrawFundForm" class="modal-form-container">
	            <div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::text('withdraw-fund', '', ['class' => 'validate input-field col s9 m9', 'id' => 'withdraw-fund', 'name' => 'withdraw-fund', 'maxlength' => 8]) !!}
	        			{!! Form::label('Coins', 'Coins', ['data-error' => '', 'id' => 'withdrawFundLabel']) !!}
	        			<span class="input-field col s3 m3" id="coinMoney">&nbsp;</span>
	        			<span class="input-field col s12 m12">{{ $options->service_charge }} coins = 1$</span>
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
</div>