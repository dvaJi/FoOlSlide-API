<div class="incontent login">
	<?php
    if ($this->config->item('use_username', 'tank_auth'))
	{
		$login_label = 'Email or login';
	}
	else
	{
		$login_label = 'Email';
	}
	$login = array(
		'name' => 'login',
		'id' => 'login',
		'value' => set_value('login'),
		'maxlength' => 80,
		'size' => 30,
        'class' => 'form-control',
        'placeholder' => $login_label
	);
	?>
	<?php echo form_open($this->uri->uri_string()); ?>
	<div class="formgroup">
		<?php echo form_input($login); ?>
		<div style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']]) ? $errors[$login['name']] : ''; ?></div>
	</div>
	<div class="formgroup">
		<div>
			<?php echo form_submit(array('name' => 'reset', 'class' => 'form-control btn btn-primary'), 'Get a new password'); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
			<a href="<?php echo site_url('/account/auth/login/') ?>" class="btn btn-warning"><?php echo _("Back to login") ?></a>
