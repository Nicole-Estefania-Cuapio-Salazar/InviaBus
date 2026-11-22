<?php
require('conexion1.php');

if ($cn->connect_errno != 0) {
    echo "Error en la conexión: " . $cn->connect_error;
    exit();}

$area = $_POST['area_trabajo_php'];
$departamento = $_POST['num_departamento_php'];
$id_jefe = $_POST['id_jefe_php'];
 // Asegúrate de que la conexión a la BD esté bien

$query = "SELECT 
            E.ID_EMP AS ID_Empleado,
            E.Nombres AS Nombre_Empleado,
            E.Apellido_P AS ApellidoP_Empleado,
            E.Apellido_M AS ApellidoM_Empleado,
            J.MATRICULA AS ID_Jefe,
            J.Nombres AS Nombre_Jefe,
            J.Apellido_P AS ApellidoP_Jefe,
            J.Apellido_M AS ApellidoM_Jefe
          FROM EMPLEADO E
          JOIN DEPARTAMENTO D ON E.Numero_departamento = D.Numero_departamento
          JOIN JEFE J ON D.ID_jefe = J.MATRICULA
          WHERE D.area_trabajo = '$area' 
            AND D.Numero_departamento = '$departamento' 
            AND D.ID_jefe = '$id_jefe'";

$resultado = mysqli_query($cn, $query);

if (!$resultado) {
  echo "Error al consultar los datos.";
  exit;
}

$salida = "";
while ($fila = mysqli_fetch_assoc($resultado)) {
  $salida .= "Empleado: " . $fila['Nombre_Empleado'] . " " . $fila['ApellidoP_Empleado'] . " " . $fila['ApellidoM_Empleado'] .
             " (ID: " . $fila['ID_Empleado'] . ")\n";
  $salida .= "Jefe: " . $fila['Nombre_Jefe'] . " " . $fila['ApellidoP_Jefe'] . " " . $fila['ApellidoM_Jefe'] .
             " (ID: " . $fila['ID_Jefe'] . ")\n";
  $salida .= "----------------------------------------\n";
}

if ($salida == "") {
  echo "No se encontraron empleados ni jefes para ese departamento y área.";
} else {
  echo $salida;
}

mysqli_close($cn);
?>
