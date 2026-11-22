<?php
session_start();
require('conexion1.php');

if ($cn->connect_errno != 0) {
    echo("Error en la conexión: " . $cn->connect_error);
    exit();
}

$valor_id_emp = intval($_POST['id_emp_php']); 
$valor_id_jefe = intval($_POST['id_jefe_php']);
$valor_num_departamento = intval($_POST['num_departamento_php']);

$sql = "DELETE FROM EMPLEADO WHERE ID_EMP = ? AND ID_jefe = ? AND Num_Departamento = ?";
$stmt = $cn->prepare($sql);
$stmt->bind_param("iii", $valor_id_emp, $valor_id_jefe, $valor_num_departamento);

if ($stmt->execute()) {
    echo "Se borró correctamente el empleado.";
} else {
    echo "ERROR: No se pudo eliminar al empleado: " . $stmt->error;
}

$stmt->close();
$cn->close();
?>
