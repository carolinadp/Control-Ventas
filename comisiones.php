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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <?php
        include("navbargerente.php")
    ?>
<div class="container">
    <div class="row my-12">
        <h1>Comisiones</h1>
    </div>
    <?php
      $vendedores = getVendedores();
      getComisiones($vendedores);
    ?>
</div>

</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>