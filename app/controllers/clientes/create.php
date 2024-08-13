<?php
/*---------- 
*  author  : Marlon Vargas
*  version : 1.0
----------*/

include('../../config.php');
session_start();

function validarCedula($cedula) {
    if (strlen($cedula) !== 10 || !ctype_digit($cedula)) {
        return false;
    }

    $digito_region = substr($cedula, 0, 2);
    if ($digito_region < 1 || $digito_region > 24) {
        return false;
    }

    $ultimo_digito = substr($cedula, 9, 1);
    $pares = (int)$cedula[1] + (int)$cedula[3] + (int)$cedula[5] + (int)$cedula[7];
    
    $numero1 = (int)$cedula[0] * 2;
    if ($numero1 > 9) { $numero1 -= 9; }
    
    $numero3 = (int)$cedula[2] * 2;
    if ($numero3 > 9) { $numero3 -= 9; }
    
    $numero5 = (int)$cedula[4] * 2;
    if ($numero5 > 9) { $numero5 -= 9; }
    
    $numero7 = (int)$cedula[6] * 2;
    if ($numero7 > 9) { $numero7 -= 9; }
    
    $numero9 = (int)$cedula[8] * 2;
    if ($numero9 > 9) { $numero9 -= 9; }
    
    $impares = $numero1 + $numero3 + $numero5 + $numero7 + $numero9;
    $suma_total = $pares + $impares;
    
    $primer_digito_suma = (int)substr($suma_total, 0, 1);
    $decena = ($primer_digito_suma + 1) * 10;
    $digito_validador = $decena - $suma_total;

    if ($digito_validador == 10) { $digito_validador = 0; }
    
    return $digito_validador == $ultimo_digito;
}

function setSessionMessage($message, $icon) {
    $_SESSION['mensaje'] = $message;
    $_SESSION['icono'] = $icon;
}

function redirectTo($url) {
    header('Location: ' . $url);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_cliente = $_POST['nombre_cliente'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];

    if (!validarCedula($cedula)) {
        setSessionMessage("Error: La cédula no es válida", "error");
        redirectTo($URL . '/clientes');
    }

    // Verificar si la cédula ya existe en la base de datos
    $query = "SELECT * FROM tb_clientes WHERE cedula = :cedula";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':cedula', $cedula, PDO::PARAM_STR);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        setSessionMessage("Error: La cédula ya existe en la base de datos", "error");
        redirectTo($URL . '/clientes');
    }

    // Obtener la fecha y hora actuales
    $fechaHora = date('Y-m-d H:i:s');

    $sentencia = $pdo->prepare("INSERT INTO tb_clientes
           (nombre_cliente, cedula, telefono, email, direccion, fyh_creacion, fyh_actualizacion) 
    VALUES (:nombre_cliente, :cedula, :telefono, :email, :direccion, :fyh_creacion, :fyh_actualizacion)");

    $sentencia->bindParam(':nombre_cliente', $nombre_cliente);
    $sentencia->bindParam(':cedula', $cedula);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':direccion', $direccion);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);

    if ($sentencia->execute()) {
        setSessionMessage("Se registró al cliente de la manera correcta", "success");
    } else {
        setSessionMessage("Error: no se pudo registrar en la base de datos", "error");
    }
    redirectTo($URL . '/clientes');
} else {
    setSessionMessage("Error: solicitud inválida", "error");
    redirectTo($URL . '/clientes');
}
