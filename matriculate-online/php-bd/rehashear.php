<?php
include 'conexion.php';

$sql = "SELECT id, usuario, contrasena FROM usuarios";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $id = $usuario['id'];
    $contrasena = $usuario['contrasena'];

    // Si la contraseña no está ya hasheada con password_hash, la rehasheamos
    if (strlen($contrasena) != 60 || substr($contrasena, 0, 1) != '$') {
        $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

        // Actualizar la base de datos con la contraseña hasheada
        $update_sql = "UPDATE usuarios SET contrasena = :contrasena WHERE id = :id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->execute([':contrasena' => $hashed_password, ':id' => $id]);
    }
}

echo "Contraseñas actualizadas correctamente.";
?>