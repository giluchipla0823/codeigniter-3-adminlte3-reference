<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activate_account extends CI_Controller
{
    public function index(){
        if(!$token = $this->input->get('token')){
            throw new Exception('El token no ha sido proporcionado para activar la cuenta', 400);
        }

        $this->load->model('User_model');

        if(!$user = $this->User_model->getUserWithToken($token)){
            throw new Exception('No se ha encontrado el usuario.', 404);
        }

        $this->User_model->updateVerifiedUser($user->id);

        echo "Cuenta activada correctamente.";
        exit();
    }
}