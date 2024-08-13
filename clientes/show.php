<?php
include ('../../app/config.php');

$id_cliente = $_GET['id_cliente'];

//$stmt = $pdo->prepare('UPDATE `tb_clientes` SET `id_cliente`='[value-1]',`nombre_cliente`='[value-2]',`cedula`='[value-3]',`telefono`='[value-4]',`email`='[value-5]',
//`direccion`='[value-6]',`fyh_creacion`='[value-7]',`fyh_actualizacion`='[value-8]'');
$stmt->execute([$id_cliente]);

header('Location: ../../listado_de_clientes.php');
