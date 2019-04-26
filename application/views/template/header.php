<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/bootstrapLayout.css";?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/navIcons.css";?>">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<style>
.icon-center {
    display: block;
    margin: auto 70px auto 70px;
}
</style>
</head>
<body id="page-top">
<?php $usuario = $this->session->userdata['usuario_logado'] ? $this->session->userdata['usuario_logado'] : redirect('login/logout'); ?>
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
                <span class="badge badge-primary"><?php //echo count($clients);?></span>
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
            <?php echo $usuario['nome_usuario']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url('login/logout');?>">Sair</a>
          </div>
        </li>
      </ul>          
    </div>
</nav>