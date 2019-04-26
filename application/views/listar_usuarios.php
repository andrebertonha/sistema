<script>
$(function() {
  otable = $('#dataTableUsuarios').dataTable();  
});
function filterme() {  
  var selectSituacao = $('#situacao').val();
  otable.fnFilter(selectSituacao, [3], true, false, false, false);
}
</script>
<div class="container" style="width:100%;">
    <div class="table-wrapper table-responsive">
        <div class="table-title"><h2><b>Usuários</b></h2>
            <h4>Filtros</h4>            
            <div class="form-group">                        
                <label for="situacao">Situação</label>
                <select name="situacao" id="situacao" onchange="filterme()" class="form-control">
                    <option value="">Selecione</option>
                    <option value="S">Ativo</option>
                    <option value="N">Inativo</option>
                </select>
            </div>
        </div>
        <table id="dataTableUsuarios" class="display responsive nowrap" width="100%" cellspacing="0">            
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
                        <th><?php echo $user['situacao'] ? 'S' : 'N'; ?></th>
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
    </div>
</div>   
     
