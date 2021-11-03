<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AimLab Login</title>

    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    

/* Enviar por metodo POST a el php "login.php" */   
<form class="formulario" action="login.php" method="post">
    
    <img src="logo.jpg">
    <h1>Login</h1>
    
    <div class="conetendor">

        <div class="input-contenedor"> 
            <i class="fas fa-envelope icon"></i>
            <td><input type="text" name="login" placeholder="Usuario"></td>
        </div>
        
        <div class="input-contenedor"> 
            <i class="fas fa-key icon"></i>
            <td><input type="password" name="password" placeholder="Contraseña"></td>
        </div>

        <td><input type="submit" name="enviar" value="Login" class="button"></td>
        <p>¿No tienes cuenta?<a class="link" href="registro.php"> Registrate</a></p>
    
    </div>

</form>
    

</body>
</html>