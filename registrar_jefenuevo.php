<?php
session_start();
require('conexion1.php');
// Validar conexión
if ($cn->connect_errno != 0) {
    echo "ERROR: Fallo en la conexión: " . $cn->connect_error;
    exit();
}
// Capturar datos del formulario
$valor_matricula = $_POST['matricula_php'];
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
$valor_correo = $_POST['correo_php'];
$valor_contraseña = $_POST['contraseña_php'];
$valor_num_departamento = $_POST['num_departamento_php'];
// Preparar consulta
$sql = "INSERT INTO JEFE (MATRICULA, Nombres, Apellido_P, Apellido_M, Municipio, Codigo_postal, Estado_o_cd, RFC, area_trabajo, Celular, Salario, Correo, Contraseña, Num_Departamento)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $cn->prepare($sql);

if (!$stmt) {
    echo "ERROR: Error al preparar la consulta: " . $cn->error;
    exit();
}
// esn este caso ds se colocan el pocición 11 y 12 puesto que son de contraseña y correo y se tuvo complicaciónes
$stmt->bind_param("ssssssssssdsss",
    $valor_matricula,
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
    $valor_correo,
    $valor_contraseña,
    $valor_num_departamento
);
// Ejecutar
if ($stmt->execute()) {
    echo "Registro guardado correctamente.";
} else {
    echo "ERROR: No se pudo guardar: " . $stmt->error;
}
$stmt->close();
$cn->close();
?>
