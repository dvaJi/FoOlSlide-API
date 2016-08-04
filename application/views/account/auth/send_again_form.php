<div class="incontent login"><?php
$email = array(
	'name' => 'email',
	'id' => 'email',
	'value' => set_value('email'),
	'maxlength' => 80,
	'size' => 30,
    'required' => 'required',
    'class' => 'form-control'
);
?>
	<?php echo form_open($this->uri->uri_string()); ?>
	<div class="formgroup">
		<div><?php echo form_label('Email Address', $email['id']); ?></div>
		<div><?php echo form_input($email); ?></div>
		<div style="color: red;"><?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']]) ? $errors[$email['name']] : ''; ?></div>
	</div>
	<div class="formgroup">
		<div>
			<?php echo form_submit(array('name' => 'send', 'class' => 'form-control btn btn-primary'), 'Send'); ?>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>