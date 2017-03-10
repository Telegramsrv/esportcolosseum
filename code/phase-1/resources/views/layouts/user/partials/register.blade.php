<div id="signUpModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'register', 'method' => 'post', 'id' => 'registerForm']) !!}
		<div class="modal-content">
			<h5 class="white-text center-align">Signup</h5>
			<div id="signupForm" class="modal-form-container">
				<div class="row">
	                <div class="input-field col s6 m6">
	                    {!! Form::email('first_name', '', ['class' => 'validate', 'id' => 'first_name', 'name' => 'first_name']) !!}
	        			{!! Form::label('first_name', 'First Name', ['data-error' => '', 'id' => 'firstNameLabel', 'class' => 'error-label']) !!}
	                </div>
	                <div class="input-field col s6 m6">
	                    {!! Form::email('last_name', '', ['class' => 'validate', 'id' => 'last_name', 'name' => 'last_name']) !!}
	        			{!! Form::label('last_name', 'Last Name', ['data-error' => '', 'id' => 'lastNameLabel', 'class' => 'error-label']) !!}
	                </div>
	            </div>
	            <div class="row">
	                <div class="input-field col s12 m12">
	                    {!! Form::email('gamer_name', '', ['class' => 'validate', 'id' => 'gamer_name', 'name' => 'gamer_name']) !!}
	        			{!! Form::label('gamer_name', 'Gamer Name', ['data-error' => '', 'id' => 'gamerNameLabel', 'class' => 'error-label']) !!}
	                </div>
	            </div>
	            <div class="row">
	                <div class="input-field col s12 m12">
	                    {!! Form::email('email', '', ['class' => 'validate', 'id' => 'email', 'name' => 'email']) !!}
	        			{!! Form::label('email', 'Email', ['data-error' => '', 'id' => 'emailLabel', 'class' => 'error-label']) !!}
	                </div>
	            </div>
	            <div class="row">
	                <div class="input-field col s6 m6">
	                    {!! Form::password('password', ['class' => 'validate', 'id' => 'password', 'name' => 'password']) !!}
	        			{!! Form::label('password', 'Password', ['data-error' => '', 'id' => 'passwordLabel', 'class' => 'error-label']) !!}
	                </div>
	                <div class="input-field col s6 m6">
	                	{!! Form::password('password', ['class' => 'validate', 'id' => 'password_confirmation', 'name' => 'password_confirmation']) !!}
	                	{!! Form::label('password_confirmation', 'Confirm Password', ['data-error' => '']) !!}
	                </div>
	            </div>

	            <div class="row">
	                <div class="input-field col s12 m12">
	                    <div class="g-recaptcha" data-sitekey="6Le99BcUAAAAAGjiK0KGbzS2JYEMHoVVqbYlaysN"></div>
	                </div>
	            </div>

	            <div class="row">
	                <a id="registerSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Sign Up</a>
	                <div class="progress deep-orange lighten-5">
	                	<div class="indeterminate deep-orange darken-4"></div>
	                </div>
	            </div>
			</div>
		</div>
		<div class="modal-footer black">
			<a href="javascript:void(0);" class="btn-flat white-text forgot-password-btn">Forgot password?</a>
			<a href="javascript:void(0);" class="btn-flat white-text login-btn">Login ></a>
		</div>
	{!! Form::close() !!}	
</div>