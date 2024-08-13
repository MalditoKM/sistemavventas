<?php
/*---------- 
*  @author  : marlon vargas
*  @version : 1.0
----------*/

$sql_clientes = "SELECT * FROM tb_clientes ";
$query_clientes = $pdo->prepare($sql_clientes);
$query_clientes->execute();
$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);