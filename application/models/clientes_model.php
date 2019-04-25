<?php
class clientes_model extends MY_Model {
    
    public $_table = 'clientes';
    public $primary_key = 'id_cliente';
    protected $return_type = 'array';
    
    public function __construct() {
        parent::__construct();
    } 
    
    public function insert_client() {
        
        $nome_estado = $this->estado_model->getEstadoNome();
        $nome_cidade = $this->cidade_model->getCidadeNome();        
        
        $dados = array(
            "nome_cliente" => $this->input->post('nome'),
            "email_cliente" => $this->input->post('email'),
            "cnpj" => $this->input->post('cnpj'),
            "telefone" => $this->input->post('telefone'),
            "site" => $this->input->post('site') == 'on' ? 1 : 0,
            "bocaboca" => $this->input->post('bocaboca') == 'on' ? 1 : 0,
            "facebook" => $this->input->post('face') == 'on' ? 1 : 0,
            "indicacao" => $this->input->post('indica') == 'on' ? 1 : 0,
            "estado" => $nome_estado,
            "cidade" => $nome_cidade,
            "situacao" => $this->input->post('situacao'),
            "observacao" => $this->input->post('obs'),
            "id_estado" => $this->input->post("estados"),
            "id_cidade" => $this->input->post("cidades")
        );
        
        if(!$this->db->insert('clientes',$dados)) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect('listagem_clientes/carregar_form_cadastro');
        } else {            
            $this->session->set_flashdata('msg','cliente cadastrado');
            redirect('listagem_clientes');
        }
    }
    
    public function update_client($id) {
        $nome_estado = $this->estado_model->getEstadoNome();
        $nome_cidade = $this->cidade_model->getCidadeNome();                
        
        $dados = array(
            "nome_cliente"=> $this->input->post('nome'),
            "email_cliente"=> $this->input->post('email'),
            "cnpj"=> $this->input->post('cnpj'),
            "telefone"=> $this->input->post('telefone'),
            "site" => $this->input->post('site') == 'on' ? 1 : 0,
            "bocaboca" => $this->input->post('bocaboca') == 'on' ? 1 : 0,
            "facebook" => $this->input->post('face') == 'on' ? 1 : 0,
            "indicacao" => $this->input->post('indica') == 'on' ? 1 : 0,
            "estado"=>  $nome_estado,
            "cidade"=>  $nome_cidade,
            "situacao"=> $this->input->post('situacao'),
            "observacao"=> $this->input->post('obs'),
            "id_estado"=> $this->input->post("estados"),
            "id_cidade"=> $this->input->post("cidades")
        );        
        
        if(!$id) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect('listagem_cliente/editar');
        } else {
            $this->db->where('id_cliente',$id);
            $this->db->update('clientes', $dados);
            $this->session->set_flashdata('msg', 'cliente atualizado');
            redirect('listagem_clientes');
        }        
    }    
}
