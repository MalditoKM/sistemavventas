<?php
include ('../../app/config.php');

$id_cliente = $_GET['id_cliente'];

$stmt = $pdo->prepare('DELETE FROM tb_clientes WHERE id_cliente = ?');
$stmt->execute([$id_cliente]);

header('Location: ../../listado_de_clientes.php');
