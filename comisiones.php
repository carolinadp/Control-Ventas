<?php
  include("my_functions.php");
  include("db_manager.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h3>Gerente</h3>
  <ul class="nav nav-pills">
        <li><a href="aprobar.php">Aprobar ventas</a></li>
        <li class="active"><a href="comisiones.php">Calcular comisiones</a></li>
        <li><a href="lineasproducto.php">Líneas de producto</a></li>
    </ul>
    <?php
      $vendedores = getVendedores();
      getComisiones($vendedores);
    ?>
</div>

</body>
</html>