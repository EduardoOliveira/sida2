<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NivelDificuldade_model extends CI_Model
{

    public $designacaoNivel;
    public $idNivel;
    public $ultimaModificacao;

    private $table = "NivelDificuldade";

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

}