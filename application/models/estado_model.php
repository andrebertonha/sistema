<?php

class estado_model extends MY_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function getAll() {
        return $this->db->order_by('nome')->get('estado');
    }
    
    public function getEstadoNome() {        
        $id_estado = $this->input->post('estados');        
        $estados = $this->getAll();
        foreach($estados -> result() as $estado){
            if($estado->id == $id_estado) {
                $nomeEstado = $estado->nome;
            }
        }
        return $nomeEstado;
    }    
}
