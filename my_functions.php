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

	function getLineasDeProducto()
	{
		$sql = "SELECT * FROM Linea_de_Producto";
		$result = (sqlSelect($sql));

		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			echo "<tr>";
			echo "<td contenteditable='false'>".$row["id_linea_de_producto"]."</td>";
			echo "<td contenteditable='true'>".$row["nombre"]."</td>";
			echo "<td contenteditable='true'>".$row["comision"]."</td>";
			echo "<td><span class='table-remove'>Remover</span></td>";
			echo "</tr>";
		}
	}

	function insertLineaDeProducto()
	{
		$funcion = $_POST("functionname");
		$argumentos = $_POST("arguments");
		$sql = "INSERT INTO Linea_de_Producto(nombre, comision) VALUES ('".$argumentos[0]."', ".$argumentos[1].")";
		sqlInsert(sql);
		$sql = "SELECT id_linea_de_producto FROM Linea_de_Producto ORDER BY id_linea_de_producto DESC LIMIT 1";
		$result = (sqlSelect($sql));
		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			$rows[] = $row;
		}
		$res = $rows[0]['id_linea_de_producto'];
		echo json_encode($res);
		return ($res);
	}
?>
