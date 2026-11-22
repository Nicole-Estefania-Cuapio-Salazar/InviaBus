<?php
session_start();
require('conexion1.php');

if ($cn->connect_errno != 0) {
    echo "ERROR|Error en la conexión: " . $cn->connect_error;
    exit();
}

$accion = $_POST['accion'] ?? '';

if ($accion === "consultar") {
    $id = $_POST['id_emp'] ?? '';

    if (empty($id)) {
        echo "ERROR|ID vacío.";
        exit();
    }

    $sql = "SELECT  
                j.Nombres,    
                j.Apellido_P,
                j.Apellido_M,
                j.Municipio ,
                j.Codigo_postal,
                j.Estado_o_cd,
                j.area_trabajo,
                j.Contraseña,
                j.correo,
                j.salario,
                j.Celular,
                d.Numero_Departamento
            FROM 
                JEFE j
            LEFT JOIN 
                DEPARTAMENTO d ON j.MATRICULA = d.ID_jefe
            WHERE 
                j.MATRICULA = ?";

    $stmt = $cn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($fila = $res->fetch_row()) {
        echo implode("|", $fila); // Devuelve todos los campos separados por |
    } else {
        echo "ERROR|No se encontró el jefe con ID '$id'";
    }

    $stmt->close();
}
mysqli_close($cn);
?>
