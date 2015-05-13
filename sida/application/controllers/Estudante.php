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
    }

    public function index()
    {
        $this->load->view('commons/wrapper',['main_content'=>$this->load->view('estudante/main',[],true)]);
    }

}
