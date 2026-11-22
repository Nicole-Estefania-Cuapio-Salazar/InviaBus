<?php
session_start();
require('conexion1.php');

if ($cn->connect_errno != 0) {
    echo "Error en la conexión: " . $cn->connect_error;
    exit();
}

$id = $_POST['id_jefe'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellidop = $_POST['apellido_p'] ?? '';
$apellidom = $_POST['apellido_m'] ?? '';
$municipio = $_POST['municipio'] ?? '';
$codigo = $_POST['codigo'] ?? '';
$estadocd = $_POST['estadocd'] ?? '';
$area = $_POST['area_trabajo'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';
$correo = $_POST['correo'] ?? '';
$salario = $_POST['salario'] ?? '';
$celular = $_POST['celular'] ?? '';
$num_departamento = $_POST['num_departamento'] ?? '';

// Validación básica
if (!$id || !$nombre || !$apellidop || !$apellidom || !$area || !$salario || !$celular || !$num_departamento) {
    echo "Faltan datos obligatorios.";
    exit();
}

// Actualizar EMPLEADO
$sql = "UPDATE JEFE SET
            Nombres = '$nombre',
            Apellido_P = '$apellidop',
            Apellido_M = '$apellidom',
            Municipio = '$municipio',
            Codigo_postal = '$codigo',
            Estado_o_cd = '$estadocd',
            area_trabajo = '$area',
            Contraseña = '$contraseña',
            Correo = '$correo',
            salario = '$salario',
            Celular = '$celular',
            Num_Departamento = '$num_departamento'
        WHERE MATRICULA = '$id'";
        
if (mysqli_query($cn, $sql)) {
    echo "OK";
} else {
    echo "Error al actualizar: " . mysqli_error($cn);
}

mysqli_close($cn);
?>
