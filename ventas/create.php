<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');
include ('../app/controllers/ventas/listado_de_ventas.php');
include ('../app/controllers/almacen/listado_de_productos.php');
include ('../app/controllers/clientes/listado_de_clientes.php');
?>
<div class="content">
    <div class="content-wrapper">

        <head>
            <style>
                .container {
                    margin-top: 1px;
                }

                .total-section {
                    margin-top: 4px;
                }
            </style>
        </head>
        <div class="container">
            <h1 class="display-5 text-center">Gestión de Ventas 1</h1>
            <p class="has-text-centered pt-2 pb-3">
                <small>Para agregar productos debe de digitar el código de barras en el campo "Código de producto" y
                    luego presionar &nbsp; <strong class="is-uppercase"><i class="far fa-check-circle"></i> &nbsp;
                        Agregar producto</strong>. También puede agregar el producto mediante la opción &nbsp; <strong
                        class="is-uppercase"><i class="fas fa-search"></i> &nbsp; Buscar producto</strong>. Además puede
                    escribir el código de barras y presionar la tecla <strong
                        class="is-uppercase">enter</strong></small>
            </p>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group d-flex align-items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-buscar_producto"><i class="fa fa-search"></i> Buscar
                            producto</button><br>
                        <label for="codigoBarras" class="mr-2 mb-0"></label>
                        <input type="text" id="codigoBarras" class="form-control mr-2" placeholder="Código de barras">
                        <button id="agregarProducto" class="btn btn-primary mr-2">Agregar producto</button>
                    </div>

                    <!-- modal para visualizar datos de los productos -->

                    <div class="modal fade" id="modal-buscar_producto">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #1d36b6;color: white">
                                    <h4 class="modal-title">Búsqueda del producto</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table table-responsive">
                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <center>Nro</center>
                                                    </th>
                                                    <th>
                                                        <center>Seleccionar</center>
                                                    </th>
                                                    <th>
                                                        <center>Código</center>
                                                    </th>
                                                    <th>
                                                        <center>Categoría</center>
                                                    </th>
                                                    <th>
                                                        <center>Imagen</center>
                                                    </th>
                                                    <th>
                                                        <center>Nombre</center>
                                                    </th>
                                                    <th>
                                                        <center>Descripción</center>
                                                    </th>
                                                    <th>
                                                        <center>Stock</center>
                                                    </th>
                                                    <th>
                                                        <center>Precio compra</center>
                                                    </th>
                                                    <th>
                                                        <center>Precio venta</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $contador = 0;
                                                foreach ($productos_datos as $productos_dato) {
                                                    $id_producto = $productos_dato['id_producto']; ?>
                                                    <tr>
                                                        <td><?php echo ++$contador; ?></td>
                                                        <td>
                                                            <button class="btn btn-info"
                                                                id="btn_seleccionar<?php echo $id_producto; ?>">
                                                                Seleccionar
                                                            </button>
                                                            <script>
                                                                $('#btn_seleccionar<?php echo $id_producto; ?>').click(function () {
                                                                    var id_producto = "<?php echo $productos_dato['id_producto']; ?>";
                                                                    $('#id_producto').val(id_producto);

                                                                    var codigo = "<?php echo $productos_dato['codigo']; ?>";
                                                                    $('#codigo').val(codigo);

                                                                    var categoria = "<?php echo $productos_dato['categoria']; ?>";
                                                                    $('#categoria').val(categoria);

                                                                    var nombre = "<?php echo $productos_dato['nombre']; ?>";
                                                                    $('#nombre_producto').val(nombre);

                                                                    var email = "<?php echo $productos_dato['email']; ?>";
                                                                    $('#usuario_producto').val(email);

                                                                    var descripcion = "<?php echo $productos_dato['descripcion']; ?>";
                                                                    $('#descripcion_producto').val(descripcion);

                                                                    var stock = "<?php echo $productos_dato['stock']; ?>";
                                                                    $('#stock').val(stock);
                                                                    $('#stock_actual').val(stock);

                                                                    var stock_minimo = "<?php echo $productos_dato['stock_minimo']; ?>";
                                                                    $('#stock_minimo').val(stock_minimo);

                                                                    var stock_maximo = "<?php echo $productos_dato['stock_maximo']; ?>";
                                                                    $('#stock_maximo').val(stock_maximo);

                                                                    var precio_compra = "<?php echo $productos_dato['precio_compra']; ?>";
                                                                    $('#precio_compra').val(precio_compra);

                                                                    var precio_venta = "<?php echo $productos_dato['precio_venta']; ?>";
                                                                    $('#precio_venta').val(precio_venta);

                                                                    var fecha_ingreso = "<?php echo $productos_dato['fecha_ingreso']; ?>";
                                                                    $('#fecha_ingreso').val(fecha_ingreso);

                                                                    var ruta_img = "<?php echo $URL . '/almacen/img_productos/' . $productos_dato['imagen']; ?>";
                                                                    $('#img_producto').attr({ src: ruta_img });

                                                                    $('#modal-buscar_producto').modal('toggle');
                                                                });
                                                            </script>
                                                        </td>
                                                        <td><?php echo $productos_dato['codigo']; ?></td>
                                                        <td><?php echo $productos_dato['categoria']; ?></td>
                                                        <td>
                                                            <img src="<?php echo $URL . "/almacen/img_productos/" . $productos_dato['imagen']; ?>"
                                                                width="50px" alt="imagen_producto">
                                                        </td>
                                                        <td><?php echo $productos_dato['nombre']; ?></td>
                                                        <td><?php echo $productos_dato['descripcion']; ?></td>
                                                        <td><?php echo $productos_dato['stock']; ?></td>
                                                        <td><?php echo $productos_dato['precio_compra']; ?></td>
                                                        <td><?php echo $productos_dato['precio_venta']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot></tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>


                    <!-- modal para visualizar datos de los clientes -->
                    <div class="modal fade" id="modal-buscar_cliente">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #1d36b6;color: white">
                                    <h4 class="modal-title">Búsqueda de clientes</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="table table-responsive">
                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <center>Nro</center>
                                                    </th>
                                                    <th>
                                                        <center>Seleccionar</center>
                                                    </th>
                                                    <th>
                                                        <center>Nombre del Cliente</center>
                                                    </th>
                                                    <th>
                                                        <center>Cédula</center>
                                                    </th>
                                                    <th>
                                                        <center>Teléfono</center>
                                                    </th>
                                                    <th>
                                                        <center>Email</center>
                                                    </th>
                                                    <th>
                                                        <center>Dirección</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $contador = 0;
                                                foreach ($clientes_datos as $clientes_dato) {
                                                    $contador++;
                                                    $id_cliente = $clientes_dato['id_cliente'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <center><?php echo $contador; ?></center>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info"
                                                                id="btn_seleccionar_<?php echo $id_cliente; ?>">
                                                                Seleccionar
                                                            </button>
                                                        </td>
                                                        <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                                        <td><?php echo $clientes_dato['cedula']; ?></td>
                                                        <td><?php echo $clientes_dato['telefono']; ?></td>
                                                        <td><?php echo $clientes_dato['email']; ?></td>
                                                        <td><?php echo $clientes_dato['direccion']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="modal-">
                                            <button class="btn btn-danger" id="btn_consumidor_final">Consumidor
                                                Final</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <br>
                    <table class="table table-bordered">
                        <tbody id="productosTabla">
                            <tr>
                                <td>
                                    <center>Nro</center>
                                </td>
                                <td>
                                    <center>Seleccionar</center>
                                </td>
                                <td>
                                    <center>Código</center>
                                </td>
                                <td>
                                    <center>Nombre del producto</center>
                                </td>
                                <td>
                                    <center>Cantidad</center>
                                </td>
                                <td>
                                    <center>Precio venta</center>
                                </td>
                            </tr>
                            <div class="form-group" hidden>
                                <input type="text" id="id_producto">
                                <label for="">Código:</label>
                                <input type="text" class="form-control" id="codigo" disabled>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" hidden>
                                    <label for="">Nombre del producto:</label>
                                    <input type="text" name="nombre" id="nombre_producto" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Cantidad:</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control"
                                        oninput="actualizarSubtotal()">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group" hidden>
                                    <label for="">Precio venta:</label>
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control"
                                        disabled>
                                </div>
                            </div>


                        </tbody>
                    </table>
                </div>



                <div class="col-md-4">
                    <div class="form-group">
                        <?php
                        $contador_de_ventas = 1;
                        foreach ($ventas_datos as $ventas_dato) {
                            $contador++;
                        }
                        ?>
                        <label for="nro_ventas">Nro. de factura</label>
                        <input type="text" value="<?php echo $contador_de_ventas; ?>" style="text-align: center"
                            class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="fechaVenta">Fecha</label>
                        <input type="date" id="fechaVenta" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" value="<?php echo $nombres_sesion; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Cliente</label>
                        <input type="text" name="nombre" id="nombre_cliente" class="form-control"
                            placeholder="Seleccione un Cliente" disabled>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#modal-buscar_cliente">+</button>
                        <small style="color: red; display: none;" id="lbl_direccion">* Este campo es requerido</small>
                    </div>
                    <div class="form-group">
                        <label for="totalPagado">Total pagado por cliente</label>
                        <input type="number" id="totalPagado" class="form-control" oninput="calcularCambio()">
                    </div>
                    <div class="form-group">
                        <label for="cambioDevuelto">Cambio devuelto al cliente</label>
                        <input type="number" id="cambioDevuelto" class="form-control" readonly>
                    </div>
                    <div class="total-section">
                        <h3>IVA: <span id="iva">0.00</span></h3>
                    </div>
                    <div class="total-section">
                        <h3>TOTAL A PAGAR: <span id="totalAPagar">0.00 USD</span></h3>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" id="guardarVenta">Guardar venta</button>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>
<script>
    $(document).ready(function () {
        let contador = 0;

        // Manejar la selección del cliente
        <?php foreach ($clientes_datos as $clientes_dato): ?>
            $('#btn_seleccionar_<?php echo $clientes_dato['id_cliente']; ?>').click(function () {
                var id_cliente = "<?php echo $clientes_dato['id_cliente']; ?>";
                var cedula = "<?php echo $clientes_dato['cedula']; ?>";
                var nombre_cliente = "<?php echo $clientes_dato['nombre_cliente']; ?>";
                var telefono = "<?php echo $clientes_dato['telefono']; ?>";
                var email = "<?php echo $clientes_dato['email']; ?>";
                var direccion = "<?php echo $clientes_dato['direccion']; ?>";

                $('#id_cliente').val(id_cliente);
                $('#cedula').val(cedula);
                $('#nombre_cliente').val(nombre_cliente);
                $('#telefono').val(telefono);
                $('#email').val(email);
                $('#direccion').val(direccion);

                $('#modal-buscar_cliente').modal('toggle');
            });
        <?php endforeach; ?>

        // Manejar el botón "Consumidor Final"
        $('#btn_consumidor_final').click(function () {
            $('#id_cliente').val('0');
            $('#cedula').val('9999999999');
            $('#nombre_cliente').val('Consumidor Final');
            $('#telefono').val('9999999999');
            $('#email').val('##########');
            $('#direccion').val('Amabto');

            $('#modal-buscar_cliente').modal('toggle');
        });

        // Validación del formulario
        $('#guardarVenta').on('click', function (e) {
            var isValid = true;
            $('#nombre_cliente, #totalPagado').each(function () {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).next('small').show();
                } else {
                    $(this).next('small').hide();
                }
            });

            if (!isValid) {
                e.preventDefault();
                Swal.fire({
                    title: 'Campos incompletos',
                    text: 'Por favor, complete todos los campos obligatorios.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            }
        });

        // Manejar la selección de productos
        <?php foreach ($productos_datos as $productos_dato): ?>
            $('#btn_seleccionar<?php echo $productos_dato['id_producto']; ?>').click(function () {
                var id_producto = "<?php echo $productos_dato['id_producto']; ?>";
                var codigo = "<?php echo $productos_dato['codigo']; ?>";
                var nombre_producto = "<?php echo $productos_dato['nombre']; ?>";
                var precio_venta = "<?php echo $productos_dato['precio_venta']; ?>";

                // Actualizar los campos del producto
                $('#id_producto').val(id_producto);
                $('#codigo').val(codigo);
                $('#nombre_producto').val(nombre_producto);
                $('#precio_venta').val(precio_venta);

                $('#modal-buscar_producto').modal('toggle');
            });
        <?php endforeach; ?>

        // Función para agregar producto a la tabla
        function agregarProductoATabla(id_producto, codigo, nombre_producto, cantidad, precio_venta) {
            contador++;
            $('#productosTabla').append(`
            <tr data-id="${id_producto}">
                <td><center>${contador}</center></td>
                <td><button class="btn btn-danger eliminarProducto" data-contador="${contador}">Eliminar</button></td>
                <td>${codigo}</td>
                <td>${nombre_producto}</td>
                <td><input type="number" class="cantidad" value="${cantidad}" onchange="calcularTotalAPagar()"></td>
                <td class="precio_venta">${precio_venta}</td>
            </tr>
        `);
            calcularTotalAPagar(); // Actualiza el total al agregar un producto
        }

        // Almacenar la cantidad seleccionada y agregar el producto a la tabla
        $('#cantidad').on('change', function () {
            var cantidad = $(this).val();
            $('#cantidad').val('');
            var id_producto = $('#id_producto').val();
            var codigo = $('#codigo').val();
            var nombre_producto = $('#nombre_producto').val();
            var precio_venta = $('#precio_venta').val();

            if (cantidad && id_producto) {
                agregarProductoATabla(id_producto, codigo, nombre_producto, cantidad, precio_venta);
                $('#modal-buscar_producto').modal('toggle'); // Cerrar el modal
            } else {
                Swal.fire({
                    title: 'Producto no seleccionado',
                    text: 'Por favor, selecciona un producto y una cantidad.',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar'
                });
            }
        });

        // Eliminar producto de la tabla
        $(document).on('click', '.eliminarProducto', function () {
            $(this).closest('tr').remove();
            contador--;
            calcularTotalAPagar(); // Actualiza el total al eliminar un producto
        });

        // Función para calcular el total a pagar y el cambio
        window.calcularTotalAPagar = function () {
            let total = 0;
            const filas = $('#productosTabla tr');

            filas.each(function () {
                const cantidad = parseInt($(this).find('.cantidad').val()) || 0;
                const precio = parseFloat($(this).find('.precio_venta').text()) || 0; // Asegúrate de que este selector sea correcto
                total += cantidad * precio;
            });

            const iva = total * 0.15; // 15% de IVA
            const totalAPagar = total + iva;

            $('#iva').text(iva.toFixed(2));
            $('#totalAPagar').text(totalAPagar.toFixed(2) + " USD");

            calcularCambio(); // Recalcula el cambio después de calcular el total
        };

        // Función para calcular el cambio devuelto
        function calcularCambio() {
            const totalPagado = parseFloat($("#totalPagado").val()) || 0; // Captura el total pagado
            const totalAPagar = parseFloat($("#totalAPagar").text()) || 0; // Captura el total a pagar
            const cambioDevuelto = totalPagado - totalAPagar; // Calcula el cambio

            // Muestra el cambio devuelto, asegurándose de que no sea negativo
            $("#cambioDevuelto").val(cambioDevuelto >= 0 ? cambioDevuelto.toFixed(2) : 0);
        }

        // Evento para calcular el cambio cuando se ingresa un total pagado
        $("#totalPagado").on("input", calcularCambio);

        // Manejar el botón "Guardar venta"
        $("#guardarVenta").on("click", function () {
            const ventasData = {
                nro_factura: document.querySelector("input[value='<?php echo $contador_de_ventas; ?>']").value,
                fecha: document.getElementById("fechaVenta").value,
                id_usuario: document.querySelector("input[value='<?php echo $nombres_sesion; ?>']").value,
                id_cliente: document.getElementById("nombre_cliente").value,
                total_pagado: parseFloat($("#totalPagado").val()) || 0,
                cambio_devuelto: parseFloat($("#cambioDevuelto").val()) || 0,
                productos: []
            };

            $('#productosTabla tr').each(function () {
                const cantidad = parseInt($(this).find('.cantidad').val()) || 0;
                const id_producto = $(this).data('id');
                const producto = {
                    id: id_producto,
                    cantidad: cantidad,
                };
                ventasData.productos.push(producto);
            });

            console.log("Datos de la venta:", ventasData);

            // Enviar la información al servidor usando AJAX
            $.ajax({
                url: '../app/controllers/ventas/registrar_ventas.php',
                type: 'POST',
                data: JSON.stringify(ventasData), // Serializar datos a JSON
                contentType: 'application/json', // Establecer tipo de contenido a JSON
                success: function (response) {
                    // Mostrar un mensaje de éxito con un icono de guardado
                    Swal.fire({
                        title: 'Venta Guardada',
                        text: 'La venta ha sido registrada correctamente.',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirigir a la página de ventas
                            window.location.href = "<?php echo $URL; ?>/ventas/index.php";
                        }
                    });
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error al guardar la venta. Por favor, inténtalo nuevamente.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        });

    });
</script>