<?php
include 'db.php';
require('fpdf/fpdf.php');  // Librería FPDF para generar PDFs

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $fecha = date('Y-m-d');  // Fecha actual
    $monto = $_POST['monto'];

    // Insertar en la base de datos
    $sql = "INSERT INTO propinas_diarias (id_usuario, fecha, monto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $id_usuario, $fecha, $monto);

    if ($stmt->execute()) {
        echo "Propina registrada correctamente.<br>";

        // Generar PDF con la información de la propina
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(200, 10, 'Propina Registrada', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->Cell(50, 10, "ID Usuario: " . $id_usuario);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Fecha: " . $fecha);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Monto: " . $monto);
        $pdf->Ln(20);

        // Guardar el PDF en el servidor (puedes cambiar la ruta si lo deseas)
        $pdf->Output('F', 'propinas/' . "propina_$id_usuario.pdf");

        // Enviar el ticket a la impresora
        // Para esto necesitarías configurar un script en el servidor que pueda enviar la impresión al puerto de la impresora.
        // Esto generalmente se hace con herramientas de línea de comandos, como CUPS en Linux o configurando una impresora en Windows.
        // Aquí te dejo un ejemplo de cómo imprimir, pero ten en cuenta que necesitarás un sistema de impresión configurado en tu servidor.

        $ticket = "ID Usuario: $id_usuario\nFecha: $fecha\nMonto: $monto\n";
        file_put_contents('ticket.txt', $ticket);
        // Luego puedes usar un comando del sistema para imprimir desde PHP.
        // Ejemplo para Windows:
        // shell_exec('notepad /p ticket.txt'); // Enviar el archivo a la impresora predeterminada en Windows
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Formulario de ingreso de propinas -->
<form action="registro_propinas.php" method="POST">
    <label for="id_usuario">ID Usuario:</label>
    <input type="number" name="id_usuario" required><br>
    
    <label for="monto">Monto:</label>
    <input type="number" name="monto" step="0.01" required><br>
    
    <button type="submit">Registrar Propina</button>
</form>
