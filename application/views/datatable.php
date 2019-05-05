<script>
/*
function filterGlobal () {
    $('#example').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}
 
function filterColumn ( i ) {
    $('#example').DataTable().column( i ).search(
        $('#col'+i+'_filter').val(),
        $('#col'+i+'_regex').prop('checked'),
        $('#col'+i+'_smart').prop('checked')
    ).draw();
}
*/
 

    /*
    $('#example').DataTable();
 
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } ); 
 
    $('input.column_filter').on( 'keyup click', function () {
        filterColumn( $(this).parents('tr').attr('data-column') );
    } );
    */
$(document).ready(function() {
    //campo para buscar apenas por observacoes
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        
    } );    

    var table = $('#example').DataTable();

    table.columns().indexes().flatten().each( function ( i ) {
        
        var column = table.column( i );
        //obs column index
        if(i===12){
            
            $(this).html( '<input type="text" placeholder="Search" />' );
            var that = this;            
            
            $( 'input', column.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .columns(i)                   
                        .search( this.value )
                        .draw();
                } else {
                        that.columns(i)                   
                        .search("")
                        .draw();
                }                
            });
            
        }  
        else {
            var select = $('<select><option value="">selecione</option></select>')
            .appendTo( $(column.footer()).empty() )
            .on( 'change', function () {
                // Escape the expression so we can perform a regex match
                var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );        
                column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
            } );

            column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } 

    } );


} );

</script>

    <!--<table style="width: 67%; margin: 0 auto 2em auto;" cellspacing="0" cellpadding="3" border="0">
        <thead>
            <tr>
                <th>Target</th>
                <th>Search text</th>
                <th>Treat as regex</th>
                <th>Use smart search</th>
            </tr>
        </thead>
        <tbody>
            <tr id="filter_global">
                <td>Global search</td>
                <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                <td align="center"><input type="checkbox" class="global_filter" id="global_regex"></td>
                <td align="center"><input type="checkbox" class="global_filter" id="global_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col1" data-column="0">
                <td>Column - Name</td>
                <td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col0_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col0_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col2" data-column="1">
                <td>Column - Position</td>
                <td align="center"><input type="text" class="column_filter" id="col1_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col1_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col1_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col3" data-column="2">
                <td>Column - Office</td>
                <td align="center"><input type="text" class="column_filter" id="col2_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col2_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col2_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col4" data-column="3">
                <td>Column - Age</td>
                <td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col3_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col3_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col5" data-column="4">
                <td>Column - Start date</td>
                <td align="center"><input type="text" class="column_filter" id="col4_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col4_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col4_smart" checked="checked"></td>
            </tr>
            <tr id="filter_col6" data-column="5">
                <td>Column - Salary</td>
                <td align="center"><input type="text" class="column_filter" id="col5_filter"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col5_regex"></td>
                <td align="center"><input type="checkbox" class="column_filter" id="col5_smart" checked="checked"></td>
            </tr>
        </tbody>
    </table>-->
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                    <th>id</th>
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
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Site</th>
                <th>Boca a boca</th>                
                <th>Facebook</th>
                <th>Indicação</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Situação</th>   
                <th>obs</th>
                
            </tr>
        </tfoot>
    </table>