<?php
session_start();
require('conexion1.php');

if ($cn->connect_errno != 0) {
    echo "Error en la conexión: " . $cn->connect_error;
    exit();
}

$num_departamento = $_POST['num_departamento_php'];
$area_trabajo = $_POST['area_trabajo_php'];
$id_empleado = $_POST['id_empleado_php'];
$matricula = $_POST['matricula_php'];


$sql = ("DELETE FROM DEPARTAMENTO 
        WHERE Numero_Departamento = ? ");
$stmt = $cn->prepare($sql);

if (!$stmt) {
    echo "Error al preparar la consulta: " . $cn->error;
    exit();
}

$stmt->bind_param("s", $num_departamento);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo "Departamento eliminado correctamente.";
    } else {
        echo "No se encontró ningún departamento que coincida con todos los datos.";
    }
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>

