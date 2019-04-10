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
include("navbargerente.php")
?>

<div class="container">
    <div class="row my-12">
        <h1>Líneas de productos</h1>
    </div>
    <div id="table" class="table-editable">
    <span class="table-add glyphicon glyphicon-plus">Agregar</span>
    <table class="table">
      <tr>
        <th>Name</th>
        <th>Value</th>
        <th></th>
      </tr>
      <tr>
        <td contenteditable="true">Stir Fry</td>
        <td contenteditable="true">stir-fry</td>
        <td>
          <span class="table-remove glyphicon glyphicon-remove">Remover</span>
        </td>
      </tr>
      <!-- This is our clonable table line -->
      <tr class="hide">
        <td contenteditable="true">Untitled</td>
        <td contenteditable="true">undefined</td>
        <td>
          <span class="table-remove glyphicon glyphicon-remove">Remover</span>
        </td>
      </tr>
    </table>
  </div>
  
  <button id="export-btn" class="btn btn-primary">Export Data</button>
  <p id="export"></p>
</div>

</body>
<script src='js/jquery-ui.min.js'></script>
<script src='js/underscore.js'></script>
<script src='js/bootstrap.min.js'></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/edittable.js"></sript>
<script src="js/jquery-3.3.1.js"></script>
</html>