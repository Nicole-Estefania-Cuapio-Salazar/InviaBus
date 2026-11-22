<?php
$conexion = new mysqli("localhost", "root", "12345678", "INVIABUS_ESTRELLAB");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se recibió el ID correctamente
if (isset($_POST["id_emp"])) {
    $id = $conexion->real_escape_string($_POST["id_emp"]);

    $sql = "
        SELECT 
            E.Nombres AS nombre,
            E.Apellido_P AS apellido_p,
            E.Apellido_M AS apellido_m,
            E.area_trabajo,
            E.salario,
            E.Celular AS celular,
            CONCAT(J.Nombres, ' ', J.Apellido_P, ' ', J.Apellido_M) AS jefe
        FROM EMPLEADO E
        LEFT JOIN JEFE J ON E.ID_jefe = J.MATRICULA
        WHERE E.ID_EMP = '$id'
    ";

    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        echo $fila["nombre"] . "|" .
             $fila["apellido_p"] . "|" .
             $fila["apellido_m"] . "|" .
             $fila["area_trabajo"] . "|" .
             $fila["salario"] . "|" .
             $fila["celular"] . "|" .
             $fila["jefe"];
    } else {
        echo "ERROR|No se encontró al empleado";
    }
} else {
    echo "ERROR|Falta el ID del empleado";
}

$conexion->close();
?>
