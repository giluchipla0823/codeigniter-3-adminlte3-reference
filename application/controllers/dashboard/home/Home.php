<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller
{
    public function index()
    {
        $container = 'dashboard/home/index_view';

        $this->load->view('dashboard/template/layout_view', array(
            'container' => $container
        ));
    }
}