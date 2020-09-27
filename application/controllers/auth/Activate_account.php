<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activate_account extends CI_Controller
{
    public function index(){
        if(!$token = $this->input->get('token')){
            throw new Exception(
                'El token no ha sido proporcionado para activar la cuenta,',
                400
            );
        }

        $this->load->model('User_model');

        if(!$user = $this->User_model->findByToken($token)){
            throw new Exception("El usuario no ha sido encontrado.", 404);
        }

        $this->User_model->markAsVerified($user->id);

        echo "Cuenta activada correctamente...";

        header( "Refresh:5; url=" . base_url('login'));
        exit();
    }
}