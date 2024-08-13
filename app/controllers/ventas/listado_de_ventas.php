<?php
/*---------- 
*  @author  : marlon vargas
*  @version : 1.0
----------*/

$sql_ventas = "SELECT * FROM tb_ventas";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);