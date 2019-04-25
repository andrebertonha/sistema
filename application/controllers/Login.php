<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model('usuarios_model');
    }

    public function index()
    {           
        $this->load->view('login');        
    }
    
    public function login(){
        $email = $this->input->post('email');
        $senha = md5($this->input->post('senha'));        
        $usuario = $this->usuarios_model->logar($email, $senha);        
        if($usuario) {
            $this->session->set_userdata('usuario_logado', $usuario);
            redirect('listagem_clientes');
        }
        else {
            $this->session->set_flashdata('msg', 'Usuário ou senha inválidos');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('usuario_logado');
        redirect('login');
    }

    public function recuperarSenha(){
        
        $email = $this->input->post('emailRecSenha');
        $usuario = $this->usuarios_model->get_by('email_usuario',$email);
        if(!$usuario){
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'sistemaloginandre@gmail.com',
                'smtp_pass' => 'sistemalogin',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('andrebertonhadev@gmail.com', 'sistema login');
            $this->email->to($email);
            $this->email->subject('Recuperar Senha - Sistema Login');
            $this->email->message('Segue a senha referente ao usuario cadastrado com o email: '.$email.' Senha: '.$usuario['senha_no_crip']);
            $this->email->send();
            $this->session->flashdata('msg', 'e-mail para enviar senha foi enviado');
            redirect('login');
        } else {
            $this->session->flashdata('o e-mail para recuperar sua senha deve ser de um usuário já cadastrado no sistema');
            redirect('login');
        }
    }
}
 