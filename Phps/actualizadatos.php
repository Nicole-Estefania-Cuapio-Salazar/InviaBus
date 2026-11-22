<?php
session_start();
require('conexion1.php'); // Conexión a la base de datos
if ($cn->connect_errno != 0) {
    echo "Error en la conexión: " . $cn->connect_error;
    exit();}
$id = $_POST['id_emp'] ?? ''; // los datos que se haran referencia y se pueden actualizar 
$nombre = $_POST['nombre'] ?? '';
$apellidop = $_POST['apellido_p'] ?? ''; //como se desconocen los datos se colocan los signos de interrogación 
$apellidom = $_POST['apellido_m'] ?? '';
$area = $_POST['area'] ?? '';
$salario = $_POST['salario'] ?? '';
$celular = $_POST['celular'] ?? '';
$jefe = $_POST['jefe'] ?? '';
if (!$id || !$nombre || !$apellidop || !$apellidom || !$area || !$salario || !$celular) { //se colocan de la forma en la que se tiene en la BD
    echo "Faltan datos obligatorios."; //si ninguno de los datos esta alterado o bien acutlaizado 
    exit();
}
$sql = "UPDATE empleado SET  /*actualiza  los datos de empleado*/
            Nombres = '$nombre',
            Apellido_P = '$apellidop',
            Apellido_M = '$apellidom',
            area_trabajo = '$area',
            salario = '$salario',
            Celular = '$celular',
            ID_jefe = '$jefe'
        WHERE ID_EMP = '$id'"; /*el id que se coloco */
if (mysqli_query($cn, $sql)) { /*si todo es de manera satisfactoria hara lo que son conexión y el sql */
    echo "OK";
} else {
    echo "Error al actualizar: " . mysqli_error($cn); /*si no es correcta la conexión nos mandara un erro por medio del echo*/
}
mysqli_close($cn);
?>
