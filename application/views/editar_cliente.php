<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistema de Login</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrapLayout.css";?>">
<script type="text/javascript">
$(document).ready(function(){    
    var base_url = "<?php echo base_url(); ?>";        
    $(function(){
       $('#estados').on('change', function(){           
            var id_estado = $('#estados').val();
            var id_cidade = $('#cidades').attr('data-atual');
            $.ajax({
                type: 'POST',
                url: base_url + "ajax/Cidade/getCidades",
                data: {id_estado:id_estado, id_cidade:id_cidade},
                success:function(data) {                    
                    $('#cidades').html(data);
                    $('#cidades').removeAttr('disabled');                        
                },
                error:function(data) {
                  console.log(data);
                }
            });            
       }).change();
    });
//    $.ajax({
//        type: "POST",
//        url: "index",
//        dataType: 'json',
//        data: {
//            'site': $('#site').prop('checked'),
//            'facebook': $('#bocaboca').prop('checked'),
//            'bocaboca': $('#facebook').prop('checked'),
//            'indicacao': $('#indicacao').prop('checked')
//        }
//    });            
//    $.ajax({
//        type: "POST",
//        url: "update",
//        dataType: 'json',
//        data: {
//            'situacao': $('#situacao').value               
//        }        
//    });
    $('#telefone').mask('(00) 00000-0000');
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});    
});
</script>
</head>
<body>
    <div class="container">
        <div class="form-group">            
            <h3>Editar cliente</h3>
            <?php                 
                if ($this->session->flashdata('msg')){
                    echo '<div class="alert alert-danger">';
                    echo $this->session->flashdata('msg');
                    echo "</div>";
                } 
                
                echo form_open('listagem_clientes/update/');
                ?>
                <div class="form-group">
                    <?php 
                        echo form_label('Nome');
                        echo form_input('nome', set_value('nome', $dados_cliente['nome_cliente']),'class="form-control"');
                        echo form_error('nome');
                    ?>
                </div>
                <div class="form-group">
                    <?php 
                        echo form_label('Email');
                        echo form_input('email', set_value('email', $dados_cliente['email_cliente']),'class="form-control"');
                        echo form_error('email');
                    ?>
                </div>
                <div class="form-group">
                    <?php 
                        $attributes = array(
                            'class' => 'form-control',                        
                            'id'    => 'cnpj'
                        );
                        echo form_label('Cnpj');
                        echo form_input('cnpj', set_value('cnpj', $dados_cliente['cnpj']),$attributes);
                        echo form_error('cnpj');
                    ?>
                </div>
                <div class="form-group">
                    <?php 
                        $attributes = array(
                            'class' => 'form-control',                        
                            'id'    => 'telefone'
                        );
                        echo form_label('Telefone');
                        echo form_input('telefone', set_value('telefone', $dados_cliente['telefone']),$attributes);
                        echo form_error('telefone');
                    ?>
                </div>
                
                <fieldset>
                    <label>Origem</label>
                    <div class="form-group">
                        <input type="checkbox" name="site" <?php if($dados_cliente['site'] == 1) echo 'checked';?>> Site
                        <input type="checkbox" name="bocaboca"  <?php if($dados_cliente['bocaboca'] == 1) echo 'checked';?>> Boca a Boca
                        <input type="checkbox" name="face"  <?php if($dados_cliente['facebook'] == 1) echo 'checked';?>> Facebook
                        <input type="checkbox" name="indica"  <?php if($dados_cliente['indicacao'] == 1) echo 'checked';?> > Indicação
                    </div>
                </fieldset>                
                <div class="form-group">
                    <label for="estados">Estado</label>
                    <option>Selecione o Estado</option>
                    <select id="estados" name="estados" class="form-control" required>
                    <?php
                        $this->load->model('estado_model');
                        $estados = $this->estado_model->getAll();                        
                        foreach($estados->result() as $estado) {
                    ?>
                            <option value="<?php echo $estado->id;?>" <?php if($estado->nome == $dados_cliente['estado']) echo 'selected="selected"'; else echo ''; ?>> <?php echo $estado->nome; ?></option>    
                    <?php } ?>
                    </select>                        
                </div>                
                <div class="form-group">
                    <label for="cidades">Cidade</label>
                    <select id="cidades" name="cidades" class="form-control" data-atual="<?php echo $dados_cliente['id_cidade']?>">                   
                    </select>                        
                </div>                
                <div class="form-group">
                    <label for="situacao">Situação</label>
                    <?php
                        $situacao = array(
                            "1"=>"Ativo",
                            "0"=>"Inativo"
                        );	
                        $valor_situacao = $dados_cliente['situacao'] == 1 ?  'S' :  'N';
                        echo form_dropdown('situacao',$situacao, set_value('situacao',$valor_situacao), 'class="form-control"');
                        echo form_error('situacao');
                    ?>
                </div>
                <div class="form-group">
                    <?php 
                        echo form_label('Observacoes','obs');
                        echo form_textarea('obs', set_value('obs', $dados_cliente['observacao']), 'class="form-control"');
                        echo '<p class="help-block">Fale sobre você</p>';
                        echo form_error('obs');
                    ?>
		</div>
                <div class="form-group">
                    <?php 
                        echo form_hidden('id_cliente',$dados_cliente['id_cliente']);
                        echo form_submit('atualizar','Editar','class="btn btn-success pull-right"'); 
                    ?>
                </div>
                <?php echo form_close();?>            
        </div>
    </div>   
</body>
</html>