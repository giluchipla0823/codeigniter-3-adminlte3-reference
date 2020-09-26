<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    const METHOD_POST = 'post';

    /**
     * Mostrar página de login.
     *
     */
    public function index(){
        if($this->input->method() === self::METHOD_POST && $this->authenticate()){
            redirect(base_url('dashboard'));
        }

        return $this->load->view('auth/login/index_view');
    }

    /**
     * Autenticación de usuarios.
     *
     */
    private function authenticate(){
        $request = $this->input->post();

        $email = $request['email'];
        $password = $request['password'];

        $this->setRules();

        if(!$this->form_validation->run()){
            return false;
        }

        $this->load->model('User_model');

        if(!$this->User_model->authenticate($email, $password)){
            $this->session->set_flashdata(
                'error_login',
                'Las credenciales de acceso no son correctas.'
            );

            return false;
        }

        return true;
    }

    /**
     * Reglas de validación de formulario de login.
     *
     */
    private function setRules(){
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'correo electrónico',
                'rules' => 'required|trim|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'required|trim'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message("valid_email", "El campo %s debe ser un email válido.");
        $this->form_validation->set_message("required", "El campo %s es requerido.");
    }
}