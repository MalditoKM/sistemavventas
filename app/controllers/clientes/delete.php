<?php
/*---------- 
*  author  : Marlon Vargas
*  version : 1.0
----------*/

include('../../config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del cliente desde el POST y validar que sea un entero positivo
    $id_cliente = isset($_POST['id_cliente']) ? (int)$_POST['id_cliente'] : 0;

    if ($id_cliente > 0) {
        // Preparar y ejecutar la sentencia para eliminar el cliente
        $sentencia = $pdo->prepare("DELETE FROM tb_clientes WHERE id_cliente = :id_cliente");
        $sentencia->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);

        if ($sentencia->execute()) {
            $_SESSION['mensaje'] = "Se eliminó al cliente de la manera correcta";
            $_SESSION['icono'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error: no se pudo eliminar al cliente en la base de datos";
            $_SESSION['icono'] = "error";
        }
    } else {
        $_SESSION['mensaje'] = "Error: ID de cliente inválido";
        $_SESSION['icono'] = "error";
    }

    // Redirigir al usuario a la página de clientes
    header('Location: ' . $URL . '/clientes');
    exit();
} else {
    $_SESSION['mensaje'] = "Error: solicitud inválida";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/clientes');
    exit();
}
?>
