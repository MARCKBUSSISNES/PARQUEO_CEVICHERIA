<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propinas Diarias</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Registro de Propinas</h1>
    <form action="registro_propinas.php" method="POST">
        <label for="id_usuario">ID Usuario:</label>
        <input type="number" name="id_usuario" required><br>
        
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required><br>
        
        <label for="monto">Monto:</label>
        <input type="number" name="monto" step="0.01" required><br>
        
        <button type="submit">Registrar Propina</button>
    </form>
</body>
</html>
