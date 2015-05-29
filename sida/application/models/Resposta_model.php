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

    public function get($p)
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
                            NivelDificuldade.*', false);
        $this->db->from($this->table);
        $this->db->join('Questao', 'Resposta.idQuestao = Questao.idQuestao');
        $this->db->join('NivelDificuldade', 'NivelDificuldade.idNivel = Questao.idQuestao');
        return $this->db->get()->result();
    }

}