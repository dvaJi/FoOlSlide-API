<?php
$this->buttoner[] = array(
	'text' => _('Delete Series'),
	'href' => site_url('/admin/series/delete/serie/'.$comic->id),
	'plug' => _('Do you really want to delete this series and its chapters?'),
    'class' => "btn-danger"
);
?>
<div class="table">
    <h3><?php echo _('Series Information'); ?> <?php echo buttoner(); ?></h3>
	<?php
		echo form_open_multipart("", array('class' => 'form-stacked'));
		echo $table;
		echo form_close();
	?>
</div>

<br/>

<?php
	$this->buttoner = array(
		array(
			'href' => site_url('/admin/series/add_new/'.$comic->stub),
			'text' => _('Add Chapter'),
            'class' => "btn-success"
		)
	);
	
	if($this->tank_auth->is_admin())
	{
		$this->buttoner[] = array(
			'href' => site_url('/admin/series/import/'.$comic->stub),
			'text' => _('Import From Folder')
		);
	}
?>
<div class="table" style="padding-bottom: 15px">
	<h3><?php echo _('Chapters'); ?> <?php echo buttoner(); ?></h3>
	<div class="list chapters">
	<?php
		foreach ($chapters as $item)
		{
			echo '<div class="item">
				<div class="title"><a href="'.site_url("admin/series/series/".$comic->stub."/".$item->id).'">'. $item->title().'</a></div>
				<div class="smalltext info">
					Chapter #'.$item->chapter.'
					Sub #'.$item->subchapter;
						if(isset($item->jointers))
						{
							echo ' By ';
							foreach($item->jointers as $key2 => $jointe)
							{
								if($key2>0) echo " | ";
								echo '<a href="'.site_url("/admin/users/teams/".$jointe->stub).'">'.$jointe->name.'</a>';
							}
						}
						else echo ' By <a href="'.site_url("/admin/users/teams/".$item->team_stub).'">'.$item->team_name.'</a>';
						echo '</div>
				<div class="smalltext">
					'._('Quick tools').': 
						<a href="'.site_url("admin/series/delete/chapter/".$item->id).'" onclick="confirmPlug(\''.site_url("admin/series/delete/chapter/".$item->id).'\', \''._('Do you really want to delete this chapter and its pages?'). '\'); return false;">' . _('Delete') . '</a> |
						<a href="';
							echo $item->href();
			echo '">' . _('Read') . '</a>
				</div>';
			echo '</div>';
		}
	?>
	</div>
</div>