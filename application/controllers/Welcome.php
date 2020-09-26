<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function test(){
        $this->load->library('email');

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => 'c2467942a7ac2a',
            'smtp_pass' => 'eef4e12c0e7816',
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html',
        );

        $body = $this->load->view(
            'emails/auth/register_users_email_view',
            array(),
            TRUE
        );

        $this->email->initialize($config);

        $this->email->from('webmaster@example.com', 'Web master');
        $this->email->to('pepe@example.com');
        $this->email->subject('Confirmación de registro de usuario');
        $this->email->message($body);
        $this->email->send();

        echo $this->email->print_debugger();
        exit();
    }
}
