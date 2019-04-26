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
});
$('#telefone').mask('(00) 00000-0000');
</script>
<div class="container">
    <div class="form-group">            
        <h3>Editar usuário</h3>
        <?php                 
            if ($this->session->flashdata('msg')){
                echo '<div class="alert alert-danger">';
                echo $this->session->flashdata('msg');
                echo "</div>";
            } 

            echo form_open('cadastro_usuario/update/');
            ?>
            <div class="form-group">
                <?php 
                    echo form_label('Nome');
                    echo form_input('nome', set_value('nome', $dados_usuario['nome_usuario']),'class="form-control"');
                    echo form_error('nome');
                ?>
            </div>
            <div class="form-group">
                <?php 
                    echo form_label('Email');
                    echo form_input('email', set_value('email', $dados_usuario['email_usuario']),'class="form-control"');
                    echo form_error('email');
                ?>
            </div>
            <div class="form-group">
                <?php 
                    echo form_label('Senha');
                    echo form_input('senha', set_value('senha', $dados_usuario['senha_no_crip']),'class="form-control"');
                    echo form_error('senha');
                ?>
            </div>
            <label for="sexo">Sexo:</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="sexo" <?php if($dados_usuario['sexo']=='M') echo "checked='checked'"; ?> value="M" />
                <label class="form-check-label" for="gender" >Masculino</label>
                <input class="" type="radio" name="sexo" id="sexo" <?php if($dados_usuario['sexo']=='F') echo "checked='checked'"; ?> value="F" />
                <label for="gender" class="">Feminino</label>                    
            </div>                
            <div class="form-group">
                <label for="situacao">Situação</label>
                <?php
                    $situacao = array(
                        "1"=>"Ativo",
                        "0"=>"Inativo"
                    );	
                    $valor_situacao = $dados_usuario['situacao'] == 1 ? 1 : 0;
                    echo form_dropdown('situacao',$situacao, set_value('situacao',$valor_situacao), 'class="form-control"');
                    echo form_error('situacao');
                ?>
            </div>

            <div class="form-group">
                <label for="estados">Estado</label>
                <select name="estados" id="estados" class="form-control">
                <?php                        
                    $this->load->model('estado_model');                                                
                    $estados = $this->estado_model->getAll();                        
                    foreach($estados->result() as $estado){                
                ?>                            
                    <option value="<?php echo $estado->id; ?>" <?php if($estado->nome == $dados_usuario['estado']) echo 'selected="selected"'; else echo '';?>><?php echo $estado->nome; ?></option>
                <?php
                    }                       
                ?>
                </select>                        
            </div>
            <div class="form-group">
                <label for="cidades">Cidade</label>
                <select name="cidades" id="cidades" class="form-control" data-atual="<?php echo $dados_usuario['id_cidade']; ?>">                        
                </select>                        
            </div>                
            <div class="form-group">
                <?php 
                    $attributes = array(
                        'class' => 'form-control',
                        'id'    => 'telefone'
                    );
                    echo form_label('Telefone');
                    echo form_input('telefone', set_value('telefone', $dados_usuario['telefone']),$attributes);
                    echo form_error('telefone');
                ?>
            </div>
            <div class="form-group">
                <?php 
                    echo form_hidden('id_usuario',$dados_usuario['id_usuario']);                               
                    echo form_submit('atualizar','Editar','class="btn btn-success pull-right"'); 
                    echo form_submit('voltar', 'Cencelar','class="btn btn-danger"'); 
                ?>
            </div>
            <?php echo form_close();?>            
    </div>
</div>