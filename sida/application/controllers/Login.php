<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if($this->uri->segment($this->uri->total_segments())=="logout")return;

        if (isset($this->session->user->nome)) {
            if ($this->session->user->isEstudante == "1") {
                redirect('/estudante');
            } else {
                redirect('/docente');
            }
        }
        $this->load->model('Pessoa_model');
    }

    public function index()
    {
        $this->load->view('login/login', ['login_error' => $this->session->login_error]);
    }

    public function submit()
    {
        $user = $this->Pessoa_model->loginUser($this->input->post('email'), $this->input->post('password'))[0];
        if (empty($user->emailPessoa)) {
            $this->session->login_error = ['reason' => 'Invalid email or password!'];
        } else {
            $this->session->user = $user;
            $this->session->login_error = [];
        }

        redirect('/login');
    }

    public function logout()
    {
        $this->session->user = null;
        redirect('/login');
    }
}
