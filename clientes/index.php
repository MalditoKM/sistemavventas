<?php
/*---------- 
*  author  : Marlon Vargas
*  version : 1.0
----------*/
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/clientes/listado_de_clientes.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Clientes
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card-body" style="display: block;">
                <table id="example1" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th><center>Nro</center></th>
                            <th><center>Nombre del Cliente</center></th>
                            <th><center>Cédula</center></th>
                            <th><center>Teléfono</center></th>
                            <th><center>Email</center></th>
                            <th><center>Dirección</center></th>
                            <th><center>Acciones</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 0;
                        foreach ($clientes_datos as $clientes_dato) {
                            $contador++;
                            $id_cliente = $clientes_dato['id_cliente'];
                            $nombre_cliente = $clientes_dato['nombre_cliente'];
                        ?>
                        <tr>
                            <td><center><?php echo $contador; ?></center></td>
                            <td><?php echo $nombre_cliente; ?></td>
                            <td><?php echo $clientes_dato['cedula']; ?></td>
                            <td>
                                <a href="https://wa.me/593<?php echo $clientes_dato['telefono']; ?>" target="_blank" class="btn btn-success">
                                    <i class="fa fa-phone"></i>
                                    <?php echo $clientes_dato['telefono']; ?>
                                </a>
                            </td>
                            <td><?php echo $clientes_dato['email']; ?></td>
                            <td><?php echo $clientes_dato['direccion']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_cliente; ?>">
                                        <i class="fa fa-pencil-alt"></i> Editar
                                    </button>
                                    
                                    <!-- Modal para actualizar cliente -->
                                    <div class="modal fade" id="modal-update<?php echo $id_cliente; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #116f4a; color: white">
                                                    <h4 class="modal-title">Actualización del Cliente</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="../app/controllers/clientes/update.php" method="POST" onsubmit="return validarFormulario<?php echo $id_cliente; ?>()">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="cedula<?php echo $id_cliente; ?>">Cédula <b>*</b></label>
                                                            <input type="text" name="cedula" id="cedula<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientes_dato['cedula']; ?>" maxlength="10" pattern="\d{10}">
                                                            <small style="color: red; display: none;" id="lbl_cedula<?php echo $id_cliente; ?>">* Este campo es requerido y debe tener 10 dígitos</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nombre_cliente<?php echo $id_cliente; ?>">Nombre del Cliente <b>*</b></label>
                                                            <input type="text" name="nombre_cliente" id="nombre_cliente<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $nombre_cliente; ?>">
                                                            <small style="color: red; display: none;" id="lbl_nombre<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telefono<?php echo $id_cliente; ?>">Teléfono<b>*</b></label>
                                                            <input type="text" name="telefono" id="telefono<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientes_dato['telefono']; ?>" maxlength="10" pattern="\d{10}">
                                                            <small style="color: red; display: none;" id="lbl_telefono<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email<?php echo $id_cliente; ?>">Email <b>*</b></label>
                                                            <input type="email" name="email" id="email<?php echo $id_cliente; ?>" class="form-control" value="<?php echo $clientes_dato['email']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="direccion<?php echo $id_cliente; ?>">Dirección <b>*</b></label>
                                                            <textarea name="direccion" id="direccion<?php echo $id_cliente; ?>" cols="30" rows="3" class="form-control"><?php echo $clientes_dato['direccion']; ?></textarea>
                                                            <small style="color: red; display: none;" id="lbl_direccion<?php echo $id_cliente; ?>">* Este campo es requerido</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="../app/controllers/clientes/delete.php?id_cliente=<?php echo $id_cliente; ?>" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Eliminar
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para registrar nuevo cliente -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff; color: white">
                <h4 class="modal-title">Registro de nuevo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/create.php" method="POST" onsubmit="return validarFormulario()">
                    <div class="form-group">
                        <label for="cedula">Cédula <b>*</b></label>
                        <input type="text" name="cedula" id="cedula" class="form-control" placeholder="Ingrese la cédula" maxlength="10" pattern="\d{10}">
                        <small style="color: red; display: none;" id="lbl_cedula">* Este campo es requerido y debe tener 10 dígitos</small>
                    </div>
                    <div class="form-group">
                        <label for="nombre_cliente">Nombre del Cliente <b>*</b></label>
                        <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control" placeholder="Ingrese el nombre del cliente">
                        <small style="color: red; display: none;" id="lbl_nombre">* Este campo es requerido</small>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono <b>*</b></label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el teléfono" maxlength="10" pattern="\d{10}">
                        <small style="color: red; display: none;" id="lbl_telefono">* Este campo es requerido y debe tener 10 dígitos</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<b>*</b></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese el correo electrónico">
                        <small style="color: red; display: none;" id="lbl_email">* Este campo es requerido</small>
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección<b>*</b></label>
                        <textarea name="direccion" id="direccion" cols="30" rows="3" class="form-control" placeholder="Ingrese la dirección"></textarea>
                        <small style="color: red; display: none;" id="lbl_direccion">* Este campo es requerido</small>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>

<script>
// Validación del formulario de creación
function validarFormulario() {
    let isValid = true;

    const cedula = document.getElementById('cedula');
    const nombre_cliente = document.getElementById('nombre_cliente');
    const telefono = document.getElementById('telefono');
    const email = document.getElementById('email');
    const direccion = document.getElementById('direccion');

    const lbl_cedula = document.getElementById('lbl_cedula');
    const lbl_nombre = document.getElementById('lbl_nombre');
    const lbl_telefono = document.getElementById('lbl_telefono');
    const lbl_email = document.getElementById('lbl_email');
    const lbl_direccion = document.getElementById('lbl_direccion');

    lbl_cedula.style.display = 'none';
    lbl_nombre.style.display = 'none';
    lbl_telefono.style.display = 'none';
    lbl_email.style.display = 'none';
    lbl_direccion.style.display = 'none';

    if (cedula.value === '' || cedula.value.length !== 10 || !/^\d{10}$/.test(cedula.value)) {
        lbl_cedula.style.display = 'block';
        isValid = false;
    }

    if (nombre_cliente.value === '') {
        lbl_nombre.style.display = 'block';
        isValid = false;
    }

    if (telefono.value === '' || telefono.value.length !== 10 || !/^\d{10}$/.test(telefono.value)) {
        lbl_telefono.style.display = 'block';
        isValid = false;
    }

    if (email.value === '') {
        lbl_email.style.display = 'block';
        isValid = false;
    }

    if (direccion.value === '') {
        lbl_direccion.style.display = 'block';
        isValid = false;
    }

    return isValid;
}

// Función de validación para formularios de actualización
<?php foreach ($clientes_datos as $clientes_dato) { 
    $id_cliente = $clientes_dato['id_cliente']; ?>
function validarFormulario<?php echo $id_cliente; ?>() {
    let isValid = true;

    const cedula = document.getElementById('cedula<?php echo $id_cliente; ?>');
    const nombre_cliente = document.getElementById('nombre_cliente<?php echo $id_cliente; ?>');
    const telefono = document.getElementById('telefono<?php echo $id_cliente; ?>');
    const email = document.getElementById('email<?php echo $id_cliente; ?>');
    const direccion = document.getElementById('direccion<?php echo $id_cliente; ?>');

    const lbl_cedula = document.getElementById('lbl_cedula<?php echo $id_cliente; ?>');
    const lbl_nombre = document.getElementById('lbl_nombre<?php echo $id_cliente; ?>');
    const lbl_telefono = document.getElementById('lbl_telefono<?php echo $id_cliente; ?>');
    const lbl_direccion = document.getElementById('lbl_direccion<?php echo $id_cliente; ?>');

    lbl_cedula.style.display = 'none';
    lbl_nombre.style.display = 'none';
    lbl_telefono.style.display = 'none';
    lbl_direccion.style.display = 'none';

    if (cedula.value === '' || cedula.value.length !== 10 || !/^\d{10}$/.test(cedula.value)) {
        lbl_cedula.style.display = 'block';
        isValid = false;
    } else if (!esCedulaValida(cedula.value)) {
        lbl_cedula.textContent = 'La cédula no es válida';
        lbl_cedula.style.display = 'block';
        isValid = false;
    }

    if (nombre_cliente.value === '') {
        lbl_nombre.style.display = 'block';
        isValid = false;
    }

    if (telefono.value === '' || telefono.value.length !== 10 || !/^\d{10}$/.test(telefono.value)) {
        lbl_telefono.style.display = 'block';
        isValid = false;
    }

    if (direccion.value === '') {
        lbl_direccion.style.display = 'block';
        isValid = false;
    }

    return isValid;
}
<?php } ?>

// Manejar el evento de clic en el botón de guardar
document.getElementById('guardar').addEventListener('click', function(event) {
    if (!validarFormulario()) {
        event.preventDefault(); // Evita el envío del formulario si hay errores
    }
});
</script>
<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
