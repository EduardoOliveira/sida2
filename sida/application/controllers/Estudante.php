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
        if (empty($input['inicio']) && empty($input['fim'])) {
            $input['inicio'] = date('Y-m-d');
            $input['fim'] = date('Y-m-d');
        }
        if (!empty($input['module']) && $input['module'] !== "0" && !empty($input['fetch']) && $input['fetch'] === "fetch-sub") {
            $subModules = $this->SubModulo_model->getByModulo($input['module']);
        } else {
            $subModules = $this->SubModulo_model->getAll();
        }

        if (!empty($input['sub-model']) && !empty($input['fetch']) && $input['fetch'] === "fetch-parent") {
            $input['module'] = $this->SubModulo_model->getByDesignacao($input['sub-model'])->designacaoModulo;
        }

        $respostas = $this->Resposta_model->get($input,$this->session->user->emailPessoa,true);
        $this->load->view('commons/wrapper', [
            'main_content' => $this->load->view('estudante/main', [
                'filters' => $this->load->view('commons/filters', [
                    'modules' => $this->Modulo_model->getAll(),
                    'sub_modules' => $subModules,
                    'difficulties' => $this->NivelDificuldade_model->getAll(),
                    'input' => $input
                ], true),
                'table_content' => $respostas,
                'chart_content' => $this->mkcChartStats($respostas),
                'stats' => $this->mkStats($respostas)
            ], true)
        ]);
    }

    private function mkcChartStats($respostas)
    {
        $rtn = [];

        foreach ($respostas as $r) {
            $key = strtotime((new DateTime($r->dataResposta))->format('m/d/Y')) * 1000;
            if (empty($rtn[$key])) $rtn[$key] = ['total' => 0, 'certas' => 0];
            $rtn[$key]['total'] = $rtn[$key]['total'] + 1;
            if ($r->respostaEscolhida == $r->resposta)
                $rtn[$key]['certas'] = $rtn[$key]['certas'] + 1;
        }

        return $rtn;
    }

    private function mkStats($respostas)
    {
        $rtn = ['total' => 0, 'certas' => 0];
        foreach ($respostas as $r) {
            $rtn['total'] = $rtn['total'] + 1;
            if ($r->respostaEscolhida == $r->resposta)
                $rtn['certas'] = $rtn['certas'] + 1;
        }

        return $rtn;
    }
}
