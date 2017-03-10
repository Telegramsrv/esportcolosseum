<div id="forgotPasswordModal" class="modal modal-fixed-footer blue-grey darken-4 modal-form">
	{!! Form::open(['route' => 'forgot-password', 'method' => 'post', 'id' => 'forgotPasswordForm']) !!}
		<div class="modal-content">
			<h5 class="white-text center-align">Forgot Password</h5>
			<div class="modal-form-container">
        		<div class="row">
            		<div class="input-field col s12 m12">
            			{!! Form::email('email', '', ['class' => 'validate', 'id' => 'email', 'name' => 'email']) !!}
            			{!! Form::label('email', 'Email', ['data-error' => '', 'id' => 'emailLabel']) !!}
            		</div>
        		</div>
        		<div class="row">
        			<a id="retrievePasswordSubmit" class="waves-effect waves-light btn-large btn-full deep-orange darken-4">Retrieve Password</a>
        			<div class="progress">
	                	<div class="indeterminate"></div>
	                </div>
        		</div>
        		<div class="row success-message"></div>
			</div>
		</div>
		<div class="modal-footer black">
			<a href="javascript:void(0);" class="btn-flat white-text login-btn">Login ></a>
		</div>
	{!! Form::close() !!}
</div>