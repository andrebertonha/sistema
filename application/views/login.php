<!DOCTYPE html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<style>
.card {        
    margin: 200px 0 0 0 ;
    float: none;
    margin-bottom: 10px;
}
</style>
</head>
<body>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="card">
            <article class="card-body align-center">
                <h5 class="card-title text-center mb-4 mt-1">Login</h5>
                <hr>                
                <form method="POST"  action="<?php echo base_url('login/login');?>">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i></span>
                             </div>
                            <input name="email" class="form-control" placeholder="Email" type="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i></span>
                             </div>
                            <input name="senha" class="form-control" placeholder="******" type="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </form>                
                <div class="form-group">
                    <form class="form-cadastro" role="form" method="POST" action="<?php echo base_url('cadastro_usuario'); ?>">
                        <button type="submit" value="Cadastrar" class="btn btn-secondary btn-block">Cadastrar</button>
                    </form>
                </div>                        
                <a href="#" data-target="#pwdModal" data-toggle="modal">Esqueceu sua senha?</a>
                <div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                          
                      </div>
                      <div class="modal-body">
                          <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="text-center">
                                          <p>Digite seu e-mail</p>
                                            <div class="panel-body">
                                                <fieldset>                                                      
                                                    <div class="form-group">
                                                        <form class="form-cadastro" role="form" method="POST" action="<?php echo base_url('login/recuperarSenha'); ?>">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input class="form-control input-lg" placeholder="email@seuemail.com" name="email" type="email" required>
                                                                </div>
                                                            </div>
                                                            <button type="submit" value="Cadastrar" class="btn btn-secondary btn-block">Recuperar Senha</button>
                                                        </form>                                                        
                                                    </div>
                                                    
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>
                      <div class="modal-footer">
                          <div class="col-md-12">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
                          </div>	
                      </div>
                  </div>
                  </div>
                </div>               
            </article>
        </div>
    </div>
</div>
</body>
</html>