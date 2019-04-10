<html>
  <head>
    <title>Registro personal de ventas</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
      
  <?php
    include('navbarvendedor.php')
  ?>

    <div class="container">
      <div class="row">
        <h1>Control de ventas</h1>
      </div>
      <div class="row">
        <div class="col">
          <button id="boton-nueva-venta" class="btn btn-primary">
            +
          </button>
          Nueva venta
        </div>
      </div>

      <div class="row">
        <header class="jumbotron col-sm-12 collapsed" id="menu-nueva-venta">
          <h2>Registrar una nueva venta</h2>
          <form action="ventasvendedor.php">
            <div class="form-group">
              <label for="cliente">Cliente:</label>
              <input type="text" class="form-control" id="cliente">
            </div>
            <div class="form-group">
              <label for="empresa">Empresa:</label>
              <input type="text" class="form-control" id="empresa">
            </div>
            <div class="form-group">
              <label for="monto">Monto antes de impuestos:</label>
              <input type="text" class="form-control" id="monto">
            </div>
            <div class="form-group">
              <label for="tiempo-pago">Tiempo de pago:</label>
              <input type="text" class="datetime" id="tiempo-pago">
            </div>
            <div class="form-group">
              <label for="linea-producto">Linea del producto:</label>
              <select class="form-control" id="linea-producto">
                <option>asdf</option>
                <option>ghjk</option>
              </select>          
            </div>
            <div class="form-group">
              <label for="numero-factura">Numero de factura:</label>
              <input type="text" class="form-control" id="numero-factura">
            </div>
            <div class="form-group">
              <label for="estatus">Estatus:</label>
              <select class="form-control" id="estatus">
                <option>Seleccione estatus</option>
                <option>Pagada</option>
                <option>Pendiente</option>
              </select>
            </div>
            <button type="enviar" class="btn btn-primary">Enviar</button>
          </form> 
        </header>
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
        <table class="table table-striped">
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
            </tr>
            <tr>
              <td>
                Juan perez
              </td>
              <td>
                Plásticos Gonzalez
              </td>
              <td>
                Moldes
              </td>
              <td>
                150
              </td>
              <td>
                15-02-2019
              </td>
              <td>
                20-02-2019
              </td>
              <td>
                asdf
              </td>
              <td>
                1234
              </td>
              <td>
                Pagada
              </td>
            </tr>
          </thead>
        </table>
      </div>
    </div>

  </body>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/datepicker.js"></script>
  <script>
  $('#boton-nueva-venta').click(function(){
    $('#menu-nueva-venta').toggleClass("collapsed");
  });

    function datepicker(id){
      $('#'+id).daterangepicker({
          singleDatePicker: true,
                timePicker: true,
          minDate:new Date(),
                locale: {
                    format: 'YYYY/MM/DD HH:mm'
          }
        });
    }
  </script>
</html>