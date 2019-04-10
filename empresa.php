<html>
    <?php
        include("db_manager.php");
        include("my_functions.php");
        session_start();
        $idUser = $_SESSION['id_user'];

        if ($idUser == null || $idUser = '')
        {            
            echo "Por favor <a href=\"login.php\"> inicia sesion </a>";
        }
        else
        {
            header( "Location:empresa.php" );
            $reportes = getReportes();
            while( $row = mysqli_fetch_array($reportes,MYSQLI_BOTH) ){
                $rows[] = $row;
            }
            //echo count($rows)."<br>";
            echo "<table>";
            echo "<tr><th>Nombre</th><th>Telefono</th><th>Correo</th><th>Direccion</th><th>Descripcion</th></tr>";
            foreach ($rows as $key=>$value)
            {
                echo "<tr><td>".$value['name']."</td><td>".$value['phone']."</td><td>".$value['email']."</td><td>".$value['addres']."</td><td>".$value['description']."</td><td>".$value['reportDate']."</td></tr>";
            }
            echo "</table>";
        }
    ?>
</html>