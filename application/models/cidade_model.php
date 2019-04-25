<?php
class cidade_model extends MY_Model {    
    public function __construct() {
        parent::__construct();
    }
    
    public function getCidadesByIdEstado($id_estado, $id_cidade) {        
        $cidades = $this->db->where("estado", $id_estado)->order_by('nome')->get('cidade');
        $options = "<option>Selecione a Cidade</option>";
        foreach($cidades->result() as $cidade) {
            $options .= '<option'.(($cidade->id == $id_cidade)?' selected="selected"':'').' value="'.$cidade->id.'">'.$cidade->nome.'</option>';            
        }
        return $options;
    }
    
    public function getAll() {
        return $this->db->order_by('nome')->get('cidade');
    }    
    
    public function getCidadeNome() {
        $id_cidade = $this->input->post('cidades');        
        $nomeCidade = $this->db->select('nome')->from('cidade')->where("id", $id_cidade)->get()->row('nome');
        return $nomeCidade;        
    }    
}

