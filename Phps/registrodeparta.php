<?php
// Conexión
session_start();
require('conexion1.php');
// Validar si la conexión fue exitosa
if ($cn->connect_errno != 0) {
    echo("Error en la conexión: " . $cn->connect_error);
    exit();
}
$valor_num_departamento = $_POST['num_departamento_php'];
$valor_area_trabajo = $_POST['area_trabajo_php']; 
$valor_id_empleado = $_POST['id_empleado_php'];
$valor_id_jefe= $_POST['id_jefe_php'];  /*ese se obtiene por medio de id de su jefe es necesario el uso de join */ 

// Preparar y ejecutar consulta
 $sql = "INSERT INTO DEPARTAMENTO (
   Numero_Departamento ,area_trabajo, ID_empleado , ID_jefe ) 
VALUES (?, ?, ?, ?)";

$stmt = $cn->prepare($sql);
$stmt->bind_param("ssss", 
  $valor_num_departamento,
  $valor_area_trabajo,
  $valor_id_empleado,    
  $valor_id_jefe
  
);


if ($stmt->execute()) {
    echo "Registro guardado correctamente.";
} else {
    echo "Error al guardar: " . $stmt->error;
}
$stmt->close();
$cn->close();
?>
