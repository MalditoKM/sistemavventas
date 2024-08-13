<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');

include ('../app/controllers/compras/listado_de_compras.php');
include ('../app/controllers/ventas/listado_de_ventas.php');
include ('../app/controllers/clientes/listado_de_clientes.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de ventas actualizado</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ventas registradas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><iclass="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>Nro</center>
                                            </th>
                                            <th>
                                                <center>Código venta</center>
                                            </th>
                                            <th>
                                                <center>Producto</center>
                                            </th>
                                            <th>
                                                <center>Fecha de venta</center>
                                            </th>
                                            <th>
                                                <center>Cliente</center>
                                            </th>
                                            <th>
                                                <center>Usuario</center>
                                            </th>
                                            <th>
                                                <center>Total venta</center>
                                            </th>
                                            <th>
                                                <center>Acciones</center>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $contador = 0;
                                        foreach ($ventas_datos as $ventas_dato) {
                                            $id_ventas = $ventas_dato['id_ventas'];
                                            $id_producto = $ventas_dato['id_producto'];
                                            $id_cliente = $ventas_dato['id_cliente'];
                                            $id_usuario = $ventas_dato['id_usuario'];
                                            $total_pagado = $ventas_dato['total_pagado'];
                                            $fecha_venta = $ventas_dato['fyh_creacion'];
                                            ?>
                                            <tr>
                                                <td><center><?php echo ++$contador; ?></center></td>
                                                <td><center><?php echo $id_ventas; ?></center></td>
                                                <td><center>
                                                    <?php echo $id_producto; ?></center>
                                                    </center>
                                                </td>
                                                <td><center><?php echo $fecha_venta; ?></center></td>
                                                <td><center>
                                                <?php echo $id_cliente; ?></center>
                                                    </center>
                                </td>
                                <td><center><?php echo $id_usuario; ?></center></td>
                                <td><center><?php echo $total_pagado; ?><center></td>
                                <td>
                                <center>
                                    <div class="btn-group">
                                        <a href="factura2.php?id=<?php echo $id_ventas; ?>" type="button" class="btn btn-success btn-sm mr-2">
                                            <i class="fa fa-file-invoice"></i> Factura
                                        </a>
                                        <a href="tiket.php?id=<?php echo $id_ventas; ?>" type="button" class="btn btn-success btn-sm mr-2">
                                            <i class="fa fa-file-invoice"></i> Ticket
                                        </a>
                                        <a href="show.php?id=<?php echo $id_ventas; ?>" type="button" class="btn btn-info btn-sm mr-2">
                                            <i class="fa fa-eye"></i> Ver
                                        </a>
                                        <a href="../app/controllers/ventas/borrar_ventas.php?id=<?php echo $id_ventas; ?>" type="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Borrar
                                        </a>
                                    </div>
                                </center>
                                </td>
                                </tr>
                                <?php
                                        }
                                        ?>
                            </tbody>
                            </tfoot>
                            </table>
                        </div>
                    <button id="reportButton" class="btn btn-primary">Generar Reporte</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


<!-- Scripts para inicializar DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<!-- Botón personalizado para reportes -->
<script>
    $(document).ready(function() {
        var table = $('#example1').DataTable({
            "pageLength": 25,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Ventas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "dom": 'Bfrtip', // Habilitar botones en DataTables
            "buttons": [
                {
                    text: 'PDF',
                    extend: 'pdf',
                    title: 'Reporte de Ventas',
                    exportOptions: {
                        columns: ':visible' // Exporta solo las columnas visibles
                    }
                }
            ]
        });

        // Evento click para el botón de reportes
        $('#reportButton').on('click', function() {
            table.button('.buttons-pdf').trigger(); // Triggers the PDF download button
        });

        // Añadir los botones al contenedor
        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    
</script>




