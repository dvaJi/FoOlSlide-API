<?php
$CI =& get_instance();
$CI->buttoner = array(
	array(
		'href' => site_url('/admin/pages/add_new/'),
		'text' => _('Add page')
	)
);
?>

<div class="table" style="padding-bottom: 15px">
	<h3 style="float: left"><?php echo _('Pages Information'); ?></h3>
	<span style="float: right; padding: 5px">
		<div class="smartsearch">
		<?php
		echo form_open(site_url('/admin/pages/manage/'));
		echo form_input(array('name'=>'search', 'placeholder' => _('To search, write and hit enter')));
		echo form_close();
		?>
		</div>
	</span>
	<hr class="clear"/>
	<?php echo buttoner(); ?>

	<div class="list pages">
		<?php
		foreach ($pages as $page)
		{
			echo '<div class="item">
				<div class="title"><a href="'.site_url("admin/pages/page/".$page->stub).'">'.$page->name.'</a></div>
				<div class="smalltext">'._('Quick tools').':
					<a href="'.site_url("admin/pages/delete/page/".$page->id).'" onclick="confirmPlug(\''.site_url("admin/pages/delete/page/".$page->id).'\', \''._('Do you really want to delete this page?').'\'); return false;">'._('Delete').'</a> |
					<a href="'.site_url("pages/".$page->stub).'">'._('Read').'</a>
				</div>';
			echo '</div>';
		}
		?>
	</div>
<?php
	if ($pages->paged->total_pages > 1)
	{
?>
	<div class="pagination" style="margin-bottom: -5px">
		<ul>
		<?php
			if ($pages->paged->has_previous)
				echo '<li class="prev"><a href="' . site_url('admin/pages/manage/'.$pages->paged->previous_page) . '">&larr; ' . _('Prev') . '</a></li>';
			else
				echo '<li class="prev disabled"><a href="#">&larr; ' . _('Prev') . '</a></li>';

			$page = 1;
			while ($page <= $pages->paged->total_pages)
			{
				if ($pages->paged->current_page == $page)
					echo '<li class="active"><a href="#">' . $page . '</a></li>';
				else
					echo '<li><a href="' . site_url('admin/pages/manage/'.$page) .'">' . $page . '</a></li>';
				$page++;
			}

			if ($pages->paged->has_next)
				echo '<li class="next"><a href="' . site_url('admin/pages/manage/'.$pages->paged->next_page) . '">' . _('Next') . ' &rarr;</a></li>';
			else
				echo '<li class="next disabled"><a href="#">' . _('Next') . ' &rarr;</a></li>';
		?>
		</ul>
	</div>
<?php
	}
?>
</div>
