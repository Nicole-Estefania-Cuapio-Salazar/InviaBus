<?php
// Conexión
session_start();
require('conexion1.php');
// Validar si la conexión fue exitosa
if ($cn->connect_errno != 0) {
    echo("Error en la conexión: " . $cn->connect_error);
    exit();
}
$valor_id_emp = $_POST['id_emp_php']; 
$valor_nombre = $_POST['nombre_php']; 
$valor_apellido_P = $_POST['apellido_P_php']; 
$valor_apellido_M = $_POST['apellido_M_php']; 
$valor_municipio = $_POST['municipio_php'];
$valor_codigopo = $_POST['codigopo_php'];
$valor_estadocd = $_POST['estadocd_php'];    
$valor_rfc = $_POST['rfc_php'];
$valor_area_trabajo = $_POST['area_trabajo_php'];    
$valor_celular = $_POST['cel_php'];
$valor_salario = $_POST['salario_php'];
$valor_id_jefe = $_POST['id_jefe_php']; //en esta parte me tiene que traer el nombre completo del jefe del empleado
$valor_num_departamento = $_POST['num_departamento_php'];

// Preparar y ejecutar consulta
$sql = "INSERT INTO EMPLEADO (
    ID_EMP, Nombres, Apellido_P, Apellido_M, Municipio, Codigo_postal, Estado_o_cd,
    RFC, area_trabajo, Celular, salario, ID_jefe, Num_Departamento
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $cn->prepare($sql);
$stmt->bind_param("sssssssssssss", 
    $valor_id_emp, 
    $valor_nombre, 
    $valor_apellido_P, 
    $valor_apellido_M,
    $valor_municipio,
    $valor_codigopo,
    $valor_estadocd,
    $valor_rfc,
    $valor_area_trabajo,
    $valor_celular,
    $valor_salario,
    $valor_id_jefe,
    $valor_num_departamento
);
if ($stmt->execute()) {
    echo "Registro guardado correctamente.";
} else {
    echo "Error al guardar: " . $stmt->error;
}
$stmt->close();
$cn->close();
?>

