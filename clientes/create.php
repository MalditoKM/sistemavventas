<?php
include ('../../app/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $_POST['cedula'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $celular = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    $stmt = $pdo->prepare('INSERT INTO tb_clientes (cedula, nombre_cliente, telefono, email, direccion) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$cedula, $nombre_cliente, $celular, $email, $direccion]);

    header('Location: ../../listado_de_clientes.php');
}
