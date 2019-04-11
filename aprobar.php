<?php
include("my_functions.php");
include("db_manager.php");
?>
<html>
  <head>
    <title>Aprbar ventas</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/daterangepicker.css" />
  </head>
  <body>
    <?php
        include("navbargerente.php")
    ?>
<div class="container">
    <div class="row my-12">
        <h1>Autorizar ventas</h1>
    </div>

    <div class="row">
        <div class="col-sm-2">
          Ventas
        </div>

        <div class="col-sm-4">
            Desde
            <input type="text" class="datetime" id="consulta-inicio"/>
        </div>

        <div class="col-sm-4">
            Hasta
            <input type="text" class="datetime" id="consulta-fin"/>
        </div>
        
        <div class="col-sm-2">
          <button type="consultar" class="btn btn-primary">Consultar</button>
        </div>

      </div>

      <div class="row my-4">
        <?php
            getVentasFechasEditar(4, "03-04-2019", "04-04-2019");
        ?>

</div>

</body>
<script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
  $('#boton-nueva-venta').click(function(){
    $('#menu-nueva-venta').toggleClass("collapsed");
  });

  $('.datetime').daterangepicker({

      "singleDatePicker": true,
      locale: {
          format: 'DD-MM-YYYY'
      },
      "startDate": moment(),
  }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
  });

  </script>
</html>