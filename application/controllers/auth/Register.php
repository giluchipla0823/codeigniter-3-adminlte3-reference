<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    const METHOD_POST = 'post';

    /**
     * Mostrar página de registro o crear usuario.
     *
     * @return mixed
     */
    public function index(){
        if($this->input->method() === self::METHOD_POST && $this->createUser()){
            return redirect(base_url('register'));
        }

        return $this->load->view('auth/register/index_view');
    }

    /**
     * Crear nuevo usuario.
     *
     * @return bool
     */
    private function createUser(){
        $request = $this->input->post();

        $this->setRules();

        if(!$this->form_validation->run()){
            return false;
        }

        $this->load->model('User_model');

        if(!$this->User_model->create($request)){
            $this->session->set_flashdata(
                'error_register_user',
                'Ocurrió un problema al registrar los datos del usuario.'
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
                'field' => 'first_name',
                'label' => 'nombres',
                'rules' => 'required|trim|max_length[100]'
            ),
            array(
                'field' => 'last_name',
                'label' => 'apellidos',
                'rules' => 'required|trim|max_length[100]'
            ),
            array(
                'field' => 'email',
                'label' => 'correo electrónico',
                'rules' => 'required|trim|valid_email|max_length[150]|is_unique[users.email]'
            ),
            array(
                'field' => 'username',
                'label' => 'usuario',
                'rules' => 'required|trim|min_length[6]|max_length[50]|is_unique[users.username]'
            ),
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'required|trim|min_length[6]|max_length[50]'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'confirmar contraseña',
                'rules' => 'required|trim|matches[password]'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message("valid_email", "El campo %s debe ser un email válido.");
        $this->form_validation->set_message("required", "El campo %s es requerido.");
        $this->form_validation->set_message("min_length", "El campo %s debe contener mínimo {param} caracteres.");
        $this->form_validation->set_message("max_length", "El campo %s debe contener máximo {param} caracteres.");
        $this->form_validation->set_message("matches", "Las contraseñas no coinciden.");
        $this->form_validation->set_message("is_unique", "El %s ya se encuentra en uso.");
    }
}