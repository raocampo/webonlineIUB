<?php
// Incluir archivo de conexión a la base de datos o configuración
include 'conexion.php';

// Verificar si una sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para obtener el código de carrera del usuario logeado (sustituir con tu lógica real)
function obtenerCodigoCarreraDelUsuario($pdo)
{
    // Ejemplo de implementación: obtener el nombre de usuario desde la sesión
    if (isset($_SESSION['usuario'])) {
        $nombreUsuario = $_SESSION['usuario'];

        // Consulta para obtener el código de carrera del usuario
        $sql = "SELECT carrera FROM usuarios WHERE usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $nombreUsuario, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch();

        if ($resultado) {
            return $resultado['carrera'];
        } else {
            return null;
        }
    } else {
        // Si no se encuentra el código de carrera en la sesión, manejar el caso según tu aplicación
        return null; // Aquí puedes manejar el valor predeterminado o lanzar un error según tu lógica
    }
}

// Obtener el código de carrera del usuario logeado
$codigoCarrera = obtenerCodigoCarreraDelUsuario($pdo);

if ($codigoCarrera) {
    // Consultas para obtener las materias de cada semestre para la carrera del usuario logeado
    $sqlMateriasSem1 = "SELECT nmb_mtr FROM materias WHERE semestre = 1 AND cdg_carrera = ?";
    $stmtMateriasSem1 = $pdo->prepare($sqlMateriasSem1);
    $stmtMateriasSem1->bindValue(1, $codigoCarrera, PDO::PARAM_STR);
    $stmtMateriasSem1->execute();
    $materiasResultadoSem1 = $stmtMateriasSem1->fetchAll(PDO::FETCH_ASSOC);

    $sqlMateriasSem2 = "SELECT nmb_mtr FROM materias WHERE semestre = 2 AND cdg_carrera = ?";
    $stmtMateriasSem2 = $pdo->prepare($sqlMateriasSem2);
    $stmtMateriasSem2->bindValue(1, $codigoCarrera, PDO::PARAM_STR);
    $stmtMateriasSem2->execute();
    $materiasResultadoSem2 = $stmtMateriasSem2->fetchAll(PDO::FETCH_ASSOC);

    $sqlMateriasSem3 = "SELECT nmb_mtr FROM materias WHERE semestre = 3 AND cdg_carrera = ?";
    $stmtMateriasSem3 = $pdo->prepare($sqlMateriasSem3);
    $stmtMateriasSem3->bindValue(1, $codigoCarrera, PDO::PARAM_STR);
    $stmtMateriasSem3->execute();
    $materiasResultadoSem3 = $stmtMateriasSem3->fetchAll(PDO::FETCH_ASSOC);

    // Crear arrays para almacenar las materias de cada semestre
    $materiasSemestre1 = [];
    $materiasSemestre2 = [];
    $materiasSemestre3 = [];

    // Almacenar las materias de cada semestre en los arrays correspondientes
    if (count($materiasResultadoSem1) > 0) {
        foreach ($materiasResultadoSem1 as $fila) {
            $materiasSemestre1[] = htmlspecialchars($fila['nmb_mtr']);
        }
    }

    if (count($materiasResultadoSem2) > 0) {
        foreach ($materiasResultadoSem2 as $fila) {
            $materiasSemestre2[] = htmlspecialchars($fila['nmb_mtr']);
        }
    }

    if (count($materiasResultadoSem3) > 0) {
        foreach ($materiasResultadoSem3 as $fila) {
            $materiasSemestre3[] = htmlspecialchars($fila['nmb_mtr']);
        }
    }

    // Consulta para obtener el nombre de la carrera
    $sqlCarrera = "SELECT nombre FROM carreras WHERE cdg_carrera = ?";
    $stmtCarrera = $pdo->prepare($sqlCarrera);
    $stmtCarrera->bindValue(1, $codigoCarrera, PDO::PARAM_STR);
    $stmtCarrera->execute();
    $carreraResultado = $stmtCarrera->fetch(PDO::FETCH_ASSOC);

    if ($carreraResultado) {
        $nombreCarrera = htmlspecialchars($carreraResultado['nombre']);
    } else {
        $nombreCarrera = 'Carrera no encontrada';
    }
} else {
    $nombreCarrera = 'Carrera no encontrada';
    $materiasSemestre1 = [];
    $materiasSemestre2 = [];
    $materiasSemestre3 = [];
}

// Retorna un array con el nombre de la carrera y las materias de cada semestre para usarlo en tu HTML
return [
    'nombreCarrera' => $nombreCarrera,
    'materiasSemestre1' => $materiasSemestre1,
    'materiasSemestre2' => $materiasSemestre2,
    'materiasSemestre3' => $materiasSemestre3
];
?>