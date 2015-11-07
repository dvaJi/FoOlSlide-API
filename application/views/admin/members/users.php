<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="table" style="padding-bottom: 15px">
    <div class="cont">
<?php
        if (isset($form_title)) echo '<h3 style="float: left;">' . $form_title . '</h3>';
?>
        <span style="float: right;">
            <div class="smartsearch">
            <?php
            echo form_open();
            echo form_input(array('name'=>'search', 'placeholder' => _('To search, write and hit enter'), 'class' => 'form-control'));
            echo form_close();
            ?>
            </div>
        </span>
    </div>
	<div style="padding-right: 10px">
	<?php
		echo buttoner();
		echo $table;
	?>
	</div>
</div>