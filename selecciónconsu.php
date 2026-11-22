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
     /*"txt_id_emp", "txt_nombre", "txt_apellido_p", "txt_apellido_m","txt_Municipio",
    "txt_codigopos","txt_estadocd","txt_area_trabajo", "txt_celular","txt_salario", "txt_jefearea","txt_num_departamento"
 */
    $sql = "SELECT  
                e.Nombres,
                e.Apellido_P,
                e.Apellido_M,
                e.Municipio,
                e.Codigo_postal,
                e.Estado_o_cd,
                e.area_trabajo,
                e.Celular,
                e.salario,
                e.Num_Departamento,
                CONCAT(j.Nombres, ' ', j.Apellido_P, ' ', j.Apellido_M) AS Nombre_Jefe,
                j.MATRICULA AS ID_Jefe
            FROM 
                EMPLEADO e
            LEFT JOIN 
                JEFE j ON e.ID_jefe = j.MATRICULA
            WHERE 
                e.ID_EMP = ?";

    $stmt = $cn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($fila = $res->fetch_row()) {
        echo implode("|", $fila); // Devuelve todos los campos separados por |
    } else {
        echo "ERROR|No se encontró el empleado con ID '$id'";
    }

    $stmt->close();
}
mysqli_close($cn);
?>
