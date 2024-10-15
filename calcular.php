<?php
session_start(); // Iniciar la sesión

// Inicializar el historial de operaciones en sesión si no existe
if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = array();
}

// Verificar si la cookie 'total_operaciones' existe, si no, inicializarla
if (!isset($_COOKIE['total_operaciones'])) {
    setcookie('total_operaciones', 1, time() + 3600); // Inicializar en 1
} else {
    $total_operaciones = $_COOKIE['total_operaciones'] + 1;
    setcookie('total_operaciones', $total_operaciones, time() + 3600); // Incrementar cookie
}

// Funciones matemáticas
function sumar($a, $b) {
    return $a + $b;
}

function restar($a, $b) {
    return $a - $b;
}

function multiplicar($a, $b) {
    return $a * $b;
}

function dividir($a, $b) {
    if ($b != 0) {
        return $a / $b;
    } else {
        header('Location: error.php?error=division'); // Redirigir en caso de división por cero
        exit();
    }
}

// Validar que ambos números sean numéricos
if (!is_numeric($_POST['num1']) || !is_numeric($_POST['num2'])) {
    header('Location: error.php?error=invalid_numbers'); // Redirigir si no son numéricos
    exit();
}

// Obtener los datos del formulario
$operacion = $_POST['operation'];
$num1 = (float)$_POST['num1'];
$num2 = (float)$_POST['num2'];
$resultado = 0;
$operacion_mostrar = "";

// Realizar la operación según la selección del usuario
switch ($operacion) {
    case 'sumar':
        $resultado = sumar($num1, $num2);
        $operacion_mostrar = '+';
        break;
    case 'restar':
        $resultado = restar($num1, $num2);
        $operacion_mostrar = '-';
        break;
    case 'multiplicar':
        $resultado = multiplicar($num1, $num2);
        $operacion_mostrar = '*';
        break;
    case 'dividir':
        $resultado = dividir($num1, $num2);
        $operacion_mostrar = '/';
        break;
    default:
        header('Location: error.php?error=invalid_operation'); // Si la operación no es válida
        exit();
}

// Guardar la operación en el historial de la sesión
$_SESSION['historial'][] = "$num1 $operacion_mostrar $num2 = $resultado";

// Mostrar el resultado y el historial
echo "<h1>Resultado: $resultado</h1>";
echo "<h2>Historial de operaciones:</h2>";
foreach ($_SESSION['historial'] as $operacion) {
    echo ($operacion) . "<br>";
}

// Mostrar el total de operaciones realizadas (guardado en la cookie)
echo "<h2>Total de operaciones: " . ($_COOKIE['total_operaciones']) . "</h2>";

// Mostrar información adicional del servidor
$ip_cliente = $_SERVER['REMOTE_ADDR'];
$nombre_servidor = $_SERVER['SERVER_NAME'];

echo "<p>Dirección IP del cliente: " .($ip_cliente) . "</p>";
echo "<p>Nombre del servidor: " . ($nombre_servidor) . "</p>";

echo "<a href='formulario.php'>Volver</a>"; // Enlace para volver al formulario
?>
