<div class="incontent login">
	<?php
    if ($login_by_username AND $login_by_email)
	{
		$login_label = _('Email or username');
	}
	else if ($login_by_username)
	{
		$login_label = _('Login');
	}
	else
	{
		$login_label = _('Email');
	}
	$login = array(
		'name' => 'login',
		'id' => 'login',
		'value' => set_value('login'),
		'maxlength' => 80,
		'size' => 30,
		'placeholder' => $login_label,
        'class' => 'form-control',
        'required' => 'required',
        'aria-describedby' => 'uadd'
	);
	$password = array(
		'name' => 'password',
		'id' => 'password',
		'size' => 30,
		'placeholder' => 'Password',
        'class' => 'form-control',
        'required' => 'required',
        'aria-describedby' => 'padd'
	);
	$remember = array(
		'name' => 'remember',
		'id' => 'remember',
		'value' => 1,
		'checked' => set_value('remember')
	);
	$captcha = array(
		'name' => 'captcha',
		'id' => 'captcha',
        'class' => 'form-control',
		'maxlength' => 8
	);
	?>
	<?php echo form_open($this->uri->uri_string()); ?>

	<div class="input-group">
    <span class="input-group-addon" id="uadd"><i class="fa fa-user"></i></span>
		<?php echo form_input($login); ?>
	</div>
    <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']]) ? '<div class="alert alert-danger" role="alert">'.$errors[$login['name']].'</div>' : ''; ?>

	<div class="input-group">
        <span class="input-group-addon" id="padd" style="max-width: 36px;"><i class="fa fa-key"></i></span>
		<?php echo form_password($password); ?>
	</div>
    <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']]) ? '<div class="alert alert-danger" role="alert">'.$errors[$password['name']].'</div>' : ''; ?>

	<?php
	if ($show_captcha)
	{
		if ($use_recaptcha)
		{
			?>
			<tr>
				<td>
					<div id="recaptcha_image"></div>
				</td>
				<td>
					<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
					<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
					<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="recaptcha_only_if_image">Enter the words above</div>
					<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
				</td>
				<td><input type="text" class="form-control" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
				<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
				<?php echo $recaptcha_html; ?>
			</tr>
			<?php
		}
		else
		{
			?>
			<tr>
				<td>
					<p>Enter the code exactly as it appears:</p>
					<?php echo $captcha_html; ?>
				</td>
			</tr>
			<tr>
				<td><?php echo form_label(_('Confirmation Code'), $captcha['id']); ?></td>
				<td><?php echo form_input($captcha); ?></td>
				<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
			</tr>
		<?php }
	} ?>

	<div class="formgroup">
		<div><?php echo form_label(_('Remember me'), $remember['id']); ?> <?php echo form_checkbox($remember); ?>
		</div>
	</div>
	<div class="formgroup">
		<div><?php echo form_submit(array('name' => 'submit', 'class' => 'form-control btn btn-success'), _('Login')); ?></div>
	</div>
</table>
<?php echo form_close(); ?>

<table>
	<tr>
		<td>
			<a href="<?php echo site_url('/account/auth/forgot_password/') ?>" class="btn btn-warning form-control"><?php echo _("Forgot password") ?></a>
		</td>
		<?php
		if ($this->config->item('allow_registration', 'tank_auth'))
		{
			echo '<td><a href="' . site_url('/account/auth/register/') . '" class="btn btn-primary form-control">' . _("Register") . '</a></td>';
		}
		?>
	</tr>
</table>
