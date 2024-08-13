<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/

// Incluir el archivo de configuración
include ('../../config.php');


// Verificar si la conexión se estableció correctamente
if (!isset($pdo)) {
    echo json_encode(["success" => false, "message" => "Error: no se pudo establecer conexión a la base de datos."]);
    exit;
}



// Recibir y decodificar los datos JSON enviados
$data = json_decode(file_get_contents('php://input'), true);

$nro_factura = $data['nro_factura'] ?? 0;
$nro_ventas = $data['nro_venta'] ?? 0;
$id_cliente = $data['id_cliente'] ?? 0;
$id_usuario = $data['id_usuario'] ?? 0;
$total_pagado = $data['total_pagado'] ?? 0;
$productos = $data['productos'] ?? [];
$fecha_ingreso = date('Y-m-d H:i:s');


// Iniciar una transacción para asegurar que ambas inserciones se realizan correctamente
$pdo->beginTransaction();

try {
    // Preparar la sentencia SQL para la inserción en tb_ventas
    $sentencia = $pdo->prepare("INSERT INTO tb_ventas 
        (nro_venta,id_producto, id_cliente, id_usuario, total_pagado, fyh_creacion) 
        VALUES (:nro_venta, :id_cliente, :id_usuario, :total_pagado, :fyh_creacion)");

    // Vincular los parámetros con los valores correspondientes
    $sentencia->bindParam(':nro_venta', $nro_ventas);
    $sentencia->bindParam(':id_cliente', $id_cliente);
    $sentencia->bindParam(':id_producto,', $id_producto,);
    $sentencia->bindParam(':id_usuario', $id_usuario);
    $sentencia->bindParam(':total_pagado', $total_pagado);
    $sentencia->bindParam(':fyh_creacion', $fecha_ingreso);

    // Ejecutar la sentencia para insertar en tb_ventas
    $sentencia->execute();

    // Obtener el ID de la venta recién insertada
    $id_venta = $pdo->lastInsertId();

    // Insertar cada producto en la tabla tb_detalle_ventas
    $detalleSentencia = $pdo->prepare("INSERT INTO tb_detalle_ventas 
        (id_venta, id_producto, cantidad) 
        VALUES (:id_venta, :id_producto, :cantidad)");

    foreach ($productos as $producto) {
        // Establecer id_producto a 0 por defecto si no está definido
        $id_producto = $producto['id'] ?? 0; // Si no se define, se usa 0
        $cantidad = $producto['cantidad'] ?? 0; // Puedes establecer una cantidad por defecto si lo deseas

        // Vincular los parámetros antes de cada ejecución
        $detalleSentencia->bindParam(':id_venta', $id_venta);
        $detalleSentencia->bindParam(':id_producto', $id_producto); // Usar la variable id_producto aquí
        $detalleSentencia->bindParam(':cantidad', $cantidad);
        $detalleSentencia->execute();
    }

    // Confirmar la transacción
    $pdo->commit();

    echo json_encode(["success" => true, "message" => "Venta registrada con éxito"]);
} catch (Exception $e) {
    // Si ocurre un error, deshacer la transacción
    $pdo->rollBack();

    echo json_encode(["success" => false, "message" => "Error: no se pudo registrar en la base de datos. " . $e->getMessage()]);
}