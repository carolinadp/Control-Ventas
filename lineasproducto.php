<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lineas de producto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='css/jquery-ui.css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/edittable.css"> 
  
</head>
<body>
<?php
include("navbargerente.php");
include("my_functions.php");
include("db_manager.php");
?>

<div class="container">
    <div class="row my-12">
        <h1>Líneas de productos</h1>
    </div>
    <div id="table" class="table-editable">
    <span class="table-add glyphicon glyphicon-plus">Agregar</span>
    <table class="table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Value</th>
        <th></th>
      </tr>
      <?php
        getLineasDeProducto();
      ?>
      <!-- This is our clonable table line -->
      <tr class="hide">
        <td contenteditable="true" id="idLinea">hidden ID</td>
        <td contenteditable="true" id="nombreLinea">Untitled</td>
        <td contenteditable="true" id="comisionLinea">undefined</td>
        <td>
          <span class="table-remove">Remover</span>
        </td>
        <td>
          <span class = "table-update">Actualizar</span>
        </td>
      </tr>
    </table>
  </div>
</div>

</body>
<script src="js/jquery-3.3.1.min.js"></script>
<script src='js/jquery-ui.min.js'></script>
<script src='js/underscore.js'></script>
<script src='js/bootstrap.min.js'></script>
<script src="js/edittable.js"></script>
</html>
