<html>
    <head>
        <title>Mis comisiones</title>
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
                <div class="row my-12">
                    <h1>Mis comisiones</h1>
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
                    <table class="table table-striped" id="tabla-principal">
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
                            <td>
                                30
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
        <script src="js/bootstrap.min.js"></script>
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