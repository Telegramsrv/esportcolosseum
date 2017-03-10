<div id="loginModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'login', 'method' => 'post', 'id' => 'loginForm']) !!}
		<div class="modal-content">
			<h5 class="white-text center-align">Login</h5>
			<div id="loginForm" class="modal-form-container">
	    		<div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::email('email', '', ['class' => 'validate', 'id' => 'email', 'name' => 'email']) !!}
	        			{!! Form::label('email', 'Email', ['data-error' => '', 'id' => 'emailLabel']) !!}
	        		</div>
	    		</div>
	    		<div class="row">
	        		<div class="input-field col s12 m12">
	        			{!! Form::password('password', ['class' => 'validate', 'id' => 'password', 'name' => 'password']) !!}
	        			{!! Form::label('password', 'Password', ['data-error' => '', 'id' => 'passwordLabel']) !!}
	        		</div>
	    		</div>
	    		<div class="row">
	    			<a id="loginSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Login</a>
	    			<div class="progress deep-orange lighten-5">
	                	<div class="indeterminate deep-orange darken-4"></div>
	                </div>
				                
	    		</div>
			</div>
		</div>
		<div class="modal-footer black">
			<a href="javascript:void(0);" class="btn-flat white-text forgot-password-btn">Forgot password?</a>
			<a href="javascript:void(0);" class="btn-flat white-text signup-btn">Signup ></a>
		</div>
	{!! Form::close() !!}
</div>