<?php
// Ruta del archivo JSON donde se guardarán las propinas
$jsonFile = 'propinas.json';

// Leer las propinas guardadas (si existen)
if (file_exists($jsonFile)) {
    $propinas = json_decode(file_get_contents($jsonFile), true);
} else {
    $propinas = [];
}

// Manejo del formulario y registro de propinas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $fecha = date('Y-m-d');  // Fecha actual
    $monto = $_POST['monto'];

    // Crear un array con los datos de la nueva propina
    $nueva_propina = [
        'id_usuario' => $id_usuario,
        'fecha' => $fecha,
        'monto' => $monto
    ];

    // Agregar la nueva propina al array
    $propinas[] = $nueva_propina;

    // Guardar los datos actualizados en el archivo JSON
    file_put_contents($jsonFile, json_encode($propinas, JSON_PRETTY_PRINT));

    // Generar el PDF con los datos de la propina
    require('fpdf/fpdf.php');  // Librería para generar el PDF
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

    // Guardar el PDF en el servidor
    $pdf->Output('F', 'propinas/propina_' . $id_usuario . '.pdf');

    // Enviar el ticket a la impresora
    $ticket = "ID Usuario: $id_usuario\nFecha: $fecha\nMonto: $monto\n";
    file_put_contents('ticket.txt', $ticket);
    
    // Enviar el archivo a la impresora en Windows (como ejemplo)
    // shell_exec('notepad /p ticket.txt'); // Esto imprimirá el archivo con la impresora predeterminada de Windows
}
?>

<!-- Formulario para ingresar las propinas -->
<form action="index.php" method="POST">
    <label for="id_usuario">ID Usuario:</label>
    <input type="number" name="id_usuario" required><br>
    
    <label for="monto">Monto:</label>
    <input type="number" name="monto" step="0.01" required><br>
    
    <button type="submit">Registrar Propina</button>
</form>

<!-- Mostrar las propinas registradas -->
<?php
if (count($propinas) > 0) {
    echo "<h2>Propinas Registradas:</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID Usuario</th><th>Fecha</th><th>Monto</th></tr>";
    foreach ($propinas as $propina) {
        echo "<tr><td>" . $propina['id_usuario'] . "</td><td>" . $propina['fecha'] . "</td><td>" . $propina['monto'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No hay propinas registradas.";
}
?>
