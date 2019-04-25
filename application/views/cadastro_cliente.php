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
    $('#telefone').mask('(00) 00000-0000');
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
    $("#site").is(":checked") ? $("#site").val(1) : $("#site").val(0);
});
</script>
</head>
<body>
    <?php $dados_cliente = $this->session->userdata['usuario_logado'] ? $this->session->userdata['usuario_logado'] : redirect('login/logout'); ?>
    <div class="container">
        <div class="wrapper">            
            <form class="form-registro" role="form" method="POST" action="<?php echo base_url('listagem_clientes/cadastrar'); ?>">                
                <h4 class="text-center">Cadastro Cliente</h4>                
                <?php
                    if ($this->session->flashdata('msg')){
                        echo '<div class="alert alert-danger">';
                        echo $this->session->flashdata('msg');
                        echo "</div>";
                    }
                ?>                
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="nome" value="">                                
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email"  value="">
                </div>
                <div class="form-group">
                    <label for="cnpj">Cnpj</label>
                    <input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="cnpj">
                </div>
                <div class="form-group">
                    <label for="telefone" class="control-label">Telefone</label>
                    <input type="text" class="form-control" name="telefone" id="telefone" placeholder="telefone">                    
                </div>                     
                <div class="form-group">
                    <label for="origem" class="control-label">Origem</label>
                    <div id="site" class="checkbox">
                        <label>                            
                            <input type="checkbox" name="site" id="site"> Site
                        </label>
                    </div>
                    <div id="bocaboca" class="checkbox">
                        <label>                            
                            <input type="checkbox" name="bocaboca" id="bocaboca"> Boca a Boca
                        </label>
                    </div>
                    <div id="face" class="checkbox">
                        <label>                            
                            <input type="checkbox" name="facebook" id="facebook"> Facebook
                        </label>
                    </div>
                    <div id="indica" class="checkbox">
                        <label>                            
                            <input type="checkbox" name="indicacao" id="indicacao"> Indicação
                        </label>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <!--Estado/Cidade-->
                <div class="form-group">
                    <label for="estados">Estado</label>
                    <select id="estados" name="estados" class="form-control" >  
                        <option value=''>Selecione o Estado</option>
                        <?php foreach ($states->result() as $state) { ?>
                            <option  value="<?php echo $state->id?>"><?php echo $state->nome?></option>
                        <?php } ?>
                    </select>
                </div>                            
                <div class="form-group">
                    <label for="cidades">Cidade</label>
                    <select id="cidades" name="cidades" class="form-control" ></select>
                </div> 
                <div class="form-group">
                    <label for="situacao">Situação</label>
                    <select id="situacao" name="situacao" class="form-control" required>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>                           
                <div class="form-group">
                    <label for="obs">Observações</label>
                    <textarea class="form-control" name="obs" cols="40" rows="10"></textarea>
                </div>
                <button class="btn btn-success pull-right" type="submit" name="cadastro_cliente" value="cadastro_cliente">Cadastrar</button>
            </form>
        </div>
    </div>   
</body>
</html>