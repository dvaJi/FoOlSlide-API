<?php
$this->buttoner[] = array(
	'text' => _('Delete page'),
	'href' => site_url('/admin/blog/delete/page/'.$page->id),
	'plug' => _('Do you really want to delete this page?')
);
?>
<div class="table">
	<h3 style="float: left"><?php echo _('Page Information'); ?></h3>
	<span style="float: right; padding: 5px"><?php echo buttoner(); ?></span>
	<hr class="clear"/>
	<?php
		echo form_open_multipart("", array('class' => 'form-stacked'));
		echo $table;
		echo form_close();
	?>
</div>
<script>
	CKEDITOR.replace( 'description' );
	CKEDITOR.config.width = '95%';
</script>
<br/>

<?php
	$this->buttoner = array(
		array(
			'href' => site_url('/admin/blog/add_new/'.$page->stub),
			'text' => _('Add Chapter')
		)
	);
	
	if($this->tank_auth->is_admin())
	{
		$this->buttoner[] = array(
			'href' => site_url('/admin/blog/import/'.$page->stub),
			'text' => _('Import From Folder')
		);
	}
?>
