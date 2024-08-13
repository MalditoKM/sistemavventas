<?php
/*---------- 
*  @author  : Marlon Vargas
*  @version : 1.0
----------*/

// Include the main TCPDF library (search for installation path).
require_once('../app/TCPDF-main/tcpdf.php');
include('../app/config.php');

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(80, 200), true, 'UTF-8', false); // Adjust dimensions for ticket

// Set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Marlon Vargas');
$pdf->setTitle('Tiquete de Venta');
$pdf->setSubject('Tiquete de Venta');
$pdf->setKeywords('Tiquete, Venta, PDF, TCPDF');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->setMargins(5, 5, 5);  // Reduce margins for ticket

// Set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);  // Reduce bottom margin

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set font
$pdf->setFont('dejavusans', '', 8); // Smaller font size for ticket

// Add a page
$pdf->AddPage();

// Add the logo of the company above the company details
$logo_path = '../configuracion/img/MARLON WEB.jpg'; // Replace with the correct path
if (file_exists($logo_path)) {
    $pdf->Image($logo_path, 30, 3, 20, '', 'jpg', '', 'T', true, 20, '', false, false, 0, false, false, false);
    $pdf->Ln(20); // Add space after logo
} else {
    $pdf->Cell(0, 10, 'Logo no encontrado', 0, 1, 'C');
}

// Combine the content
$html = '
<table width="100%" cellpadding="1" border="0" style="font-size: 8px; margin-top: 5px;">
    <tr>
        <td width="50%">
            <strong>Repuestos Cuello</strong><br>
            Dirección de la Empresa<br>
            Tel: (00) 123-4567<br>
            Email: info@empresa.com
        </td>
        <td width="50%" align="right">
            <strong>Factura: 001</strong><br>
            Fecha: 2024-08-08
        </td>
    </tr>
</table>

<p style="text-align: center; font-size: 12px; margin-top: 10px;"><strong>FACTURA</strong></p>

<table width="100%" cellpadding="2" border="0" style="font-size: 8px; margin-top: 5px;">
    <tr>
        <td width="50%" style="vertical-align: top;">
            <strong>Cédula:</strong> 1851042136<br>
            <strong>Nombre:</strong> Juan Pérez<br>
            <strong>Dirección:</strong> Calle Falsa 123
        </td>
        <td width="50%" style="vertical-align: top;">
            <strong>Teléfono:</strong> (00) 765-4321<br>
            <strong>Email:</strong> juan.perez@email.com
        </td>
    </tr>
</table>

<p></p>

<!-- Tabla de productos -->
<table width="100%" cellpadding="2" border="0" style="font-size: 6px; margin-top: 5px;">
    <tr>
        <th width="30px" style="text-align:center; background-color: #f2f2f2;"><strong>Nro</strong></th>
        <th width="50px"style="text-align:center; background-color: #f2f2f2;"><strong>Producto</strong></th>
        <th width="70px" style="text-align:center; background-color: #f2f2f2;"><strong>Descripción</strong></th>
        <th width="35px" style="text-align:center; background-color: #f2f2f2;"><strong>Cantidad</strong></th>
        <th width="40px" style="text-align:center; background-color: #f2f2f2;"><strong>Precio Unitario</strong></th>
        <th width="30px" style="text-align:center; background-color: #f2f2f2;"><strong>Sub Total</strong></th>
    </tr>
    <tr>
        <td style="text-align:center;">1</td>
        <td style="text-align:center;">vino</td>
        <td style="text-align:center;">1 litro de vino negro</td>
        <td style="text-align:center;">2</td>
        <td style="text-align:center;">$10.00</td>
        <td style="text-align:center;">$20.00</td>
    </tr>
    <tr>
        <td style="text-align:center;">2</td>
        <td style="text-align:center;">computador</td>
        <td style="text-align:center;">1 unidad de computador</td>
        <td style="text-align:center;">1</td>
        <td style="text-align:center;">$50.00</td>
        <td style="text-align:center;">$50.00</td>
    </tr>
</table>

<!-- Tabla de totales -->
<table width="100%" cellpadding="3" border="0" style="font-size: 8px; margin-top: 5px; border-top: 2px solid #000;">
    <tr>
        <td style="text-align:right;" colspan="5"><strong>Subtotal:</strong></td>
        <td style="text-align:center;">$70.00</td>
    </tr>
    <tr>
        <td style="text-align:right;" colspan="5"><strong>IVA (15%):</strong></td>
        <td style="text-align:center;">$10.50</td>
    </tr>
    <tr>
        <td style="text-align:right;" colspan="5"><strong>Total:</strong></td>
        <td style="text-align:center;"><strong>$80.50</strong></td>
    </tr>
</table>

<p style="text-align: center; font-size: 10px; margin-top: 10px;"><strong>¡Gracias por su compra!</strong></p>
';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Generate a random alphanumeric barcode value
function generateRandomBarcode($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $barcode = '';
    for ($i = 0; $i < $length; $i++) {
        $barcode .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
    return $barcode;
}

$barcode = generateRandomBarcode(); // Generate a random barcode value

// Output the barcode
$pdf->write1DBarcode($barcode, 'C128', '', '', '', 30, 0.4, array(
    'position' => 'C',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false,
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
), 'N');
$pdf->Ln(10); // Adjusted space

// Output the final PDF document
$pdf->Output('tiquete.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+
