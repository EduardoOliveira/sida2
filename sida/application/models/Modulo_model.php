<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo_model extends CI_Model
{

    public $designacaoModulo;
    public $emailPessoa;
    public $id;
    public $ultimaModificacao;

    private $table = "Modulo";

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

}