<?php
$muhSSL = false;
if(isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on")
{
    $muhSSL = true;
}
else
{
    if(FORCE_SSL)
    {
        header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo get_setting('fs_gen_site_title'); ?> <?php echo _('Control Panel') ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css?v=<?php echo FOOLSLIDE_VERSION ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome.min.css?v=<?php echo FOOLSLIDE_VERSION ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/admin/style.css?v=<?php echo FOOLSLIDE_VERSION ?>" />
		<style type="text/css">
			body {
				padding-top: 60px;
			}
		</style>
		<script type="text/javascript" src="<?php echo site_url() ?>assets/js/jquery.min.js?v=<?php echo FOOLSLIDE_VERSION ?>"></script>
        <script type="text/javascript" src="<?php echo site_url() ?>assets/js/bootstrap.min.js?v=<?php echo FOOLSLIDE_VERSION ?>"></script>
        <script type="text/javascript" src="<?php echo site_url() ?>assets/js/jquery-migrate-1.2.1.min.js?v=<?php echo FOOLSLIDE_VERSION ?>"></script>
		<script type="text/javascript">
			function slideDown(item) { jQuery(item).slideDown(); }
			function slideUp(item) { jQuery(item).slideUp(); }
			function slideToggle(item) { jQuery(item).slideToggle(); }
			
			function confirmPlug(href, text, item, func)
			{
				if (text != "") {
					var modalContainer = jQuery("#modal-container");
					modalContainer.modal({show: true, closeOnEscape: true, backdrop: 'static', keyboard: true});
					modalContainer.find("#modal-text-desc").html(text);
					modalContainer.find("#modal-btn-no").click(function() {
						modalContainer.modal('hide');
						return false;
					});
					modalContainer.find("#modal-btn-yes").attr('href', href).click(function(e) {
						if(func instanceof Function)
						{
							e.preventDefault();
							modalContainer.modal('hide');
							func();
							return false;
						}
						
						modalContainer.find("#modal-loading").show();
						jQuery.post(href, function(result) {
							modalContainer.find("#modal-loading").hide();
							if (location.href == result.href) window.location.reload(true);
							location.href = result.href;
						}, 'json');
						return false;
					}).focus();
				}
				else {
					jQuery.post(href, function(result) {
						if (location.href == result.href) window.location.reload(true);
						location.href = result.href;
					}, 'json');
				}
			}
			
			function addField(e)
			{
				if (jQuery(e).val().length > 0)
				{
					jQuery(e).clone().val('').insertAfter(e);
					jQuery(e).after('<br/>');
					jQuery(e).attr('onKeyUp', '');
					jQuery(e).attr('onChange', '');
				}
			}
			
			jQuery(document).ready(function() {
<?php
$CI = & get_instance();
if ($CI->agent->is_browser('MSIE'))
{
	?>
							jQuery('[placeholder]').focus(function() {
								var input = jQuery(this);
								if (input.val() == input.attr('placeholder'))
								{
									input.val('');
									input.removeClass('placeholder');
								}
							}).blur(function() {
								var input = jQuery(this);
								if (input.val() == '' || input.val() == input.attr('placeholder'))
								{
									input.addClass('placeholder');
									input.val(input.attr('placeholder'));
								}
							}).blur().parents('forms').submit(function() {
								jQuery(this).find('[placeholder]').each(function() {
									var input = jQuery(this);
									if (input.val() == input.attr('placeholder')) {
										input.val('');
									}
								})
							});
<?php } ?>
						// Auto-Focus on First Input
						jQuery(":input:first").focus(); // Focus on first input generated

						// Bootstrap jQuery
						/*jQuery("a[rel=twipsy]").twipsy({ live: true });*/
						jQuery("a[rel^='popover']").each(function() {
							var direction = $(this).attr('rel').replace("popover-", "");
							$(this).popover({ offset: 10, placement: direction, html: true });
						});
					});
		</script>
				<?php
			if (isset($extra_script))
				echo $extra_script;
		 ?>
		<script type="text/javascript">jQuery().alert();</script>
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nvb" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?php echo site_url('admin') ?>"><?php echo get_setting('fs_gen_site_title'); ?> - <?php echo _('Control Panel'); ?></a>
                </div>
                <div class="collapse navbar-collapse" id="nvb">
                    <ul class="nav navbar-nav">
                        <?php echo $sidebar ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo site_url(); ?>">
                                <i class="fa fa-book"></i> <?php echo _("Reader") ?></a></li>
                        <?php if ((isset($this->tank_auth) && $this->tank_auth->is_allowed()) || (isset($this->tank_auth) && $this->tank_auth->is_logged_in()))
                        { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $this->tank_auth->get_username(); ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <?php if (isset($this->tank_auth) && $this->tank_auth->is_allowed())
                                    { ?><li><a href="<?php echo site_url('account'); ?>"><i class="fa fa-user-md"></i> 
                                                <?php echo _("Your Profile") ?></a></li>
                                    <?php } ?>
                                    <?php if (isset($this->tank_auth) && $this->tank_auth->is_logged_in())
                                    { ?><li><a href="<?php echo site_url('/account/auth/logout'); ?>"><i class="fa fa-sign-out"></i>  
                                                <?php echo _("Logout") ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        </ul>
                </div>
            </div>
		</nav>

		<div class="container-fluid">

			<div class="content">
				<ul class="breadcrumb">
					<?php
					echo '<li>' . $controller_title . '</li>';
					if (isset($function_title))
						echo ' <span class="divider">/</span> <li>' . $function_title . '</li>';
					if (isset($extra_title) && !empty($extra_title))
					{
						$breadcrumbs = count($extra_title);
						$count = 1;
						foreach ($extra_title as $item)
						{
							echo ' <span class="divider">/</span> ';
							if ($count == $breadcrumbs)
								echo '<li class="active">' . $item . '</li>';
							else
								echo '<li>' . $item . '</li>';
						}
					}
					?>
				</ul>

				<div class="alerts">
					<?php
                        if(!$muhSSL)
                        {
                            echo '<div class="alert alert-warning"><i class="fa fa-unlock-alt" aria-hidden="true"></i> '._("Potentially insecure connection, data could be intercepted.").'</div>';
                        }
						echo get_notices();
					?>
				</div>

<?php echo $main_content_view; ?>
			</div>
		</div>

		<footer style="position: relative; bottom: 0px; width: 100%">
			<p style="padding-left: 20px;">FoOlSlide Version <?php
if (isset($this->tank_auth))
{
	echo FOOLSLIDE_VERSION;
	if ($this->tank_auth->is_admin() && (FOOLSLIDE_VERSION != get_setting('fs_cron_autoupgrade_version') && (get_setting('fs_cron_autoupgrade_version'))))
		echo ' – <a href="' . site_url('admin/system/upgrade/') . '">' . _('New upgrade available:') . ' ' . get_setting('fs_cron_autoupgrade_version') . '</a>';
}
?></p>
		</footer>

		<!-- Modal Container for Admin Panel -->
		<div id="modal-container" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 id="modal-text-head">Warning!</h3>
                    </div>
                    <div class="modal-body">
                        <p id="modal-text-desc"></p>
                        <div id="modal-loading" class="loading"><img src="<?php echo site_url() ?>assets/js/images/loader-18.gif"/></div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" id="modal-btn-no" class="btn btn-danger"><?php echo _('No'); ?></a>
                        <a href="#" id="modal-btn-yes" class="btn btn-success"><?php echo _('Yes'); ?></a>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>