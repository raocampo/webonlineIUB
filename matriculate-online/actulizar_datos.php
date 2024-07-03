<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombres = $_POST['nombres'];
    $identificacion = $_POST['identificacion'];
    $nmr_tel = $_POST['nmr_tel'];
    $correo = $_POST['correo'];
    $fch_nac = $_POST['fch_nac'];

    // Verifica la conexión
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $sql = "UPDATE usuarios SET nombres='$nombres', identificacion='$identificacion', nmr_tel='$nmr_tel', correo='$correo', fch_nac='$fch_nac' WHERE id=1";

    if (mysqli_query($conn, $sql)) {
        echo "Registro actualizado con éxito";
    } else {
        echo "Error actualizando el registro: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>