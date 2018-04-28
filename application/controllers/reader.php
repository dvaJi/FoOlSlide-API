<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reader extends Public_Controller
{
    function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        show_404();
    }

}
