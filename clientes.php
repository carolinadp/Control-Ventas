<html>
<head>
</head>
<?php

    include("db_manager.php");
    include("my_functions.php");

	if (isset($_POST['enviar']))
	{
		$nombre = $_POST['nombre'];
		$celular = $_POST['celular'];
        $correo = $_POST['correo'];
        $domicilio = $_POST['domicilio'];
        $descripcion = $_POST['descripcion'];
        $fecha = date("Y-m-d H:i:s");
        if (validarCelular($celular) && validarCorreo($correo))
        {
            insertReporte($nombre, $celular, $correo, $domicilio, $descripcion, $fecha);
            echo "Reporte agregado";
        }
	}
	
?>
<body>
	<h1>Reporte</h1>
	<form method="post">
		Nombre: <input type="text" name="nombre" value = "<?php echo $nombre; ?>"><br>
		Celular: <input type="text" name="celular" value = "<?php echo $celular; ?>"><br>
		Email: <input type="text" name="correo" value = "<?php echo $correo; ?>"><br>
        Domicilio: <input type="text" name="domicilio" value = "<?php echo $domicilio; ?>"><br>
        Descripcion: <input type="text" name="descripcion" value = "<?php echo $descripcion; ?>"><br>
		<input type="submit" value ="enviar" name="enviar">
	</form>

	<?php
        function validarCelular($celular)
        {
            $res = true;
            if (!(strlen($celular) == 10 && !preg_match('/[^0-9]/', $celular)))
            {
                echo "Celular invalido<br>";
                $res = false;
            }
            return $res;
        }

        function validarCorreo($correo)
        {
            $res = true;
            if (!(filter_var($correo, FILTER_VALIDATE_EMAIL)))
            {
                echo "Correo invalido<br>";
                $res = false;
            }
            return $res;
        }
	?>
</body>

</html>