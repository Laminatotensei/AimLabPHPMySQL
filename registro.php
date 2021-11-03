<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AimLab Registro</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    
    /* Obtener los datos por metodo GET*/
    <form class="formulario" method="get" action="registro_sql.php">
    
        <img src="logo.jpg">
        <h1>Registro</h1>

        <div class="cotenedor">
            
            <div class="input-contenedor"> 
                <i class="fas fa-user icon"></i>
                <td><input type="text" placeholder="Nombre de usuario" name="n_usuario" id="n_usuario"></td>
            </div>

            <div class="input-contenedor"> 
                <i class="fas fa-envelope icon"></i>
                <td><input type="text" placeholder="Correo Electronico" name="correo" id="correo"></td>
            </div>
            
            <div class="input-contenedor"> 
                <i class="fas fa-key icon"></i>
                <td><input type="password" placeholder="Contraseña" name="pass" id="pass"></td>
            </div>

            <td><input type="submit" name="registrar" id="registrar" value="Registrar" class="button"></td>
            <p>¿Ya tienes cuenta?<a class="link" href="index.php"> Iniciar sesion</a></p>
        
        </div>

    </form>

</body>
</html>