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
});
$('#telefone').mask('(00) 00000-0000');
</script>
</head>
<body>
    <div class="container">
        <div class="wrapper">            
            <form id="form_cadastro" class="form-registro" role="form" method="POST" action="<?php echo base_url('cadastro_usuario/registrar'); ?>" >                
                <h4 class="text-center">Cadastro usuário</h4>                
                <?php
                    if ($this->session->flashdata('msg')){
                        echo '<div class="alert alert-danger">';
                        echo $this->session->flashdata('msg');
                        echo "</div>";
                    }
                ?>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="nome">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="email">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="senha">
                </div>
                <label for="sexo">Sexo:</label>
                <div class="form-check">                                
                    <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M">
                    <label class="form-check-label" for="sexo">
                      masculino
                    </label>                           
                    <input class="form-check-input" type="radio" name="sexo" id="sexo" style="margin-left:10px;" value="F">
                    <label class="form-check-label" for="sexo">
                      feminino
                    </label>
                </div>
                <div class="form-group">
                    <label class="control-label" for="telefone">Telefone</label>
                    <input class="form-control" type="text" name="telefone" id="telefone" placeholder="telefone">
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
                    <select id="cidades" name="cidades" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="situacao">Situação</label>
                    <select id="situacao" name="situacao" class="form-control" required>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>                
                <button class="btn btn-success pull-right" type="submit" name="criar_conta" value="criar_conta">Registrar</button>                
            </form>
        </div>
    </div>   
</body>
</html>
