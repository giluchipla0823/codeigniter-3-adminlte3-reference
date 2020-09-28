<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recover_password extends CI_Controller
{
    const METHOD_POST = 'post';

    public function index(){
        $this->load->model('Password_resets_model');

        if(!$token = $this->input->get('token')){
            show_404();
        }

        if(!$model = $this->Password_resets_model->find(array('token' => $token))){
            throw new Exception(
                'No existe una solicitud de cambio de contraseña con el token proporcionado',
                400
            );
        }

        if($this->input->method() === self::METHOD_POST && $this->processedForm($model)){
            return redirect(base_url('recover-password') . "?token={$token}");
        }

        return $this->load->view('auth/recover_password/index_view');
    }

    private function processedForm($model){
        $password = $this->input->post('password');

        $this->setRules();

        if(!$this->form_validation->run()){
            return false;
        }

        $this->load->model('User_model');

        if(!$this->User_model->updatePassword($model->email, $password)){
            $this->session->set_flashdata(
                'error',
                'Ocurrió un problema al actualizar la contraseña del usuario.'
            );

            return false;
        }

        $this->session->set_flashdata(
            'success',
            "Tu contraseña se cambió correctamente."
        );

        return true;
    }



    /**
     * Reglas de validación.
     *
     * @return void
     */
    private function setRules(){
        $rules = array(
            array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'confirmar contraseña',
                'rules' => 'required|trim|matches[password]'
            )
        );

        $this->form_validation->set_rules($rules);
    }

}