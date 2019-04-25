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
</head>
<body>
    <?php $dados_cliente = $this->session->userdata['usuario_logado'] ? $this->session->userdata['usuario_logado'] : redirect('login/logout'); ?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Listar <b>Usuários</b></h2>
                    </div>
                    <div class="col-sm-6">                        
                        <a href="<?php echo base_url('cadastro_usuario/sair');?>" class="btn btn-logout" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Logout</span></a>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th>Nome</th>
                        <th>Email</th>                                    
                        <th>Situação</th>
                        <th>Sexo</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Telefone</th>                    
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($users as $user){            
                    ?>
                        <tr>
                            <th scope="row"><?php echo $user['id_usuario']; ?></th>
                            <th><?php echo $user['nome_usuario']; ?></th>
                            <th><?php echo $user['email_usuario']; ?></th>                                             
                            <th><?php echo $user['situacao']; ?></th>
                            <th><?php echo $user['sexo']; ?></th>
                            <th><?php echo $user['estado']; ?></th>
                            <th><?php echo $user['cidade']; ?></th>
                            <th><?php echo $user['telefone']; ?></th>
                            <td>
                                <a href="<?php echo base_url('cadastro_usuario/editar/'.$user['id_usuario']); ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Edit"></i></a>
                                <a href="<?php echo base_url('cadastro_usuario/deletar/'.$user['id_usuario']); ?>" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="" data-original-title="Delete"></i></a>
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>                             
                </tbody>
            </table>            
            <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>   
</body>
</html>     
