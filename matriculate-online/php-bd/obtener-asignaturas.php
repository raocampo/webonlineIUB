<?php

include 'conexion.php';

// Verificar si el usuario está logeado
if (!isset($_SESSION['usuario'])) {
    header("Location: matriculate-online.php");
    exit;
}

$usuario = $_SESSION['usuario'];

try {
    // Consultar las asignaturas y las claves del usuario logeado
    $query = "SELECT m.nmb_mtr, ma.clave 
              FROM matriculas AS ma
              JOIN materias AS m ON ma.id_nmbmtr = m.id
              WHERE ma.usuario = :usuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();

    $asignaturas = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>