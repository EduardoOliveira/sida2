<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudante extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->user->nome) || $this->session->user->isEstudante != "1") {
            redirect('/login');
        }
        $this->load->model('Modulo_model');
        $this->load->model('NivelDificuldade_model');
        $this->load->model('SubModulo_model');
        $this->load->model('Resposta_model');
    }

    public function index()
    {
        $input = $this->input->post();

        if (!empty($input['module']) && $input['module'] !== "0" && !empty($input['fetch']) && $input['fetch'] === "fetch-sub") {
            $subModules = $this->SubModulo_model->getByModulo($input['module']);
        } else {
            $subModules = $this->SubModulo_model->getAll();
        }

        if (!empty($input['sub-model']) && !empty($input['fetch']) && $input['fetch'] === "fetch-parent") {
            $input['module'] = $this->SubModulo_model->getByDesignacao($input['sub-model'])->designacaoModulo;
        }
        $this->load->view('commons/wrapper', [
            'main_content' => $this->load->view('estudante/main', [
                'filters' => $this->load->view('commons/filters', [
                    'modules' => $this->Modulo_model->getAll(),
                    'sub_modules' => $subModules,
                    'difficulties' => $this->NivelDificuldade_model->getAll(),
                    'input' => $input
                ], true),
                'table_content'=>$this->Resposta_model->get($input)
            ], true)
        ]);
    }

}
