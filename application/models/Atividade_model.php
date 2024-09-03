<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Atividade_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function carregar($usuario_id)
    {
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('atividades');
        return $query->result_array();
    }


    public function criar($data)
    {
        return $this->db->insert('atividades', $data);
    }

    public function editar($atividade_id, $usuario_id)
    {
        $query = $this->db->get_where('atividades', ['id' => $atividade_id, 'usuario_id' => $usuario_id]);
        return $query->row_array();
    }

    public function update_atividade($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('atividades', $data);
    }

    public function deletar($atividade_id, $usuario_id)
    {
        $this->db->where('id', $atividade_id);
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->delete('atividades');
    }


    public function get_all_atividades()
    {
        $query = $this->db->get('atividades');
        return $query->result_array();
    }

    public function get_atividades_by_usuario_id($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        $query = $this->db->get('atividades');
        return $query->result();
    }

    public function get_atividade_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('atividades');
        return $query->row();
    }

}
