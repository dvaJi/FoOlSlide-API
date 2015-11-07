<div class="incontent panel">
	<?php
	$display_name = array(
		'name' => 'display_name',
		'id' => 'display_name',
		'value' => $user_display_name,
        'class' => 'form-control'
	);
	$twitter = array(
		'name' => 'twitter',
		'id' => 'twitter',
		'value' => $user_twitter,
        'class' => 'form-control'
	);
	$bio = array(
		'name' => 'bio',
		'id' => 'bio',
		'maxlenght' => 140,
		'value' => $user_bio,
        'class' => 'form-control'
	);
	?>

	<div class="row">
        <div class="col-md-5 col-md-push-7">
            <div class="formgroup">
                <div style="text-align:center"><img width="150" height="150" src="<?php echo get_gravatar($user_email, 150); ?>" /></div>
                <div style="text-align:center"><a href="http://gravatar.com" class="btn" target="_blank"><?php echo _('Change avatar (via Gravatar.com)') ?></a></div>
            </div>
            <hr />
            <div class="formgroup">
                <div>Your email: <?php echo $user_email ?> (<?php echo _('not public') ?>)</div>
                <div><a href="<?php echo site_url('/account/auth/change_email/') ?>" class="btn btn-primary form-control"><?php echo _('Change email') ?></a></div>
            </div>
            <div class="formgroup">
                <div><a href="<?php echo site_url('/account/auth/change_password/') ?>" class="btn btn-warning form-control"><?php echo _('Change password') ?></a></div>
            </div>
            <div class="formgroup">
                <div><a href="<?php echo site_url('/account/auth/unregister/') ?>" class="btn btn-danger form-control"><?php echo _('Delete account') ?></a></div>
            </div>
        </div>
        <div class="col-md-7 col-md-pull-5">
            <?php echo form_open(); ?>
            <div class="formgroup">
                <div><?php echo form_label(_('Display name (public)'), $display_name['id']); ?></div>
                <div><?php echo form_input($display_name); ?></div>
                <div style="color: red;"><?php echo form_error($display_name['name']); ?><?php echo isset($errors[$display_name['name']]) ? $errors[$display_name['name']] : ''; ?></div>
            </div>

            <div class="formgroup">
                <div><?php echo form_label(_('Twitter username (public)'), $twitter['id']); ?></div>
                <div><?php echo form_input($twitter); ?></div>
                <div style="color: red;"><?php echo form_error($twitter['name']); ?><?php echo isset($errors[$twitter['name']]) ? $errors[$twitter['name']] : ''; ?></div>
            </div>

            <div class="formgroup">
                <div><?php echo form_label(_('Bio (public) (max 140 characters)'), $bio['id']); ?></div>
                <div><?php echo form_textarea($bio); ?></div>
                <div style="color: red;"><?php echo form_error($bio['name']); ?><?php echo isset($errors[$bio['name']]) ? $errors[$bio['name']] : ''; ?></div>
            </div>

            <div class="formgroup">
                <div><?php echo form_submit(array('name' => 'submit', 'class' => 'form-control btn btn-success'), _('Save')); ?></div>
                <div style="color: green;"><?php if(isset($saved)) echo _("Saved") ?></div>
            </div>
            <?php echo form_close(); ?>
        </div>
	</div>
	

</div>

