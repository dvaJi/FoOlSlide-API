<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>
<style>
.table-responsive {
    border: 0px;
}
</style>
<div class="table">
    <div class="cont">
        <h3 style="float: left"><?php echo _('Team Information'); ?> <?php echo buttoner(); ?></h3>
    </div>
	<?php
		echo form_open("", array('class' => 'form-stacked form-group'));
		echo $table;
		echo form_close();
	?>
</div>

<br/>

<div class="table">
	<h3><?php echo _('Members'); ?></h3>
<?php
if ($no_leader) {
	echo form_open("/admin/members/make_team_leader_username/".$team->id, array('class' => 'form-stacked form-inline'));
	echo '<div class="form-group"><div class="clearfix">
		<label>'._("Make an user a leader by submitting his username:").'</label>
		<div class="input-group">';
	echo form_input(array('name' => 'username', 'placeholder' => 'Username', 'class' => 'form-control', 'style' => 'float: left'));
	echo '<div class="input-group-btn">';
	echo form_submit(array('name' => 'save', 'value' => 'Add', 'class' => 'btn btn-success'));
	echo '</div></div></div>';
	echo form_close();
}
?>
	<div style="padding-right: 10px; margin-bottom: -5px">
		<?php echo $members; ?>
	</div>
</div>