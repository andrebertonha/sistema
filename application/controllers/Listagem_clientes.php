<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listagem_Clientes extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('estado_model');
        $this->load->model('cidade_model');        
        $this->load->model('clientes_model');
        $this->load->library('form_validation');
    }
    
    public function index() { 
        $get_clients['clients'] = $this->clientes_model->get_all();
        $this->load->template('listar_clientes', $get_clients);        
    }     
    
    public function carregar_form_cadastro() {
        $dados['states'] = $this->estado_model->getAll();        
        $this->load->template('cadastro_cliente', $dados);        
    }
        
    public function cadastrar() {        
        $this->form_validation->set_rules('nome','nome','required');
        $this->form_validation->set_rules('email','email','required|is_unique[clientes.email_cliente]');  
        $this->form_validation->set_rules('cnpj', 'cnpj', 'required');
        $this->form_validation->set_rules('estados','estados','required');
        $this->form_validation->set_rules('cidades','cidades','required');
        $this->form_validation->set_rules('situacao','situacao','required');
        if (!$this->form_validation->run())
        {               
            $this->session->set_flashdata('msg', validation_errors());            
            redirect('listagem_clientes/carregar_form_cadastro');
        } else {
            $this->clientes_model->insert_client();
            redirect('listagem_clientes');
        }  
    }
    
    public function editar($idCliente) {
        $cliente['dados_cliente'] = $this->clientes_model->get_by('id_cliente',$idCliente);
        $this->load->template('editar_cliente',$cliente);
    }
    
    public function update() {        
        $this->form_validation->set_rules('nome','nome','required');
        $this->form_validation->set_rules('email','email','required');
        $this->form_validation->set_rules('cnpj', 'cnpj', 'required');
        $this->form_validation->set_rules('estados','estados','required');        
        $this->form_validation->set_rules('cidades','cidades','required');
        $this->form_validation->set_rules('situacao','situacao','required');
        
        if(!$this->form_validation->run()) {
            $this->session->set_flashdata('msg', validation_errors());            
            $this->editar();
        }            
        else {                        
            $this->clientes_model->update_client($this->input->post('id_cliente'));
            redirect('listagem_clientes/editar');
        }  
    }
    
    public function deletar($idCliente) {        
        if($this->clientes_model->delete_by('id_cliente',$idCliente)) {
            $this->session->set_flashdata('msg','cliente deletado');
            redirect('listagem_clientes');
        }
    }        
}