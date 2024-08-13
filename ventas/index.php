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
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-producto<?php echo $id_producto; ?>">
                                                        <?php echo $id_producto; ?>
                                                    </button>
                                                    </center>
                                                    <!-- modal para visualizar datos de los productos -->
                                                    <div class="modal fade" id="modal-producto<?php echo $id_producto; ?>">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: #07b0d6;color: white">
                                                                    <h4 class="modal-title">Datos del producto</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Aquí puedes agregar el contenido del modal del producto -->
                                                                    <div class="card-body" style="display: block;">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-9">
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Código:</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        value="<?php echo $codigo; ?>"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Categoría:</label>
                                                                                                    <div
                                                                                                        style="display: flex">
                                                                                                        <input type="text"
                                                                                                            class="form-control"
                                                                                                            value="<?php echo $nombre_categoria; ?>"
                                                                                                            disabled>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Nombre del
                                                                                                        producto:</label>
                                                                                                    <input type="text"
                                                                                                        name="nombre"
                                                                                                        value="<?php echo $nombre; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Usuario</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        value="<?php echo $email; ?>"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-8">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Descripción
                                                                                                        del
                                                                                                        producto:</label>
                                                                                                    <textarea
                                                                                                        name="descripcion"
                                                                                                        id="" cols="30"
                                                                                                        rows="2"
                                                                                                        class="form-control"
                                                                                                        disabled><?php echo $descripcion; ?></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="row">
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="">Stock:</label>
                                                                                                    <input type="number"
                                                                                                        name="stock"
                                                                                                        value="<?php echo $stock; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Stock
                                                                                                        mínimo:</label>
                                                                                                    <input type="number"
                                                                                                        name="stock_minimo"
                                                                                                        value="<?php echo $stock_minimo; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Stock
                                                                                                        máximo:</label>
                                                                                                    <input type="number"
                                                                                                        name="stock_maximo"
                                                                                                        value="<?php echo $stock_maximo; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Precio
                                                                                                        compra:</label>
                                                                                                    <input type="number"
                                                                                                        name="precio_compra"
                                                                                                        value="<?php echo $precio_compra; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Precio
                                                                                                        venta:</label>
                                                                                                    <input type="number"
                                                                                                        name="precio_venta"
                                                                                                        value="<?php echo $precio_venta; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Fecha de
                                                                                                        ingreso:</label>
                                                                                                    <input type="date"
                                                                                                        name="fecha_ingreso"
                                                                                                        value="<?php echo $fecha_ingreso; ?>"
                                                                                                        class="form-control"
                                                                                                        disabled>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>


                                                                                    </div>
                                                                                    <div class="col-md-3">
                                                                                        <div class="form-group">
                                                                                            <label for="">Imagen del
                                                                                                producto</label>
                                                                                            <center>
                                                                                                <img src="<?php echo $URL . "/almacen/img_productos/" . $imagen; ?>"
                                                                                                    width="100%" alt="">
                                                                                            </center>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                </td>
                                                <td><center><?php echo $fecha_venta; ?></center></td>
                                                <td><center>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                                        data-target="#modal-cliente<?php echo $id_cliente; ?>">
                                                        <?php echo $id_cliente; ?>
                                                    </button>
                                                    </center>
                                                    <!-- modal para visualizar datos del cliente -->
                                                    <div class="modal fade" id="modal-cliente<?php echo $id_cliente; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header"
                                                                    style="background-color: #07b0d6;color: white">
                                                                    <h4 class="modal-title">Datos del Cliente</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Formulario para Visualizar Cliente -->
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="cedula_visualizar">Cédula</label>
                                                                                <input type="text" id="cedula_visualizar"
                                                                                    value="<?php echo htmlspecialchars($clientes_dato['cedula']); ?>"
                                                                                    class="form-control" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="nombre_visualizar">Nombre del
                                                                                    Cliente</label>
                                                                                <input type="text" id="nombre_visualizar"
                                                                                    value="<?php echo htmlspecialchars($clientes_dato['nombre_cliente']); ?>"
                                                                                    class="form-control" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="telefono_visualizar">Teléfono
                                                                                    del Cliente</label>
                                                                                <a href="https://wa.me/593<?php echo htmlspecialchars($clientes_dato['telefono']); ?>"
                                                                                    target="_blank" class="btn btn-success">
                                                                                    <i class="fa fa-whatsapp"></i>
                                                                                    <?php echo htmlspecialchars($clientes_dato['telefono']); ?>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="email_visualizar">Email del
                                                                                    Cliente</label>
                                                                                <input type="text" id="email_visualizar"
                                                                                    value="<?php echo htmlspecialchars($clientes_dato['email']); ?>"
                                                                                    class="form-control" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="direccion_visualizar">Dirección</label>
                                                                                <textarea id="direccion_visualizar"
                                                                                    class="form-control" cols="30" rows="3"
                                                                                    disabled><?php echo htmlspecialchars($clientes_dato['direccion']); ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                </div>
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




