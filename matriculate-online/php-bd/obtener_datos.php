<?php
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$usuario = null;
$usuario_domc = null;
$usuario_pgsp = null;
$usuario_pgsa = null;

if (isset($_SESSION['usuario'])) {
    $usuario_nombre = $_SESSION['usuario'];

    // Usar una declaración preparada para evitar inyección SQL
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->execute([$usuario_nombre]);
    $usuario = $stmt->fetch();

    // Consulta para obtener datos de la tabla usu_dmc
    $stmt_dmc = $pdo->prepare("SELECT * FROM usu_dmc WHERE usuario = ?");
    $stmt_dmc->execute([$usuario_nombre]);
    $usuario_dmc = $stmt_dmc->fetch();

    // Consulta para obtener datos de la tabla fnc_pgsp
    $stmt_pgsp = $pdo->prepare("SELECT * FROM fnc_pgsp WHERE usuario = ?");
    $stmt_pgsp->execute([$usuario_nombre]);
    $usuario_pgsp = $stmt_pgsp->fetch();

    // Consulta para obtener datos de la tabla fnc_pgsa
    $stmt_pgsa = $pdo->prepare("SELECT * FROM fnc_pgsa WHERE usuario = ?");
    $stmt_pgsa->execute([$usuario_nombre]);
    $usuario_pgsa = $stmt_pgsa->fetch();

} else {
    // Sin sesión: redirigir al login
    header('Location: /matriculate-online.php');
    exit;
}
?>