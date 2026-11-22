<?php
session_start();
require('conexion1.php');

if ($cn->connect_errno != 0) {
    echo("Error en la conexión: " . $cn->connect_error);
    exit();
}

$valor_id_jefe = trim($_POST['id_jefe_php']); 
$valor_num_departamento = trim($_POST['num_departamento_php']);

$sql = "DELETE FROM JEFE WHERE MATRICULA = ? AND Num_Departamento = ?";
$stmt = $cn->prepare($sql);
$stmt->bind_param("ss",$valor_id_jefe, $valor_num_departamento);

if ($stmt->execute()) {
    echo "Se borró correctamente al Coordinador.";
} else {
    echo "ERROR: No se encuentra ningun cordinador con esos datos: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>