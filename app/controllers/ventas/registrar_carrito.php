?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/


include('../app/config.php');


$nro_ventas = $_GET['nro_ventas'];
$id_usuario = $_GET['id_usuario'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];
$total_pagado = $_GET['total_pagado'];
$fecha_ingreso = date('Y-m-d H:i:s');

// Preparar la sentencia SQL para la inserción
$sentencia = $pdo->prepare("INSERT INTO tb_carrito 
    (nro_ventas, id_usuario, id_producto, cantidad, total_pagado, fyh_creacion) 
    VALUES (:nro_ventas, :id_usuario, :id_producto, :cantidad, :total_pagado, :fyh_creacion)");

// Vincular los parámetros con los valores correspondientes
$sentencia->bindParam(':nro_ventas', $nro_ventas);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':total_pagado', $total_pagado);
$sentencia->bindParam(':fyh_creacion', $fecha_ingreso);

if ($sentencia->execute()) {
    echo "<script>
        location.href = '" . $URL . "/ventas/create.php';
    </script>";
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";

    echo "<script>
        location.href = '" . $URL . "/ventas/create.php';
    </script>";
}