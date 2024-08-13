<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/

include('../../config.php');
session_start();

$id_cliente = $_GET['id_cliente'];
$nombre_cliente = $_GET['nombre_proveedor'];
$telefono = $_GET['telefono'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];

// Obtener la fecha y hora actuales
$fechaHora = date('Y-m-d H:i:s');

// Preparar la sentencia de actualización
$sentencia = $pdo->prepare("UPDATE tb_clientes
    SET nombre_cliente = :nombre_cliente,
        telefono = :telefono,
        email = :email,
        direccion = :direccion,
        fyh_actualizacion = :fyh_actualizacion 
    WHERE id_cliente = :id_cliente");

$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':telefono', $telefono);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':direccion', $direccion);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_cliente', $id_cliente);

if ($sentencia->execute()) {
    $_SESSION['mensaje'] = "Se actualizó al cliente de la manera correcta";
    $_SESSION['icono'] = "success";
} else {
    $_SESSION['mensaje'] = "Error: no se pudo actualizar el cliente en la base de datos";
    $_SESSION['icono'] = "error";
}

// Redireccionar a la página de clientes
header('Location: ' . $URL . '/clientes');
exit();
