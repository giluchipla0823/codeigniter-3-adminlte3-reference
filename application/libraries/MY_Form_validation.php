<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
//    public function is_exists($str)
//    {
//        if ($str != 'webmaster@gmail.com')
//        {
//            $this->CI->form_validation->set_message('is_exists', 'The {field} field can not be the word "webmaster@gmail.com"');
//            return false;
//        }
//        else
//        {
//            return true;
//        }
//    }

    public function is_exists($str, $field)
    {
        sscanf($field, '%[^.].%[^.]', $table, $field);
        return isset($this->CI->db)
            ? ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() > 0)
            : FALSE;
    }
}