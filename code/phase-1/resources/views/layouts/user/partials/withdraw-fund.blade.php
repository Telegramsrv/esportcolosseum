<div id="withdrawFundModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'user.withdraw-fund.update', 'method' => 'post', 'id' => 'withdrawFundForm']) !!}
	    <div class="modal-content">
	      	<h5 class="white-text center-align">Withdraw Fund</h5>
	      	<div id="withdrawFundForm" class="modal-form-container">
	            <div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::text('withdrawFund', '', ['class' => 'validate input-field col s9 m9', 'id' => 'withdrawFund', 'name' => 'withdrawFund', 'maxlength' => 8]) !!}
	        			{!! Form::label('Coins', 'Coins', ['data-error' => '', 'id' => 'withdrawFundLabel']) !!}
	        			<span class="input-field col s3 m3" id="withdrawFundMoney">&nbsp;</span>
	        			<span class="input-field col s12 m12">* {{ $options->coins_per_dollar }} coins = 1$</span>
	        			<span class="input-field col s12 m12">* ESC service charge = {{ $options->service_charge }}%</span>
	        		</div>
	    		</div>
	            <div class="row">
	    			<a id="withdrawFundSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">WITHDRAW</a>
	    			<div class="progress">
	                	<div class="indeterminate"></div>
	                </div>
	    		</div>
	      	</div>
	    </div>
    {!! Form::close() !!}
</div>