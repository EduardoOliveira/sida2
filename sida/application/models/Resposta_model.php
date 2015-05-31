<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resposta_model extends CI_Model
{

    public $idQuestao;
    public $emailPessoa;
    public $id;
    public $respostaEscolhida;
    public $dataResposta;
    public $ultimaModificacao;
    public $texto;
    public $resposta;
    public $explicacao;
    public $linkFicheiro;
    public $idNivel;
    public $designacaoModulo;
    public $designacaoSubModulo;
    public $emailPessoaPergunta;
    public $idPergunta;
    public $ultimaModificacaoPergunta;

    private $table = "Resposta";

    public function get($p, $email, $isEstudante)
    {
        $where = [];

        if (!empty($p['module'])) $where['designacaoModulo'] = $p['module'];
        if (!empty($p['sub-model'])) $where['designacaoSubModulo'] = $p['sub-model'];
        if (!empty($p['difficulty'])) $where['Questao.idNivel'] = $p['difficulty'];
        if (!empty($p['inicio']) && !empty($p['fim']) && $p['inicio'] != $p['fim']) {
            $where['dataResposta >= '] = $p['inicio'];
            $where['dataResposta <= '] = $p['fim'];
        }
        if ($isEstudante) {
            $where['Resposta.emailPessoa'] = $email;
        }

        $this->db->select('Resposta.*,
                            Questao.texto,
                            Questao.resposta,
                            Questao.explicacao,
                            Questao.linkFicheiro,
                            Questao.idNivel,
                            Questao.designacaoModulo,
                            Questao.designacaoSubModulo,
                            Questao.emailPessoa as emailPessoaCriador,
                            Questao.id as idCriador,
                            Questao.ultimaModificacao as ultimaModificacaoPergunta,
                            NivelDificuldade.*,
                            Pessoa.nome', false);
        $this->db->from($this->table);
        $this->db->join('Questao', 'Resposta.idQuestao = Questao.idQuestao');
        $this->db->join('NivelDificuldade', 'NivelDificuldade.idNivel = Questao.idQuestao');
        $this->db->join('Pessoa', 'Pessoa.emailPessoa = Resposta.emailPessoa');
        $this->db->where($where);
        $rtn = $this->db->get()->result();
        foreach ($rtn as &$r) {
            $r->media = $this->media($r->emailPessoa, $r->designacaoModulo);
        }
        return $rtn;
    }

    public function media($aluno, $modulo)
    {
        $this->db->select('Resposta.*,
                            Questao.texto,
                            Questao.resposta,
                            Questao.explicacao,
                            Questao.linkFicheiro,
                            Questao.idNivel,
                            Questao.designacaoModulo,
                            Questao.designacaoSubModulo,
                            Questao.emailPessoa as emailPessoaCriador,
                            Questao.id as idCriador,
                            Questao.ultimaModificacao as ultimaModificacaoPergunta,
                            NivelDificuldade.*,
                            Pessoa.nome', false);
        $this->db->from($this->table);
        $this->db->join('Questao', 'Resposta.idQuestao = Questao.idQuestao');
        $this->db->join('NivelDificuldade', 'NivelDificuldade.idNivel = Questao.idQuestao');
        $this->db->join('Pessoa', 'Pessoa.emailPessoa = Resposta.emailPessoa');
        $this->db->where([
            'Resposta.emailPessoa' => $aluno,
            'Questao.designacaoModulo' => $modulo
        ]);
        $result = $this->db->get()->result();
        if (count($result) <= 1)
            return "NA";

        $certas = 0;

        foreach ($result as $r) {
            if ($r->respostaEscolhida == $r->resposta)
                $certas++;
        }

        return $certas / count($result);
    }

}