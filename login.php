<?php
	include("my_functions.php");
    include("db_manager.php");
    if($_POST)
    {
        $post_usuario = $_POST['usuario'];
        $post_pass = $_POST['contrasena'];
        
        if( ($post_usuario <> "" ) && ( $post_pass <> "" ) )
        {	
            $id_usuario = validarUsuario($post_usuario, $post_pass);
            if( $id_usuario <> 0 )
            {
                
                $tipo_usuario = getTipoUsuario($id_usuario);
                session_start();
                $_SESSION['id_usuario'] = $id_usuario;
                $_SESSION['tipo_usuario'] = $tipo_usuario;
                if ($tipo_usuario == 1)
                {
                    header("Location:aprobar.php");
                }
                else
                {
                    header("Location:ventasvendedor.php");
                }
            }
            else
            {
                $label = "Usuario o contraseñas incorrectos";
            }
            echo ($post_usuario);
        }
        else
        {
            echo "<p>Asegúrate de llenar todos los campos</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang=en>
    <head>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
<body>
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <div class="container">
        <div class="row align-items-center">
            <div class ="col"></div>
            <div class="col-6 shadow rounded p-3 mb-5">
                <form method="post" action = "login.php">
                    <h2 class = "text-center">Iniciar sesión</h2>
                    <div class = "form-group">
                        <input type="text" class = "form-control" placeholder="Usuario" name="usuario" required="required">    
                    </div>
                    <div class="form-group">
                        <input type="password" class = "form-control" placeholder="Contrasena" name="contrasena" required="required">
                    </div>
                    <div class="form-group" >
                        <div class="text-center">
                            <button type="submit" name="entrar" class = "btn btn-primary" placeholder="Iniciar sesion" required="required"> Iniciar sesion</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
</html>