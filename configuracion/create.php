<?php
/*---------- 
*  author  : Marlon Vargas
*  version : 1.0
----------*/

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registre la Empresa</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title">Llene los datos con cuidado</h5>
                        </div>
                        <div class="card-body">
                            <form action="../app/controllers/configuracion/create.php" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="empresa_nombre">Nombre <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="empresa_nombre" name="nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{4,85}" maxlength="85" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_ruc">RUC <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="id_ruc" name="ruc" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9()+]{8,20}" maxlength="20" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="email" id="email" name="email" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" id="direccion" name="direccion" maxlength="100" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="iva">IVA <span class="text-danger"></span>*</span></label>
                                            <input class="form-control" type="text" id="iva" name="iva" maxlength="5" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="empresa_foto">Logo de la Empresa<span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control" id="file">
                                    <br>
                                    <output id="list" style=""></output>
                                </div>
                                <div class="form-group text-center">
                                    <a href="create.php" class="btn btn-secondary"><i class="fas fa-paint-roller"></i> Limpiar</a>
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i> Guardar</button>
                                    <button type="update.php" class="btn btn-success">Actualizar </button>
                                </div>
                            </form>
                            <script>
                                function archivo(evt) {
                                    var files = evt.target.files; 
                                    for (var i = 0, f; f = files[i]; i++) {
                                        if (!f.type.match('image.*')) {
                                            continue;
                                        }
                                        var reader = new FileReader();
                                        reader.onload = (function (theFile) {
                                            return function (e) {
                                                document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="50%" title="', escape(theFile.name), '"/>'].join('');
                                            };
                                        })(f);
                                        reader.readAsDataURL(f);
                                    }
                                }
                                document.getElementById('file').addEventListener('change', archivo, false);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>
