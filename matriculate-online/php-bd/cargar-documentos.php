<?php
require 'conexion.php';

try {
    $stmt = $pdo->prepare("SELECT doc_nmb, precio FROM documentos");
    $stmt->execute();

    $documentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($documentos);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>