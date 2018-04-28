<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Public_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// if this is a load balancer FoOlSlide, disable the public interface
		if (get_setting('fs_balancer_master_url'))
		{
			show_404();
		}
	}

}