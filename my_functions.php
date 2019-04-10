<?php

	function validarUsuario($usuario, $contrasena)
	{
		$sql = "SELECT * FROM usuario WHERE nombre_usuario = '".$usuario."' AND contrasena ='".$contrasena."'";
		$result = (sqlSelect($sql));
		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			$rows[] = $row;
		}
		if (count($rows) > 0)
		{
			$res = $rows[0]['id_usuario'];
		}
		else
		{
			$res = 0;
		}
		return ($res);
	}

	function getTipoUsuario($idUsuario)
	{
		$sql = "SELECT tipo_usuario FROM usuario WHERE id_usuario = '".$idUsuario."'";
		$result = (sqlSelect($sql));
		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			$rows[] = $row;
		}
		if (count($rows) > 0)
		{
			$res = $rows[0]['tipo_usuario'];
		}
		else
		{
			$res = 0;
		}
		return ($res);
	}

	function getVendedores()
	{
		$sql = "SELECT id_usuario FROM usuario WHERE tipo_usuario = 2";
		$result = (sqlSelect($sql));
		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			$rows[] = $row;
		}
		return $rows;
	}

	function getComision($idVendedor)
	{
		$sql = "SELECT usuario.nombre_usuario, sum(venta.monto * Linea_de_Producto.comision) as comisiones FROM usuario, venta, Linea_de_Producto WHERE usuario.id_usuario = venta.id_usuario AND venta.linea_producto = Linea_de_Producto.id_linea_de_producto AND usuario.id_usuario =".$idVendedor;
		$result = (sqlSelect($sql));
		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			$rows[] = $row;
		}
		return $rows[0];
	}

	function getComisiones($vendedores)
	{
		echo "<table class='table'>";
		echo "<thead class='thead-dark'>";
		echo "<tr><th scope='col'>#</th><th scope='col'>Nombre</th><th scope='col'>Comisión</th></tr>";
		echo "</thead><tbody>";
		$numRow = 1;
		foreach ($vendedores as $idVendedor)
		{
			echo "<tr><th scope = 'row'>".$numRow."</th>";
			$numRow += 1;
			$comisiones = getComision($idVendedor[0]);
			echo "<td>".$comisiones['nombre_usuario']."</td><td>".$comisiones['comisiones']."</td></tr>";
		}
		echo "</tbody></table>";
	}

	function insertarVenta($id_usuario, $cliente, $empresa, $concepto, $monto, $fecha_ingreso, $fecha_pago, $linea_producto, $numero_factura, $estatus, $validada) {
		$sql = "INSERT INTO venta (id_usuario, cliente, empresa, concepto, monto, fecha_ingreso, fecha_pago, linea_producto, numero_factura, estatus, validada)".
		" VALUES (". $id_usuario .", '".$cliente."', '". $empresa ."', '".$concepto."', ".$monto.", STR_TO_DATE('".$fecha_ingreso."', '%d-%m-%Y'), STR_TO_DATE('".$fecha_pago."', '%d-%m-%Y'), ".$linea_producto.", '". $numero_factura ."', ". $estatus .", ". $validada .")";

		sqlInsert($sql);
	}

	function getLineasSelect(){
		$sql = "SELECT id_linea_de_producto, nombre FROM Linea_de_Producto";
		$result = (sqlSelect($sql));
		echo '<select class="form-control" id="linea-producto">';
		while ($linea = mysqli_fetch_array($result)) {
			echo '<option value="' . $linea[0] . '">'. $linea[1] . '</option>';
		}
		echo '</select>';
	}
?>
