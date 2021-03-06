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

	function getVentas($sql) {

		echo "<table class=\"table table-striped\" id=\"tabla-principal\">
                        <thead>
                        <tr>
                            <th>
                                Cliente
                            </th>
                            <th>
                                Empresa
                            </th>
                            <th>
                                Concepto
                            </th>
                            <th>
                                Monto antes de impuestos
                            </th>
                            <th>
                                Fecha de ingreso
                            </th>
                            <th>
                                Fecha de pago
                            </th>
                            <th>
                                Linea de producto
                            </th>
                            <th>
                                Numero factura
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Comisión
                            </th>
                            <th>
                            		Validada
														</th>
														<th>
																Acciones
</th>
                        </tr>";

		$result = (sqlSelect($sql));
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
			$miestatus = ($row[8] == 1) ? "Pagada" : "Pendiente";
			$mivalidada = ($row[10] == 1) ? "Sí" : "No";

			$resultLineas = getLineasArray();
			$milinea = $row[6];
			$lineaselect = "";
			$lineaselect .= '<select class="form-control table-combo" id="linea-producto" style="width:200px;">';
			while ($linea = mysqli_fetch_array($resultLineas)) {
				$toadd = '';
				if ($milinea == $linea[0]) {
						$toadd = 'selected';
				}
				$lineaselect.= '<option '. $toadd .' value="' . $linea[0] . '">'. $linea[1] . '</option>';
			}
			$lineaselect .= '</select>';

			$selectedPendiente = ($row[8] == 0)? 'selected' : "";
			$selectedPagado = ($row[8] == 1)? 'selected' : "";


			echo "<tr>
							<td>
									<input value='{$row[0]}'>
							</td>
							<td>
									<input value='{$row[1]}'>
							</td>
							<td>
									<input value='{$row[2]}'>
							</td>
							<td>
									<input value='{$row[3]}'>
							</td>
							<td>
									<input value='{$row[4]}'>
							</td>
							<td>
									<input value='{$row[5]}'>
							</td>
							<td>
									".$lineaselect."
							</td>
							<td>
									<input value='{$row[7]}'>
							</td>
							<td class='col-md-2'>
									<select class=\"form-control\" id=\"estatus\" style=\"width:200px;\">
										<option ".$selectedPendiente." value=\"0\">Pendiente</option>
										<option ".$selectedPagado." value=\"1\">Pagada</option>
									</select>
							</td>
							<td>
									<input value='{$row[9]}'>
							</td>
							<td>
									".$mivalidada."
							</td>
							<td>
									<button class=\"btn btn-primary\" data-editar='{$row[11]}'>Actualizar</button>    
							</td>
					</tr>";
		}
	}

	function getVentasUsuario($id_usuario){
		$sql = "SELECT venta.cliente, venta.empresa, venta.concepto, venta.monto, DATE_FORMAT(venta.fecha_ingreso, '%d-%m-%Y'), DATE_FORMAT(venta.fecha_pago, '%d-%m-%Y'), venta.linea_producto, numero_factura, estatus, (Linea_de_Producto.comision * venta.monto) AS micomision, validada, venta.id_venta FROM venta ".
			"INNER JOIN Linea_de_Producto ON Linea_de_Producto.id_linea_de_producto = venta.linea_producto".
			" WHERE venta.id_usuario = ". $id_usuario;
		getVentas($sql);
	}

	function getVentasFechas($id_usuario, $fecha_inicio, $fecha_fin){
		$sql = "SELECT venta.cliente, venta.empresa, venta.concepto, venta.monto, DATE_FORMAT(venta.fecha_ingreso, '%d-%m-%Y'), DATE_FORMAT(venta.fecha_pago, '%d-%m-%Y'), venta.linea_producto, numero_factura, estatus, (Linea_de_Producto.comision * venta.monto) AS micomision, validada, venta.id_venta FROM venta ".
			"INNER JOIN Linea_de_Producto ON Linea_de_Producto.id_linea_de_producto = venta.linea_producto".
			" WHERE venta.id_usuario = ". $id_usuario ." AND venta.fecha_ingreso >= STR_TO_DATE('".$fecha_inicio."', '%d-%m-%Y') AND venta.fecha_ingreso <= STR_TO_DATE('".$fecha_fin."', '%d-%m-%Y')";

		getVentas($sql);
	}

	function getVentasEditar($sql) {

		echo "<table class=\"table table-striped\" id=\"tabla-principal\">
                        <thead>
						<tr>
							<th>
								ID de venta
							</th>
                            <th>
                                Cliente
                            </th>
                            <th>
                                Empresa
                            </th>
                            <th>
                                Concepto
                            </th>
                            <th>
                                Monto antes de impuestos
                            </th>
                            <th>
                                Fecha de ingreso
                            </th>
                            <th>
                                Fecha de pago
                            </th>
                            <th>
                                Linea de producto
                            </th>
                            <th>
                                Numero factura
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Comisión
                            </th>
                            <th>
                            		Validada
														</th>
                        </tr>";

		$result = (sqlSelect($sql));
		while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
			$miestatus = ($row[9] == 1) ? "Pagada" : "Pendiente";
			$mivalidada = ($row[11] == 1);
			echo "<tr>
							<td>
									".$row[0]."
							</td>
							<td>
									".$row[1]."
							</td>
							<td>
									".$row[2]."
							</td>
							<td>
									".$row[3]."
							</td>
							<td>
									".$row[4]."
							</td>
							<td>
									".$row[5]."
							</td>
							<td>
									".$row[6]."
							</td>
							<td>
									".$row[7]."
							</td>
							<td>
									".$row[8]."
							</td>
							<td>
									".$miestatus."
							</td>
							<td>
									".$row[10]."
							</td>
							<td>
							<input type='checkbox' ";
							if ($miestatus)
							{
								echo "checked";
							}
							echo "/>&nbsp;
							</td>
					</tr>";
		}
	}

	function getVentasFechasEditar($id_usuario, $fecha_inicio, $fecha_fin){
		$sql = "SELECT venta.id_venta, venta.cliente, venta.empresa, venta.concepto, venta.monto, DATE_FORMAT(venta.fecha_ingreso, '%d-%m-%Y'), DATE_FORMAT(venta.fecha_pago, '%d-%m-%Y'), Linea_de_Producto.nombre, numero_factura, estatus, (Linea_de_Producto.comision * venta.monto) AS micomision, validada FROM venta ".
			"INNER JOIN Linea_de_Producto ON Linea_de_Producto.id_linea_de_producto = venta.linea_producto".
			" WHERE venta.id_usuario = ". $id_usuario ." AND venta.fecha_ingreso >= STR_TO_DATE('".$fecha_inicio."', '%d-%m-%Y') AND venta.fecha_ingreso <= STR_TO_DATE('".$fecha_fin."', '%d-%m-%Y')";

		getVentasEditar($sql);
	}
  function getLineasArray(){
		$sql = "SELECT id_linea_de_producto, nombre FROM Linea_de_Producto";
		$result = (sqlSelect($sql));
		return $result;
	}

	function getLineasSelect(){
		$result = getLineasArray();
		echo '<select class="form-control" id="linea-producto">';
		while ($linea = mysqli_fetch_array($result)) {
			echo '<option value="' . $linea[0] . '">'. $linea[1] . '</option>';
		}
		echo '</select>';
	}
	
	function getLineasDeProducto()
	{
		$sql = "SELECT * FROM Linea_de_Producto ORDER BY id_linea_de_producto ASC";
		$result = (sqlSelect($sql));

		while( $row = mysqli_fetch_array($result,MYSQLI_BOTH) ){
			echo "<tr>";
			echo "<td contenteditable='false' id='idLinea'>".$row["id_linea_de_producto"]."</td>";
			echo "<td contenteditable='true' id='nombreLinea'>".$row["nombre"]."</td>";
			echo "<td contenteditable='true' id='comisionLinea'>".$row["comision"]."</td>";
			echo "<td><span  class='table-remove'>Remover</span></td>";
			echo "<td><span class = 'table-update'>Actualizar</span></td>";
			echo "</tr>";
		}
	}
?>

<script>
	$("[data-editar]").on("click", function() {
		var id = $(this).data("editar");

		$.post("controllerventasvendedor.php", $(this).parents("tr").find("input").serialize(), function(resp){
			$("table").html(resp);
		});

	});
</script>