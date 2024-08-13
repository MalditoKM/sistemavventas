<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/

// Definición de constantes para la conexión a la base de datos
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemadeventas');

// Configuración de la cadena de conexión
$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
    // Establecer la conexión a la base de datos
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configurar el modo de error
    //echo "La conexión a la base de datos fue con éxito";

} catch (PDOException $e) {
    // Manejo de errores en la conexión
    echo "Error al conectar a la base de datos: " . $e->getMessage(); // Mostrar mensaje de error
}

// URL base de la aplicación
$URL = "http://localhost/www.sistemadeventas.com";

// Establecer la zona horaria
date_default_timezone_set("America/Guayaquil");
$fechaHora = date('Y-m-d H:i:s');
