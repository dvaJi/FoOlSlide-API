<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update010 extends CI_Migration {

	function up() {
    if (!$this->db->table_exists($this->db->dbprefix('descriptions'))) {
			$this->db->query(
					"CREATE TABLE IF NOT EXISTS `" . $this->db->dbprefix('descriptions') . "` (
                                          `id` int(11) NOT NULL AUTO_INCREMENT,
                                          `comic_id` int(11) NOT NULL,
                                          `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
                                          `description` text COLLATE utf8_unicode_ci NOT NULL,
                                          PRIMARY KEY (`id`)
                                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;"
			);
		}

		$this->db->query("
				ALTER TABLE `" . $this->db->dbprefix('posts') . "`
					ADD COLUMN `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL AFTER `hidden`;
		");

		$this->db->query("
				ALTER TABLE `" . $this->db->dbprefix('custompages') . "`
					ADD COLUMN `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL AFTER `hidden`;
		");

	}

}
