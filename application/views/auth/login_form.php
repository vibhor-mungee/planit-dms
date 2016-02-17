<div class="container">
	<div class="panel panel-primary">
		<?php
		$login = array(
			'name'	=> 'login',
			'id'	=> 'login',
			'value' => set_value('login'),
			'maxlength'	=> 80,
			'size'	=> 30,
		);
		if ($login_by_username AND $login_by_email) {
			$login_label = 'Email or login';
		} else if ($login_by_username) {
			$login_label = 'Login';
		} else {
			$login_label = 'Email';
		}
		$password = array(
			'name'	=> 'password',
			'id'	=> 'password',
			'size'	=> 30,
		);
		$remember = array(
			'name'	=> 'remember',
			'id'	=> 'remember',
			'value'	=> 1,
			'checked'	=> set_value('remember'),
			'style' => 'margin:0;padding:0',
		);
		$captcha = array(
			'name'	=> 'captcha',
			'id'	=> 'captcha',
			'maxlength'	=> 8,
		);
		?>
		<?php echo form_open($this->uri->uri_string()); ?>
		<div class='panel-heading'>
				<b>Plan-IT DMS Login</b>
		</div>
		<div class='panel-body'>
			<p> Welcome to Plan-IT data management system. <br> <br> Please login to continue or <?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register'); ?>. You will be able to login only after your account is active.<br> </p>
			<div class='panel' style='width: 50%; margin-left:auto; margin-right: auto; padding: 15px; text-align: center;'>
				<div class='row'>
					<div class='col-md-4 col-xs-12'><?php echo form_label($login_label, $login['id']); ?></div>
					<div class='col-md-4 col-xs-12'><?php echo form_input($login); ?></div>
					<div class='col-md-4 col-xs-12' style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></div>
				</div>
				<div class='row' style="padding-top: 8px;">
					<div class='col-md-4'><?php echo form_label('Password', $password['id']); ?></div>
					<div class='col-md-4'><?php echo form_password($password); ?></div>
					<div class='col-md-4' style="color: red;"><?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?></div>
				</div>

				<?php if ($show_captcha) {
					if ($use_recaptcha) { ?>
				<div class='row'>
					<div class='col-md-4'>
						<div id="recaptcha_image"></div>
					</div>
					<td>
						<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
						<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
						<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
					</td>
				</div>
				<div class='row'>
					<td>
						<div class="recaptcha_only_if_image">Enter the words above</div>
						<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
					</td>
					<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
					<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
					<?php echo $recaptcha_html; ?>
				</div>
				<?php } else { ?>
				<div class='row'>
					<td colspan="3">
						<p>Enter the code exactly as it appears:</p>
						<?php echo $captcha_html; ?>
					</td>
				</div>
				<div class='row'>
					<td><?php echo form_label('Confirmation Code', $captcha['id']); ?></td>
					<td><?php echo form_input($captcha); ?></td>
					<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
				</div>
				<?php }
				} ?>

				<div class='row'>
					<div class='col-md-11'>
						<?php echo anchor('/auth/forgot_password/', 'Forgot password'); ?><br>
						<?php echo form_checkbox($remember); ?>
						<?php echo form_label('Remember me', $remember['id']); ?><br>
					</div>
					<div class='col-md-1'></div>
				</div>
				<div class='row'>
					
					<div class='col-md-12'>
					<?php echo form_submit('submit', 'Login'); ?>
					<?php echo form_close(); ?>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
