<?php
session_start();
include 'conexion.php';

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

try {
    // Preparar la consulta SQL con parámetros nombrados
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($query);

    // Enlazar los parámetros
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Verificar la contraseña usando password_verify
        if (password_verify($contrasena, $row['contrasena'])) {
            // Guardar el usuario en la sesión
            $_SESSION['usuario'] = $usuario;

            // Obtener el tipo de usuario
            $tipo = $row['tipo'];

            // Redirigir según el tipo de usuario
            if ($tipo == "E") {
                header("Location: ../inicio_matriculate.php");
                exit;
            } else if ($tipo == "A") {
                header("Location: ../administrador/inicio-admin.php");
                exit;
            }
        } else {
            // Contraseña incorrecta
            echo '
                <script>
                    alert("Contraseña incorrecta");
                    window.location = "../../matriculate-online.php";
                </script>
            ';
            exit;
        }
    } else {
        // Usuario no encontrado
        echo '
            <script>
                alert("Usuario no existe");
                window.location = "../matriculate-online.php";
            </script>
        ';
        exit;
    }
} catch (PDOException $e) {
    // Error de base de datos
    echo "Error: " . $e->getMessage();
}
?>