<?php
session_start();
session_destroy(); // Eliminar todas las variables de sesión y destruir la sesión
setcookie('total_operaciones', '', time() - 3600); // Eliminar la cookie de total de operaciones
header('Location: formulario.php'); // Redirigir al formulario después de reiniciar
exit();
