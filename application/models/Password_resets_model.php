<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password_resets_model extends CI_Model
{
    protected $table = 'password_resets';

    /**
     * Obtener información para cambiar contraseña.
     *
     * @param $filters
     * @return object|null
     */
    public function find($filters){
        $this->db->where($filters);

        $query = $this->db->get($this->table);

        if(!$query){
            return null;
        }

        return $query->row();
    }

    /**
     * Crear nuevo registro para cambiar contraseña.
     *
     * @param string $email
     * @return bool|object
     */
    public function create($email){
        $token = generate_random_string(255);

        $data = array(
            'email' => $email,
            'token' => $token
        );

        $query = $this->db->insert($this->table, $data);

        if(!$query){
            return false;
        }

        return $this->find(array(
            'email' => $email,
            'token' => $token
        ));
    }
}