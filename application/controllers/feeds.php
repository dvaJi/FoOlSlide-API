<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feeds extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    function index($format = NULL, $unlimited = FALSE, $lang = 'es')
    {
        $this->load->helper('xml');
        $chapters = new Chapter();

        $chapters->where('language', $lang);

        $chapters->where('hidden', 0);

        // filter with orderby
        $chapters->order_by('created', 'DESC');

        // get the generic chapters and the comic coming with them
        if ($unlimited == TRUE) {
            $chapters->limit(99999999)->get();
        } else {
            $chapters->limit(25)->get();
        }
        $chapters->get_comic();

        if ($chapters->result_count() > 0) {
            // let's create a pretty array of chapters [comic][chapter][teams]
            $result['chapters'] = array();
            foreach ($chapters->all as $key => $chapter) {
                $result['chapters'][$key]['title'] = $chapter->comic->title() . ' ' . $chapter->title();
                $result['chapters'][$key]['thumb'] = $chapter->comic->get_thumb();
                $result['chapters'][$key]['href'] = $chapter->href();
                $result['chapters'][$key]['created'] = $chapter->created;
            }
        } else
            show_404();

        $data['encoding'] = 'utf-8';
        $data['feed_name'] = get_setting('fs_gen_site_title') . ' | ' . strtoupper($lang);
        $data['feed_url'] = site_url('feeds/rss');
        $data['page_description'] = get_setting('fs_gen_site_title') . ' RSS feed | ' . strtoupper($lang);
        $data['page_language'] = $lang;
        $data['posts'] = $result;
        if ($format == "atom") {
            header("Content-Type: application/atom+xml");
            $this->load->view('atom', $data);
            return TRUE;
        }
        header("Content-Type: application/rss+xml");
        $this->load->view('rss', $data);
    }

}