<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->tank_auth->is_logged_in())
		{
			$this->session->set_userdata('login_redirect', $this->uri->uri_string());
			redirect('/account/auth/login');
		}
		$this->tank_auth->is_allowed() or show_404();

		$this->viewdata["sidebar"] = $this->sidebar();

		// Check if the database is upgraded to the the latest available
		if ($this->tank_auth->is_admin() && $this->uri->uri_string() != 'admin/database/upgrade' && $this->uri->uri_string() != 'admin/database/do_upgrade')
		{
			$this->config->load('migration');
			$config_version = $this->config->item('migration_version');
			$db_version = $this->db->get('migrations')->row()->version;
			if ($db_version != $config_version)
			{
				redirect('/admin/database/upgrade/');
			}
			$this->cron();
		}
	}


	/*
	 * Non-dynamic sidebar array.
	 * Permissions are set inside
	 *
	 * @author Woxxy & chocolatkey
	 * @return sidebar array
	 */
	function sidebar_val()
	{

		$sidebar = array();

		if (get_setting('fs_balancer_master_url'))
		{
			$sidebar["members"] = array(
				"name" => _("Members"),
				"level" => "member",
				"default" => "members",
				"icon" => "graduation-cap",
				"content" => array(
					"members" => array("level" => "mod", "name" => _("Member List"), "icon" => "user"),
				)
			);
			$sidebar["preferences"] = array(
				"name" => _("Preferences"),
				"level" => "admin",
				"default" => "general",
				"icon" => "cogs",
				"content" => array(
					"registration" => array("level" => "admin", "name" => _("Registration"), "icon" => "credit-card"),
				)
			);
			$sidebar["balancer"] = array("name" => _("Load balancer"),
				"level" => "admin",
				"default" => "balancers",
				"icon" => "line-chart",
				"content" => array(
					"client" => array("level" => "admin", "name" => _("Client"), "icon" => "download"),
				)
			);

			return $sidebar;
		}

		$sidebar["series"] = array(
			"name" => _("Series"),
			"level" => "mod",
			"default" => "manage",
			"icon" => "th-list",
			"content" => array(
				"manage" => array("level" => "mod", "name" => _("Manage"), "icon" => "archive"),
				"add_new" => array("level" => "mod", "name" => _("Add Series"), "icon" => "edit"),
				"add_new_chapter" => array("level" => "mod", "name" => _("Add Chapter"), "icon" => "pencil")
			)
		);
		$sidebar["members"] = array(
			"name" => _("Members"),
			"level" => "member",
			"default" => "members",
			"icon" => "graduation-cap",
			"content" => array(
				"members" => array("level" => "mod", "name" => _("Member List"), "icon" => "user"),
				"teams" => array("level" => "member", "name" => _("Team List"), "icon" => "users"),
				"home_team" => array("level" => "member", "name" => _("Home Team"), "icon" => "home"),
				"add_team" => array("level" => "mod", "name" => _("Add Team"), "icon" => "plus")
			)
		);
		$sidebar["preferences"] = array(
			"name" => _("Preferences"),
			"level" => "admin",
			"default" => "general",
			"icon" => "cogs",
			"content" => array(
				"general" => array("level" => "admin", "name" => _("General"), "icon" => "cog"),
				"reader" => array("level" => "admin", "name" => _("Reader"), "icon" => "book"),
				"theme" => array("level" => "admin", "name" => _("Theme"), "icon" => "eye"),
				"slideshow" => array("level" => "admin", "name" => _("Slideshow"), "icon" => "camera-retro"),
				"registration" => array("level" => "admin", "name" => _("Registration"), "icon" => "credit-card"),
				"advertising" => array("level" => "admin", "name" => _("Advertising"), "icon" => "puzzle-piece"),
			)
		);
		$sidebar["balancer"] = array("name" => _("Load Balancer"),
			"level" => "admin",
			"default" => "balancers",
			"icon" => "line-chart",
			"content" => array(
				"balancers" => array("level" => "admin", "name" => _("Master"), "icon" => "upload"),
				"client" => array("level" => "admin", "name" => _("Client"), "icon" => "download"),
			)
		);
		$sidebar["system"] = array("name" => _("System"),
			"level" => "admin",
			"default" => "system",
			"icon" => "server",
			"content" => array(
				"information" => array("level" => "admin", "name" => _("Information"), "icon" => "info"),
				"tools" => array("level" => "admin", "name" => _("Tools"), "icon" => "wrench"),
				"upgrade" => array("level" => "admin", "name" => _("Upgrade") . ((get_setting('fs_cron_autoupgrade_version') && version_compare(FOOLSLIDE_VERSION, get_setting('fs_cron_autoupgrade_version')) < 0) ? ' <span class="label label-success">' . _('New') . '</span>' : ''), "icon" => "cloud-upload"),
			)
		);

		$sidebar["meta"] = array("name" => "Meta", // no gettext because meta must be meta
			"level" => "member",
			"default" => "http://blog.foolz.us",
			"icon" => "comments",
			"content" => array(
				"http://archive.foolz.us/dev/" => array("level" => "member", "name" => _("Developer Community"), "icon" => "comments-o"),
				"http://chocolatkey.com" => array("level" => "member", "name" => _("Developer Site"), "icon" => "building"),
				"http://github.com/chocolatkey/" => array("level" => "member", "name" => _("Chocolatkey Github"), "icon" => "github"),
			)
		);

		return $sidebar;
	}


	/*
	 * Returns the topnavbar code
	 *
	 * @todo comment this
     * @author chocolatkey
	 */
	public function sidebar()
	{
		// not logged in users don't need the sidebar
		if (!$this->tank_auth->is_logged_in())
			return false;

		$result = "";
		foreach ($this->sidebar_val() as $key => $item)
		{

			// segment 2 contains what's currently active so we can set it lighted up
			if ($this->uri->segment(2) == $key)
				$active = TRUE;
			else
				$active = FALSE;
			if (($this->tank_auth->is_admin() || $this->tank_auth->is_group($item["level"])) && !empty($item))
			{
				$result .= '<li class="dropdown ' . ($active ? 'active' : '') . '">';
                $result .= '<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="' . ((substr($item["default"], 0, 7) == 'http://') ? $item["default"] : site_url(array("admin", $key, $item["default"]))) . '" ' . ((substr($item["default"], 0, 7) == 'http://') ? 'target="_blank"' : '') . '><i class="fa fa-' . $item['icon'] . '""></i> ' . $item["name"] . ' <span class="caret"></span></a>';
				$result .= '<ul class="dropdown-menu">';
				foreach ($item["content"] as $subkey => $subitem)
				{
					if ($active && $this->uri->segment(3) == $subkey)
						$subactive = TRUE;
					else
						$subactive = FALSE;
					if (($this->tank_auth->is_admin() || $this->tank_auth->is_group($subitem["level"])))
					{
						//if($subitem["name"] == $_GET["location"]) $is_active = " active"; else $is_active = "";
						$is_active = "";
						$result .= '<li class="' . ($subactive ? 'active' : '') . '"><a href="' . ((substr($subkey, 0, 7) == 'http://') ? $subkey : site_url(array("admin", $key, $subkey))) . '"  ' . ((substr($subkey, 0, 7) == 'http://') ? 'target="_blank"' : '') . '><i class="fa fa-' . $subitem['icon'] . '""></i> ' . $subitem["name"] . '</a></li>';
					}
				}
				$result .= '</ul></li>';
			}
		}
		return $result;
	}


	/*
	 * Controller for cron triggered by admin panel
	 * Currently defaulted crons:
	 * -check for updates
	 * -remove one week old logs
	 *
	 * @author Woxxy
	 */
	public function cron()
	{
		if ($this->tank_auth->is_admin())
		{
			$last_check = get_setting('fs_cron_autoupgrade');

			// hourly cron
			if (time() - $last_check > 3600)
			{
				// update autoupgrade cron time
				$this->db->update('preferences', array('value' => time()), array('name' => 'fs_cron_autoupgrade'));

				// load model
				$this->load->model('upgrade_model');
				// check
				$versions = $this->upgrade_model->check_latest(TRUE);

				// if a version is outputted, save the new version number in database
				if ($versions[0])
				{
					$this->db->update('preferences', array('value' => $versions[0]->version . '.' . $versions[0]->subversion . '.' . $versions[0]->subsubversion), array('name' => 'fs_cron_autoupgrade_version'));
				}

				// remove one week old logs
				$files = glob($this->config->item('log_path') . 'log*.php');
				foreach ($files as $file)
				{
					if (filemtime($file) < strtotime('-7 days'))
					{
						unlink($file);
					}
				}

				// reload the settings
				load_settings();
			}
		}
	}


}