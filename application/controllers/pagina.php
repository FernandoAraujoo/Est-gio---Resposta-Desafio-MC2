<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagina extends CI_Controller
{
    public function __construct()
    {
        error_reporting(E_ALL & ~E_DEPRECATED);
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Usuario_model');
        $this->load->model('Atividade_model');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        $dados['titulo'] = "Página de login";
        $this->load->view('login', $dados);

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $login = $this->input->post('login');
            $senha = $this->input->post('senha');
            $user = $this->Usuario_model->get_user_by_login($login);

            if ($user && password_verify($senha, $user['senha'])) {
                $this->session->set_userdata('usuario_id', $user['id']);
                redirect('pagina/atividades');
            } else {
                $dados['error'] = "Usuário ou senha incorretos.";
                $this->load->view('login', $dados);
            }
        }
    }

    public function cadastrar()
    {
        $dados['titulo'] = "Página de cadastro";
        $this->load->view('cadastrar', $dados);

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $login = $this->input->post('login');
            $senha1 = $this->input->post('senha');
            $senha2 = $this->input->post('senha2');

            if ($this->Usuario_model->get_user_by_login($login)) {
                $dados['error'] = "Este nome de usuário já foi cadastrado.";
            } elseif ($senha1 !== $senha2) {
                $dados['error'] = "As senhas estão diferentes.";
            } else {
                $senha = password_hash($senha1, PASSWORD_DEFAULT);
                if ($this->Usuario_model->create_user($login, $senha)) {
                    $dados['success'] = "Cadastro realizado com sucesso! Aperte em login para entrar em sua conta.";
                } else {
                    $dados['error'] = "Erro ao cadastrar usuário.";
                }
            }
            $this->load->view('cadastrar', $dados);
        }
    }

    public function atividades()
    {
        if (!$this->session->userdata('usuario_id')) {
            redirect('pagina/login');
        }

        $dados['titulo'] = "Painel de Atividades";
        $usuario_id = $this->session->userdata('usuario_id');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $atividade_data = [
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim'),
                'status' => $this->input->post('status'),
                'usuario_id' => $usuario_id
            ];

            if ($this->Atividade_model->criar($atividade_data)) {
                $dados['success'] = "Atividade cadastrada com sucesso!";
            } else {
                $dados['error'] = "Erro ao cadastrar atividade.";
            }
        }

        $dados['atividades'] = $this->Atividade_model->carregar($usuario_id);
        $this->load->view('atividades', $dados);
    }

    public function editar($id)
    {
        $this->load->model('atividade_model');
        $atividade = $this->atividade_model->get_atividade_by_id($id);

        $data = array(
            'id' => $atividade->id,
            'nome' => $atividade->nome,
            'descricao' => $atividade->descricao,
            'status' => $atividade->status,
            'data_inicio' => $atividade->data_inicio,
            'data_fim' => $atividade->data_fim
        );

        $this->load->view('editar', $data);
    }

    public function deletar($atividade_id)
    {
        if (!$this->session->userdata('usuario_id')) {
            redirect('pagina/login');
        }

        $usuario_id = $this->session->userdata('usuario_id');
        if ($this->Atividade_model->deletar($atividade_id, $usuario_id)) {
            $dados['success'] = "Atividade deletada com sucesso!";
        } else {
            $dados['error'] = "Erro ao deletar atividade.";
        }
        redirect('pagina/atividades');
    }

    public function carregar()
    {
        $this->load->model('atividade_model');
        $usuario_id = $this->session->userdata('usuario_id');
        $atividades = $this->atividade_model->get_atividades_by_usuario_id($usuario_id);

        $eventos = array();
        foreach ($atividades as $atividade) {
            $eventos[] = array(
                'id' => $atividade->id,
                'title' => $atividade->nome,
                'description' => $atividade->descricao,
                'start' => $atividade->data_inicio,
                'end' => $atividade->data_fim,
                'status' => $atividade->status
            );
        }

        echo json_encode($eventos);
    }

    public function atualizar($id)
    {
        $this->load->model('atividade_model');

        $data = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
            'status' => $this->input->post('status'),
            'data_inicio' => $this->input->post('data_inicio'),
            'data_fim' => $this->input->post('data_fim')
        );

        $this->atividade_model->update_atividade($id, $data);
        redirect('pagina/atividades');
    }
}
