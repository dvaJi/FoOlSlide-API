<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

$CI = & get_instance();

if ($new_versions)
{
	if ($can_upgrade)
	{
		$CI->buttoner[] = array(
			'text' => _('Upgrade FoOlSlide Automatically'),
			'href' => site_url('admin/system/do_upgrade'),
			'plug' => _('Do you really want to upgrade to the latest version?'),
			'rel' => 'popover-below',
			'title' => _('Automatic Upgrade'),
			'data-content' => _('This will upgrade your FoOlSlide installation to the latest version.')
		);
	}

	$CI->buttoner[] = array(
		'text' => _('Download Latest Version'),
		'href' => $new_versions[0]->download,
		'rel' => 'popover-left',
		'title' => _('Download'),
		'data-content' => _('This allows you to download the latest FoOlSlide package to re-install or update your installation manually.')
	);
}

if (!$new_versions)
{
	if ($can_upgrade)
	{
		$CI->buttoner[] = array(
			'text' => _('Repair FoOlSlide'),
			'href' => site_url('admin/system/do_upgrade'),
			'plug' => _('Do you really want to re-install FoOlSlide?'),
			'rel' => 'popover-left',
			'title' => _('Download'),
			'data-content' => _('This will re-install FoOlslide automatically and repair any broken files during the process.')
		);
	}
}
?>
<div class="table" style="padding-bottom: 10px">
	<h3 style="float: left"><?php echo _('Upgrade'); ?></h3>
	<span style="float: right; padding: 5px"><?php echo buttoner(); ?></span>
	<hr class="clear"/>
	<?php
	echo _('Current Version') . ': ' . $current_version . '<br/>';
	echo ($new_versions ? _('Latest Version Available') . ': ' . ($new_versions[0]->version . '.' . $new_versions[0]->subversion . '.' . $new_versions[0]->subsubversion) : _('You have the latest version of FoOlSlide.')) . '<br/><br/>';
	?>
</div>

<br/>

<?php
if ($new_versions)
{
	echo '<div class="table" style="padding-bottom: 10px; margin-right:10px;">';
	echo '<h3>' . _('Changelog') . '</h3><div class="changelog">';
	foreach ($new_versions as $version)
	{
		echo '<br/><div class="item">
			<h4 class="title">' . _('Version') . ' ' . implode('.', array($version->version, $version->subversion, $version->subsubversion)) . '</h4>
			<div class="description">' . nl2br($version->changelog) . '</div></div>';
	}
	echo '</div></div>';
}
