<?php

class Cidade extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->model('cidade_model');
    }
    
    public function getCidades() {        
        $id_estado = $this->input->post('id_estado');
        $id_cidade = $this->input->post('id_cidade');
        echo $this->cidade_model->getCidadesByIdEstado($id_estado, $id_cidade);
    }
}
