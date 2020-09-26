<?php


class CheckAuthenticated
{
    private $CI;

    private $excludeControllers = array(
        'login', 'logout', 'register', 'welcome', 'activate_account'
    );

    public function __construct() {
        $this->CI = & get_instance();
        !$this->CI->load->library('session') ? $this->CI->load->library('session') : false;
    }

    public function execute(){
        $controller = $this->CI->router->fetch_class();

        if(in_array($controller, $this->excludeControllers)){
            return;
        }

        $isLogged = $this->CI->session->userdata('isLogged');

        if(!$isLogged){
            redirect(base_url('logout'));
        }
    }
}