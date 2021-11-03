<?php

    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("location:index.php");
    }

    try {

        $id_u = $_SESSION["id"];

        $id_perfil_juego = $_GET['id'];

        $base = new PDO('mysql:host=localhost; dbname=aimlabprueba', 'root', '');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

        $sql = "SELECT * FROM PERFIL_MICRO WHERE ID_USUARIO = :id_u";
        $resultado = $base->prepare($sql);

        $resultado->bindValue(":id_u", $id_u);
        $resultado->execute();

        $numero_registro = $resultado->rowCount();

        if ($numero_registro != 0) {

            /*
            $registro = $resultado->fetch();
            $M_Puntaje = $registro['M_Puntaje'];
            $M_Precision = $registro['M_Precision'];
            $id_M_Perfil = $registro['id_M_Perfil'];

            echo "El perfil de grid ya existe para este usuario <br>";
            echo "Estas son sus stats: <br>";
            echo "Mejor puntaje: " . $M_Puntaje . "<br>";
            echo "Mejor precision: " . $M_Precision . "<br>";
            echo "ID del mejor perfil: " . $id_M_Perfil . "<br>";
            */

           header("location:Sesion_Micro.php?n_vueltas=0&id_p_j=" . $id_perfil_juego . "'");

        }

        else {

            /*echo "Este usuario no tiene perfil de grid, se le creara uno <br>";*/

            $consulta = "INSERT INTO PERFIL_MICRO (ID_USUARIO, M_PUNTAJE, M_PRECISION) VALUE (:id_u, 0, 0)";
            $resultados = $base->prepare($consulta);
            $resultados->execute(array(":id_u"=>$id_u));

            /*echo "Se creo el prfil de grid <br>";*/
            
            $resultados->closeCursor();

            header("location:Sesion_Micro.php?n_vueltas=0&id_p_j=" . $id_perfil_juego . "'");
        }

    } catch (Exception $e) {

        die ('Error: ' . $e->getMessage());

    }

    $base = null;

?>