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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrapLayout.css";?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/navIcons.css";?>">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<script>
$(function() {
  otable = $('#dataTableClientes').dataTable();  
});

function filterme() {  
  var valueSite = $('input:checkbox[name="site"]:checked').map(function() {
    return this.value === 'on' ? 'S' : 'N';
  }).get().join('|');  
  otable.fnFilter(valueSite, [5], true, false, false, false);
  
  var valueBoca = $('input:checkbox[name="boca"]:checked').map(function() {
    return this.value === 'on' ? 'S' : 'N';
  }).get().join('|');  
  otable.fnFilter(valueBoca, [6], true, false, false, false);  
  
  var valueFace = $('input:checkbox[name="face"]:checked').map(function() {
    return this.value === 'on' ? 'S' : 'N';
  }).get().join('|');  
  otable.fnFilter(valueFace, [7], true, false, false, false);  
  
  var valueIndica = $('input:checkbox[name="indica"]:checked').map(function() {
    return this.value === 'on' ? 'S' : 'N';
  }).get().join('|');  
  otable.fnFilter(valueIndica, [8], true, false, false, false);  
  
  var selectSituacao = $('#situacao').val();
  otable.fnFilter(selectSituacao, [11], true, false, false, false);
}
</script>
<style>
.icon-center {
    display: block;
    margin: auto 70px auto 70px;
}
</style>
</head>
<body>
    <?php $dados_cliente = $this->session->userdata['usuario_logado'] ? $this->session->userdata['usuario_logado'] : redirect('login/logout'); ?>
    <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Login System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse container" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item icon-center">
                <a class="nav-link" href="<?php echo base_url('listagem_clientes');?>">
                <i class="fa fa-user">
                    <span class="badge badge-primary"><?php echo count($clients);?></span>
                </i>
                Listagem de Clientes
                </a>
            </li>
            <li class="nav-item icon-center">
              <a class="nav-link" href="<?php echo base_url('listagem_clientes/carregar_form_cadastro');?>">
                <i class="fa fa-list">
                  <span class="badge badge-danger"></span>
                </i>
                Cadastro de Clientes
              </a>
            </li>
            <li class="nav-item icon-center">
                <a class="nav-link disabled" href="<?php echo base_url('cadastro_usuario/listar_usuarios');?>">
                <i class="fa fa-user">
                  <span class="badge badge-warning"></span>
                </i>
                Listagem de Usuários
              </a>
            </li>
            <li class="nav-item dropdown icon-center">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-sign-out">
                  <span class="badge badge-primary"></span>
                </i>
                <?php echo $dados_cliente['nome_usuario']?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo base_url('login/logout');?>">Sair</a>
              </div>
            </li>
          </ul>          
        </div>
    </nav>
    <div class="container" style="width:100%;">
        <div class="table-wrapper table-responsive">            
            <div class="table-title"><h2><b>Clientes</b></h2>                
                <h4>Filtros</h4>                     
                <fieldset style="">
                    <label>Origem</label>
                    <div class="form-group">                            
                        <input type="checkbox" onchange="filterme()" name="site" id="site"> Site                            
                        <input type="checkbox" onchange="filterme()" name="boca" id="boca"> Boca a boca
                        <input type="checkbox" onchange="filterme()" name="face" id="face"> Facebook                            
                        <input type="checkbox" onchange="filterme()" name="indica" id="indica"> Indicação
                    </div>
                </fieldset>
                <div class="form-group">                        
                    <label for="situacao">Situação</label>
                    <select name="situacao" id="situacao" onchange="filterme()" class="form-control">
                        <option value="">Selecione</option>
                        <option value="S">Ativo</option>
                        <option value="N">Inativo</option>
                    </select>
                </div>                
            </div>
            <table id="dataTableClientes" class="display responsive nowrap" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Cnpj</th>
                        <th>Telefone</th>
                        <th>S</th>
                        <th>B</th>
                        <th>F</th>
                        <th>I</th>
                        <th>Estado</th>
                        <th>Cidade</th>                    
                        <th>Ativo</th>
                        <th>Obs</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($clients as $client){
                    ?>
                        <tr>
                            <th scope="row"><?php echo $client['id_cliente']; ?></th>
                            <th><?php echo $client['nome_cliente']; ?></th>
                            <th><?php echo $client['email_cliente']; ?></th>
                            <th><?php echo $client['cnpj']; ?></th>
                            <th><?php echo $client['telefone']; ?></th>
                            <th><?php echo $client['site'] ? 'S' : 'N';?></th>
                            <th><?php echo $client['bocaboca'] ? 'S' : 'N'; ?></th>
                            <th><?php echo $client['facebook'] ? 'S' : 'N'; ?></th>
                            <th><?php echo $client['indicacao'] ? 'S' : 'N'; ?></th>                            
                            <th><?php echo $client['estado']; ?></th>
                            <th><?php echo $client['cidade']; ?></th>
                            <th><?php echo $client['situacao'] ? 'S' : 'N'; ?></th>
                            <th><?php echo $client['observacao']; ?></th>
                            <td>
                                <a href="<?php echo base_url('listagem_clientes/editar/'.$client['id_cliente']); ?>" class="edit"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
                                <a href="<?php echo base_url('listagem_clientes/deletar/'.$client['id_cliente']); ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                            </td>                
                        </tr>

                    <?php 
                    }
                    ?>                             
                </tbody>
            </table>          
        </div>        
    </div>    
</body>
</html>
