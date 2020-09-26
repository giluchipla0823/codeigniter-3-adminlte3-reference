<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    const USER_ACTIVATED = 1;
    const USER_DEACTIVATED = 0;

    /**
     * Autenticación de usuarios.
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
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

    /**
     * Crear nuevo usuario.
     *
     * @param array $data
     * @return bool
     */
    public function create($data){
        $data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' =>$this->encryption->encrypt($data['password'])
        );

        $query = $this->db->insert($this->table, $data);

        return (bool) $query;
    }
}