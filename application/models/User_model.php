<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function authenticate($email, $password){
        $this->db->where(array(
            'email' => $email
        ));

        $query = $this->db->get($this->table);

        if(!$query){
            return false;
        }

        $row = $query->row();

        if(!$row){
            return false;
        }

        if($this->encryption->decrypt($row->password) !== $password){
            return false;
        }

        $name = $row->name;
        $lastName = $row->lastname;

        $data = array(
            'isLogged' => TRUE,
            'user' => array(
                'id' => $row->id,
                'name' => $name,
                'last_name' => $lastName,
                'full_name' => $name . ' ' . $lastName,
                'email' => $email,
            )
        );

        $this->session->set_userdata($data);

        return true;
    }
}