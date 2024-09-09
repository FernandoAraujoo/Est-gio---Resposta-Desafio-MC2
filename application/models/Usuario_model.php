<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_user_by_login($login)
    {
        $query = $this->db->get_where('usuarios', ['login' => $login]);
        return $query->row_array();
    }

    public function create_user($login, $senha)
    {
        $data = [
            'login' => $login,
            'senha' => $senha
        ];
        return $this->db->insert('usuarios', $data);
    }
}
