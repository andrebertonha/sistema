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

<div class="container" style="width:100%;">
    <div class="table-wrapper table-responsive">
        
        <table id="dataTableClientes" class="display responsive" width="100%" cellspacing="0">
            <div class="table-title table-responsive" style="width:1276.97px;"><h2><b>Clientes</b></h2>
                <h4>Filtros</h4>                     
                <fieldset style="width:450px;">
                    <label>Origem</label>
                    <div class="form-group">                            
                        <input type="checkbox" onchange="filterme()" name="site" id="site"> Site                            
                        <input type="checkbox" onchange="filterme()" name="boca" id="boca"> Boca a boca
                        <input type="checkbox" onchange="filterme()" name="face" id="face"> Facebook                            
                        <input type="checkbox" onchange="filterme()" name="indica" id="indica"> Indicação
                    </div>
                    <div class="form-group">                        
                        <label for="situacao">Situação</label>
                        <select name="situacao" id="situacao" onchange="filterme()" class="form-control">
                            <option value="">Selecione</option>
                            <option value="S">Ativo</option>
                            <option value="N">Inativo</option>
                        </select>
                    </div>
                </fieldset>            
            </div>
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
                <?php foreach($clients as $client){ ?>
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
                <?php } ?>                             
            </tbody>
        </table>          
    </div>        
</div>    
