<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends CI_Controller
{
    const METHOD_POST = 'post';

    public function index(){
        if($this->input->method() === self::METHOD_POST && $this->processedForm()){
            return redirect(base_url('forgot-password'));
        }

        return $this->load->view('auth/forgot_password/index_view');
    }

    private function processedForm(){
        $email = $this->input->post('email');

        $this->setRules();

        if(!$this->form_validation->run()){
            return false;
        }

        $this->load->model('Password_resets_model');

        if(!$model = $this->Password_resets_model->create($email)){
            $this->session->set_flashdata(
                'error',
                'Ocurrió un problema al generar el token de acceso para recuperar contraseña.'
            );

            return false;
        }

        if(!$this->sendEmail($model)){
            $this->session->set_flashdata(
                'error',
                'Ocurrió un problema al enviar el email para recuperar contraseña.'
            );

            return false;
        }

        $this->session->set_flashdata(
            'success',
            "El email ingresado es correcto. Se te ha enviado un email para recuperar tu contraseña."
        );

        return true;
    }

    private function sendEmail($model){
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
            'emails/auth/recover_password_email_view',
            array('model' => $model),
            TRUE
        );

        $this->email->initialize($config);
        $this->email->from('webmaster@example.com', 'Web master');
        $this->email->to($model->email);
        $this->email->subject('Recuperar contraseña');
        $this->email->message($body);

        return $this->email->send();
    }

    /**
     * Reglas de validación.
     *
     * @return void
     */
    private function setRules(){
        $rules = array(
            array(
                'field' => 'email',
                'label' => 'correo electrónico',
                'rules' => 'required|trim|valid_email|is_exists[users.email]'
            )
        );

        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('is_exists', 'El %s ingresado no existe.');
    }

}