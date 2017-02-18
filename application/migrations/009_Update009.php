<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update009 extends CI_Migration {

	function up() {
		$this->db->query("
				ALTER TABLE `" . $this->db->dbprefix('ci_sessions') . "`
					CHANGE ip_address ip_address varchar(45) default '0' NOT NULL
		");
	}

}
