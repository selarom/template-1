		<div id="login-bg">
		    <div class="login-content">	
		        <h1>Login Panel</h1>
		        <div class="login-error"></div>
		        <?php
					echo form_open('login/validate_credentials');

					echo '<p class="username txtfield">' . form_input('username', 'Username') . '</p>';
					echo form_error('username');

					echo '<p class="password txtfield">' . form_password('password', 'Password') . '</p>';
					echo form_error('password');

					echo '<p class="submit">' . form_submit('validate_credentials', 'Login') . '</p>';
				?>
		   </div>   
		</div>
	</div>
</div>
    

   