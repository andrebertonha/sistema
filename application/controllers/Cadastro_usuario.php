<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_Usuario extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('estado_model');
        $this->load->model('cidade_model');
        $this->load->model('usuarios_model');
        $this->load->library('form_validation');
    }
    
    public function index() {
        $dados['states'] = $this->estado_model->getAll();
        $this->load->view('cadastro_usuario', $dados);
    }

    public function registrar() {
        $this->form_validation->set_rules('nome','nome','required');
        $this->form_validation->set_rules('email','email','required|is_unique[usuarios.email_usuario]');
        $this->form_validation->set_rules('senha','senha','required|callback_valida_password');
        $this->form_validation->set_rules('sexo','sexo','required');
        $this->form_validation->set_rules('telefone','telefone','required');
        $this->form_validation->set_rules('estados','estados','required');
        $this->form_validation->set_rules('cidades','cidades','required');
        $this->form_validation->set_rules('situacao','situacao','required');        
        if (!$this->form_validation->run())
        {            
            $this->session->set_flashdata('msg', validation_errors());            
            redirect('cadastro_usuario');
        } else {
            $this->usuarios_model->insert_user();
            redirect('login');
        }        
    }    
    
    public function listar_usuarios() {        
        $get_users['users'] = $this->usuarios_model->get_all();        
        $this->load->view('listar_usuarios', $get_users);
    }        

    public function editar($idUsuario) {        
        $usuario['dados_usuario'] = $this->usuarios_model->get_by('id_usuario',$idUsuario);      
        $this->load->view('editar_usuario',$usuario);
    }    
    
    public function update() {        
        $this->form_validation->set_rules('nome','nome','required');
        $this->form_validation->set_rules('email','email','required');
        $this->form_validation->set_rules('senha','senha','required');
        $this->form_validation->set_rules('sexo','sexo','required');
        $this->form_validation->set_rules('telefone','telefone','required');
        $this->form_validation->set_rules('estados','estados','required');
        $this->form_validation->set_rules('cidades','cidades','required');
        $this->form_validation->set_rules('situacao','situacao','required');
        
        if($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', validation_errors());            
            $this->editar();
        }            
        else {                        
            $this->usuarios_model->update_user($this->input->post('id_usuario'));
            redirect('cadastro_usuario/listar_usuarios');
        }        
    }
    
    public function deletar($idUsuario) {        
        if($this->usuarios_model->delete_by('id_usuario',$idUsuario)) {
            $this->session->set_flashdata('msg','usuario deletado');
            redirect('cadastro_usuario/listar_usuarios');
        }        
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
    
    public function valida_password($senha)
    {   
        $password = trim($senha);        
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'O campo de senha deve ser preenchido.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'O campo de senha deve ter pelo menos uma letra minúscula.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'O campo de senha deve ter pelo menos uma letra maiúscula.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'O campo de senha deve ter pelo menos um numero..');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'O campo de senha deve ter pelo menos um caracter especial.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        } 
        return TRUE;
    }
 
}