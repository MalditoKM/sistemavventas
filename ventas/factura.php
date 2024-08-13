<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/

// Include the main TCPDF library (search for installation path).
require_once('../app/TCPDF-main/tcpdf.php');
include('../app/config.php');

session_start();
if(isset($_SESSION['sesion_email'])){
    // echo "si existe sesion de ".$_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];
    $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                  FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol WHERE email='$email_sesion'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario){
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }
}else{
    echo "no existe sesion";
    header('Location: '.$URL.'/login');
}

$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];

// Query to get the sales and client information
$sql_ventas = "SELECT ve.*, cli.nombre_cliente, cli.cedula, cli.telefono, cli.direccion, cli.email 
               FROM tb_ventas AS ve 
               INNER JOIN tb_clientes AS cli 
               ON ve.id_cliente = cli.id_cliente 
               WHERE ve.id_venta = :id_venta_get";

$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->bindParam(':id_venta_get', $id_venta_get, PDO::PARAM_INT);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetch(PDO::FETCH_ASSOC);

$fyh_creacion = $ventas_datos['fyh_creacion'];
$cedula = $ventas_datos['cedula'];
$nombre_cliente = $ventas_datos['nombre_cliente'];
$direccion = $ventas_datos['direccion'];
$telefono = $ventas_datos['telefono'];
$email = $ventas_datos['email'];

$fecha = date("d/m/Y", strtotime($fyh_creacion));

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215, 279), true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Marlon Vargas');
$pdf->SetTitle('Factura de Venta');
$pdf->SetSubject('Factura de Venta');
$pdf->SetKeywords('Factura, Venta, PDF, TCPDF');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(10, 10, 10);  // Reduce margins

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 10);  // Reduce bottom margin

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$pdf->SetFont('dejavusans', '', 10);

// Add a page
$pdf->AddPage();

// Add the logo of the company

// Company details
$empresa_nombre = "Repuestos Cuello";
$empresa_direccion = "Dirección de la Empresa";
$empresa_telefono = "(00) 123-4567";
$empresa_email = "info@empresa.com";
$empresa_ruc = "12345678910";


// Combine the content
$html = '
<table width="100%" cellpadding="4" border="0" style="font-size: 12px; margin-top: 30px;">
    <tr>
        <td width="50%">
        <img src="../configuracion/img/marlon web.jpg" width="90px"alt=""><p>
            <h2>' . $empresa_nombre . '</h2>
            <br>
            Dirección: ' . $empresa_direccion . '<br>
            Teléfono: ' . $empresa_telefono . '<br>
            Email: ' . $empresa_email . '<br>
            Vendedor: '.$email_sesion.'
        </td>

        <td width="50%" align="right">
            <h2 style="margin: 0;">RUC: ' . $empresa_ruc . '</h2>  
            <h2 style="margin: 0;">Factura: ' . $nro_venta_get . '</h2>
            <p style="margin: 0;">Fecha: ' . $fecha . '</p>
        </td>
    </tr>
</table>

<p style="text-align: center; font-size: 20px;"><b>FACTURA</b></p>

<table width="100%" cellpadding="4" border="0" style="font-size: 12px; margin-top: 10px;">
    <tr>
        <td width="50%" style="vertical-align: top;">
            <p style="margin: 0;"><strong>Cédula:</strong> ' . $cedula . '</p>
            <p style="margin: 0;"><strong>Nombre:</strong> ' . $nombre_cliente . '</p>
            <p style="margin: 0;"><strong>Dirección:</strong> ' . $direccion . '</p>
        </td>
        <td width="50%" style="vertical-align: top;">
            <p style="margin: 0;"><strong>Teléfono:</strong> ' . $telefono . '</p>
            <p style="margin: 0;"><strong>Email:</strong> ' . $email . '</p>
        </td>
    </tr>
</table>

<p></p>

<!-- Tabla de productos -->
<table width="100%" cellpadding="4" border="1" style="font-size: 12px; margin-top: 10px;">
    <tr>
        <th width="35px" style="text-align:center; background-color: #f2f2f2;"><strong>Nro</strong></th>
        <th width="158px" style="text-align:center; background-color: #f2f2f2;"><strong>Producto</strong></th>
        <th width="280px" style="text-align:center; background-color: #f2f2f2;"><strong>Descripción</strong></th>
        <th width="70px" style="text-align:center; background-color: #f2f2f2;"><strong>Cantidad</strong></th>
        <th width="80px" style="text-align:center; background-color: #f2f2f2;"><strong>Precio Unitario</strong></th>
        <th width="70px" style="text-align:center; background-color: #f2f2f2;"><strong>Sub Total</strong></th>
    </tr>';

$contador_de_ventas = 0;
$cantidad_total = 0;
$precio_total = 0;
$iva = 0.15;  // 15% IVA

$sql_carrito = "SELECT pro.nombre AS nombre_producto, pro.descripcion, pro.precio_venta, carr.cantidad 
                FROM tb_carrito AS carr 
                INNER JOIN tb_almacen AS pro 
                ON carr.id_producto = pro.id_producto 
                WHERE carr.nro_venta = :nro_venta_get 
                ORDER BY carr.id_carrito ASC";

$query_carrito = $pdo->prepare($sql_carrito);
$query_carrito->bindParam(':nro_venta_get', $nro_venta_get, PDO::PARAM_STR);
$query_carrito->execute();
$carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

foreach ($carrito_datos as $carrito_dato) {
    $contador_de_ventas++;
    $subtotal = $carrito_dato['cantidad'] * $carrito_dato['precio_venta'];
    $precio_total += $subtotal;

    $html .= '
    <tr>
        <td style="text-align:center;">' . $contador_de_ventas . '</td>
        <td style="text-align:center;">' . $carrito_dato['nombre_producto'] . '</td>
        <td style="text-align:center;">' . $carrito_dato['descripcion'] . '</td>
        <td style="text-align:center;">' . $carrito_dato['cantidad'] . '</td>
        <td style="text-align:center;">' . $carrito_dato['precio_venta'] . '</td>
        <td style="text-align:center;">' . number_format($subtotal, 2) . '</td>
    </tr>';
}

$iva_calculado = $precio_total * $iva;
$precio_final = $precio_total + $iva_calculado;

$html .= '
</table>

<!-- Tabla de totales -->
<table width="100%" cellpadding="5" border="0" style="font-size: 12px; margin-top: 10px; border-top: 2px solid #000;">
    <tr>
        <td style="text-align:right;" colspan="5"><strong>Subtotal:</strong></td>
        <td style="text-align:center;"><strong>' . number_format($precio_total, 2) . '</strong></td>
    </tr>
    <tr>
        <td style="text-align:right;" colspan="5"><strong>IVA (15%):</strong></td>
        <td style="text-align:center;"><strong>' . number_format($iva_calculado, 2) . '</strong></td>
    </tr>
    <tr>
        <td style="text-align:right;" colspan="5"><strong>Total:</strong></td>
        <td style="text-align:center;"><strong>' . number_format($precio_final, 2) . '</strong></td>
    </tr>
</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('Factura_' . $nro_venta_get . '.pdf', 'I');
