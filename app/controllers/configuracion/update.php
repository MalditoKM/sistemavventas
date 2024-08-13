<?php
/*---------- 
*  author  : Marlon Vargas
*  version : 1.0
----------*/

include('../../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'], $_POST['ruc'], $_POST['nombre'], $_POST['telefono'], $_POST['direccion'], $_POST['email'], $_POST['iva'])) {
        $id = $_POST['id']; // ID del registro a actualizar
        $id_ruc = $_POST['ruc'];
        $nombre_empresa = $_POST['nombre'];
        $telefono = $_POST['telefono']; 
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $iva = $_POST['iva'];

        $empresa_foto = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $nombreDelArchivo = date("Y-m-d-H-i-s");
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
                header('Location: '.$URL.'/configuracion/update.php?id='.$id);
                exit();
            }
        }

        // Construye la consulta de actualización
        $query = "UPDATE tb_empresa SET id_ruc = :id_ruc, nombre_empresa = :nombre_empresa, telefono = :telefono, direccion = :direccion, email = :email, iva = :iva";
        if ($empresa_foto) {
            $query .= ", empresa_foto = :empresa_foto";
        }
        $query .= " WHERE id = :id";

        $sentencia = $pdo->prepare($query);

        $sentencia->bindParam(':id', $id);
        $sentencia->bindParam(':id_ruc', $id_ruc);
        $sentencia->bindParam(':nombre_empresa', $nombre_empresa);
        $sentencia->bindParam(':telefono', $telefono);
        $sentencia->bindParam(':direccion', $direccion);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':iva', $iva);
        if ($empresa_foto) {
            $sentencia->bindParam(':empresa_foto', $empresa_foto);
        }

        if ($sentencia->execute()) {
            $_SESSION['mensaje'] = "Se actualizó la empresa de la manera correcta";
            $_SESSION['icono'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error: no se pudo actualizar en la base de datos";
            $_SESSION['icono'] = "error";
        }
        header('Location: '.$URL.'/configuracion/update.php?id='.$id);
    } else {
        $_SESSION['mensaje'] = "Error: faltan datos requeridos";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/configuracion/update.php?id='.$id);
    }
} else {
    $_SESSION['mensaje'] = "Error: solicitud inválida";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/configuracion/update.php?id='.$id);
}
