<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>

<?php
// Verificar el tipo de error y mostrar el mensaje adecuado
if (isset($_GET['error'])) {
    $error = $_GET['error'];

    switch ($error) {
        case 'invalid_numbers':
            echo "<h1>Error: Los valores ingresados deben ser numéricos.</h1>";
            break;
        case 'division':
            echo "<h1>Error: No se puede dividir por cero.</h1>";
            break;
        case 'invalid_operation':
            echo "<h1>Error: Operación inválida.</h1>";
            break;
        default:
            echo "<h1>Error desconocido.</h1>";
    }
} else {
    echo "<h1>Error: No se ha especificado ningún error.</h1>";
}
?>

<a href="formulario.php">Volver al formulario</a>

</body>
</html>
