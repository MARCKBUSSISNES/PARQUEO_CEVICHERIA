<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];

    $sql = "INSERT INTO propinas_diarias (id_usuario, fecha, monto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isd", $id_usuario, $fecha, $monto);

    if ($stmt->execute()) {
        echo "Propina registrada correctamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
