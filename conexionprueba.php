<?php 
session_start();
require('conexion1.php');

$valor_correo = $_POST['correo_php']; 
$valor_contra = $_POST['contra_php'];

if ($cn->connect_errno != 0) {
    echo("Error en la conexión: " . $cn->connect_error);
    exit();
}

$sql = "SELECT Matricula , Num_Departamento FROM jefe WHERE Correo = '$valor_correo' 
AND contraseña = '$valor_contra'";
$busqueda = $cn->query($sql);

if ($busqueda && $busqueda->num_rows == 1) {
    $usuario = $busqueda->fetch_assoc();

    $matricula = $usuario['Matricula'];
    $departamento = $usuario['Num_Departamento'];

    // Validar matrícula termina en 22 es de Infraestructura, 23 redes,  24 de comunicación
    //  05  de Desarrollo o developer, 42 de Ventas, 30 de paqueteria 
    if (preg_match('/(22|23|24|05|42|30)$/', $matricula)) {
        
        // Validar si departamento está en la lista los cuales son.
        //8 Infraestructura, 6 redes, 5 comunicación, 9 developer, 10 ventas, 3 paqueteria
        $departamentos_validos = [8,6,5,9,10,3];
        if (in_array($departamento, $departamentos_validos)) {
            $_SESSION['usuario'] = $matricula;
            echo "SUCCESS";
        } else {
            echo "DEPARTAMENTO-NO-AUTORIZADO";
        }
    } else {
        echo "MATRICULA-NO-AUTORIZADA";
    }
} else {
    echo "ERROR";
}

$cn->close();
?>





