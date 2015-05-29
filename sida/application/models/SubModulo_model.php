<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubModulo_model extends CI_Model
{

    public $designacaoModulo;
    public $designacaoSubModulo;
    public $emailPessoa;
    public $id;
    public $ultimaModificacao;

    private $table = "SubModulo";

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getByModulo($designacaoModulo)
    {
        return $this->db->get_where($this->table, ['designacaoModulo'=>$designacaoModulo])->result();
    }

    public function getByDesignacao($designacao){
        return $this->db->get_where($this->table,['designacaoSubModulo'=>$designacao])->result()[0];
    }

}