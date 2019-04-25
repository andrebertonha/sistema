<?php
class usuarios_model extends MY_Model {    
    public $_table = 'usuarios';
    public $primary_key = 'id_usuario';
    protected $return_type = 'array';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function insert_user() {
        $nome_estado = $this->estado_model->getEstadoNome();
        $nome_cidade = $this->cidade_model->getCidadeNome();        
        $dados = array(
            "nome_usuario"=> $this->input->post('nome'),
            "email_usuario"=> $this->input->post('email'),
            "senha_usuario"=> md5($this->input->post('senha')),
            "senha_no_crip"=> $this->input->post('senha'),
            "key_usuario"=>sha1(time().date('Ymd').md5(time())),
            "situacao"=> $this->input->post('situacao'),
            "sexo"=> $this->input->post('sexo'),
            "estado"=> $nome_estado,
            "cidade"=> $nome_cidade,
            "telefone"=> $this->input->post('telefone'),
            "id_estado"=>  $this->input->post('estados'),
            "id_cidade"=> $this->input->post('cidades')
        );        
        if(!$this->db->insert('usuarios',$dados)) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect('cadastro_usuario');
        } else {            
            $this->session->set_flashdata('msg','usuário cadastrado');
        }        
    }
    
    public function update_user($id) {
        
        $nome_estado = $this->estado_model->getEstadoNome();
        $nome_cidade = $this->cidade_model->getCidadeNome();
        $dados = array(
            "nome_usuario"=> $this->input->post('nome'),
            "email_usuario"=> $this->input->post('email'),
            "situacao"=> $this->input->post('situacao'),
            "sexo"=> $this->input->post('sexo'),
            "estado"=>  $nome_estado,
            "cidade"=>  $nome_cidade,
            "telefone"=> $this->input->post('telefone'),
            "id_estado"=> $this->input->post('estados'),
            "id_cidade"=> $this->input->post('cidades')
        );
        if(!$id) {
            $this->session->set_flashdata('msg', validation_errors());
            redirect('listar_usuarios');
        } else {
            $this->db->where('id_usuario',$id);
            $this->db->update('usuarios', $dados);
            $this->session->set_flashdata('msg', 'usuário atualizado');
        }
    }  
    
    public function logar($email, $senha) {
        $this->db->where('email_usuario', $email);
        $this->db->where('senha_usuario', $senha);
        $usuario = $this->db->get('usuarios')->row_array();        
        return $usuario;
    }
}
