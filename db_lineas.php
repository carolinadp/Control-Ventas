<?php
    include("db_manager.php");
    header('Content-Type: application/json');
    $res = array();
    $funcion = $_POST["functionname"];
    $argumentos = $_POST["arguments"];
    switch ($funcion)
    {
        case 'insertLineaDeProducto':
            $sql = "INSERT INTO Linea_de_Producto (nombre, comision) VALUES ('Nueva linea', 0)";
            sqlInsert($sql);
            $sql = "SELECT id_linea_de_producto FROM Linea_de_Producto ORDER BY id_linea_de_producto DESC LIMIT 1";
            $result = (sqlSelect($sql));
            while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
                $rows[] = $row;
            }
            $res = $rows[0]['id_linea_de_producto'];
            break;

        case 'deleteLineaDeProducto':
            $sql = "DELETE FROM Linea_de_Producto WHERE Linea_de_Producto.id_linea_de_producto = ".$argumentos[0];
            sqlInsert($sql);
            break;

        case 'updateLineaProducto':
            $sql = "UPDATE Linea_de_Producto SET nombre = '".$argumentos[0]."', comision = ".$argumentos[1]." WHERE id_linea_de_producto = ".$argumentos[2];
            sqlInsert($sql);
            break;
    }
    echo json_encode($res);
?>