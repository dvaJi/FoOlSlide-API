<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Pages extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!($this->tank_auth->is_allowed()))
			redirect('account');

		// if this is a load balancer, let's not allow people in the page tab
		if (get_setting('fs_balancer_master_url'))
			redirect('/admin/members');

		$this->load->model('files_model');
		$this->load->library('pagination');
		$this->viewdata['controller_title'] = '<a href="'.site_url("admin/pages").'">' . _("Pages") . '</a>';;
	}


	function index()
	{
		redirect('/admin/pages/manage');
	}


	function manage($page = 1)
	{
		$this->viewdata["function_title"] = _('Manage');
        $pages = new Custompage();

		if ($this->input->post('search'))
		{
			$search = $this->input->post('search');
			$pages->ilike('name', $search)->limit(20);
			$this->viewdata["extra_title"][] = _('Searching') . ': ' . htmlspecialchars(($search));
		}

		$pages->order_by('name', 'ASC');
		$pages->get_paged_iterated($page, 20);
		$data["pages"] = $pages;

		$this->viewdata["main_content_view"] = $this->load->view("admin/pages/manage.php", $data, TRUE);
		$this->load->view("admin/default.php", $this->viewdata);
	}


	function page($stub = NULL)
	{
		$page = new Custompage();
		$page->where("stub", $stub)->get();

		if ($page->result_count() == 0)
		{
			set_notice('warn', _('Sorry, the page you are looking for does not exist.'));
			$this->manage();
			return false;
		}

		$this->viewdata["function_title"] = '<a href="' . site_url('/admin/pages/manage/') . '">' . _('Manage') . '</a>';
		if ($stub == "") $this->viewdata["extra_title"][] = $page->name;

		if ($this->input->post())
		{
			// Prepare for stub change in case we have to redirect instead of just printing the view
			$old_page_stub = $page->stub;
			$page->update_custompage_db($this->input->post());

			flash_notice('notice', sprintf(_('Updated page information for %s.'), $page->name));
			// Did we change the stub of the page? We need to redirect to the new page then.
			if (isset($old_page_stub) && $old_page_stub != $page->stub)
			{
				redirect('/admin/pages/page/' . $page->stub);
			}
		}

		$data["page"] = $page;

		$custom_slug = array(array(
			_('Custom URL Slug'),
			array(
				'name' => 'has_custom_slug',
				'type' => 'checkbox',
				'text' => _('Has Custom URL Slug'),
				'help' => _('If you want to have a custom url slug or the page\'s title is written with non-latin letters tick this.'),
				'class' => 'jqslugcb'
			)
		));

		$table = ormer($page);
		array_splice($table, 2, 0, $custom_slug);
		$table = tabler($table);
		$data['table'] = $table;
		
		$this->viewdata["extra_script"] = '<script type="text/javascript" src="'.base_url().'assets/js/form-extra.js"></script>';
		$this->viewdata["extra_script"] = '<script type="text/javascript" src="'.base_url().'assets/ckeditor/ckeditor.js"></script>';
		$this->viewdata["main_content_view"] = $this->load->view("admin/pages/page.php", $data, TRUE);
		$this->load->view("admin/default.php", $this->viewdata);
	}


	function add_new($stub = "")
	{
		$this->viewdata["function_title"] = '<a href="#">'._("Add New").'</a>';

		//$stub stands for $page, but there's already a $page here
		$page = new Custompage();
		if ($this->input->post())
		{
			if ($page->add($this->input->post()))
			{
				$config['upload_path'] = 'content/cache/';
				$config['allowed_types'] = 'jpg|png|gif';
				$this->load->library('upload', $config);
				$field_name = "thumbnail";

				flash_notice('notice', sprintf(_('The page %s has been added.'), $page->name));
				redirect('/admin/pages/page/' . $page->stub);
			}
		}

			$table = ormer($page);

			$custom_slug = array(array(
				_('Custom URL Slug'),
				array(
					'name' => 'has_custom_slug',
					'type' => 'checkbox',
					'text' => _('Has Custom URL Slug'),
					'help' => _('If you want to have a custom url slug or the page\'s title is written with non-latin letters tick this.'),
					'class' => 'jqslugcb'
				)
			));
			array_splice($table, 2, 0, $custom_slug);

			$table = tabler($table, FALSE, TRUE);
			$data["form_title"] = _('Add New') . ' ' . _('Page');
			$data['table'] = $table;

			$this->viewdata["extra_title"][] = _("Page");
			$this->viewdata["extra_script"] = '<script type="text/javascript" src="'.base_url().'assets/js/form-extra.js"></script>';
			$this->viewdata["extra_script"] = '<script type="text/javascript" src="'.base_url().'assets/ckeditor/ckeditor.js"></script>';
			$this->viewdata["main_content_view"] = $this->load->view("admin/form.php", $data, TRUE);
			$this->load->view("admin/default.php", $this->viewdata);
	}

	function delete($type, $id = 0)
	{
		if (!isAjax())
		{
			$this->output->set_output(_('You can\'t delete pages from outside the admin panel through this link.'));
			log_message("error", "Controller: page.php/remove: failed page removal");
			return false;
		}
		$id = intval($id);
		
		switch ($type)
		{
			case("page"):
				$page = new Custompage();
				$page->where('id', $id)->get();
				$title = $page->name;
				if (!$page->remove())
				{
					flash_notice('error', sprintf(_('Failed to delete the page %s.'), $title));
					log_message("error", "Controller: page.php/remove: failed page removal");
					$this->output->set_output(json_encode(array('href' => site_url("admin/pages/manage"))));
					return false;
				}
				flash_notice('notice', 'The page ' . $page->name . ' has been removed');
				$this->output->set_output(json_encode(array('href' => site_url("admin/pages/manage"))));
				break;
		}
	}

}
