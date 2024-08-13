<?php
/*---------- 
*  author  : Marlon Vargas
*  version : 1.0
----------*/

include('../../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ruc'], $_POST['nombre'], $_POST['telefono'], $_POST['direccion'], $_POST['email'], $_POST['iva'])) {
        $id_ruc = $_POST['ruc'];
        $nombre_empresa = $_POST['nombre'];
        $telefono = $_POST['telefono'];  // Asegúrate de que la columna en la base de datos se llame 'telefono'
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $iva = $_POST['iva'];

        $empresa_foto = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $nombreDelArchivo = $nombre_empresa ;
            $filename = $nombreDelArchivo . "__" . $image['name'];
            $location = "../../../configuracion/img/" . $filename;

            // Verifica que el directorio exista
            if (!is_dir("../../../configuracion/img/")) {
                mkdir("../../../configuracion/img/", 0777, true);
            }

            if (move_uploaded_file($image['tmp_name'], $location)) {
                $empresa_foto = $filename;
            } else {
                $_SESSION['mensaje'] = "Error: no se pudo subir la imagen";
                $_SESSION['icono'] = "error";
                header('Location: '.$URL.'/configuracion/create.php');
                exit();
            }
        }

        error_log("ID RUC: $id_ruc, Nombre Empresa: $nombre_empresa, Teléfono: $telefono, Dirección: $direccion, Email: $email, IVA: $iva, Foto: $empresa_foto");
        
        $sentencia = $pdo->prepare("INSERT INTO tb_empresa (id_ruc, nombre_empresa, telefono, direccion, email, iva, empresa_foto) 
                                    VALUES (:id_ruc, :nombre_empresa, :telefono, :direccion, :email, :iva, :empresa_foto)");

        $sentencia->bindParam(':id_ruc', $id_ruc);
        $sentencia->bindParam(':nombre_empresa', $nombre_empresa);
        $sentencia->bindParam(':telefono', $telefono);  
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':iva', $iva);
        $sentencia->bindParam(':empresa_foto', $empresa_foto);

        if ($sentencia->execute()) {
            $_SESSION['mensaje'] = "Se registró la empresa de la manera correcta";
            $_SESSION['icono'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos";
            $_SESSION['icono'] = "error";
        }
        header('Location: '.$URL.'/configuracion/create.php');
    } else {
        $_SESSION['mensaje'] = "Error: faltan datos requeridos";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/configuracion/create.php');
    }
} else {
    $_SESSION['mensaje'] = "Error: solicitud inválida";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/configuracion/create.php');
}
