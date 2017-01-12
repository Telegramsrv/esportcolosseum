<div id="signUpModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'login', 'method' => 'post', 'id' => 'registerForm']) !!}
		<div class="modal-content">
			<h5 class="white-text center-align">Signup</h5>
			<div id="signupForm" class="modal-form-container">
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
	                <div class="input-field col s12 m12">
	                	{!! Form::password('password', ['class' => 'validate', 'id' => 'password_confirmation', 'name' => 'password_confirmation']) !!}
	                	{!! Form::label('password_confirmation', 'Confirm Password', ['data-error' => '']) !!}
	                </div>
	            </div>
	            <div class="row">
	                <div class="input-field col s12 m12">
	                	
	                	{!! Form::text('CaptchaCode', '', ['class' => 'validate', 'id' => 'CaptchaCode', 'name' => 'CaptchaCode']) !!}
	            		{!! Form::label('captcha_code', '', ['data-error' => '', 'id' => 'captchaLabel']) !!}
	            		{!! captcha_image_html('ContactCaptcha') !!}
	            	</div>
	            </div>		
	            <div class="row">
	                <a id="registerSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Sign Up</a>
	            </div>
			</div>
		</div>
		<div class="modal-footer black">
			<a href="javascript:void(0);" class="btn-flat white-text forgot-password-btn">Forgot password?</a>
			<a href="javascript:void(0);" class="btn-flat white-text login-btn">Login ></a>
		</div>
	{!! Form::close() !!}	
</div>