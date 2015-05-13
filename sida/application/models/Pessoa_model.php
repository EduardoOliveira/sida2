<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa_model extends CI_Model
{

    public $isEstudante;
    public $nome;
    public $senha;
    public $emailPessoa;
    public $ultimaModificacao;

    private $table = "Pessoa";

    public function loginUser($email, $password)
    {
        return $this->db->get_where($this->table, ['emailPessoa' => $email, 'senha' => md5($password)], 1, 0)->result();
    }

}