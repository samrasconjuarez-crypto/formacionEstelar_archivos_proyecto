<?php
include("config.php");
session_start();


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $mensaje = $_POST['mensaje'];

    $anonimo = isset($_POST['anonimo']) ? 1: 0;
    $novedades = isset($_POST['novedades']) ? 1: 0;
    
    if($anonimo == 1){
        $username = "Anonimo";
        $apellido = "Anonimo";
    }


    try{
    $query = $Conn->prepare("INSERT INTO formacion (username,  apellido,  correo, mensaje, anonimo, novedades) VALUES(:username, :apellido, :correo, :mensaje, :anonimo, :novedades)");

    $query->bindParam(":username", $username, PDO::PARAM_STR);
    $query->bindParam(":apellido", $apellido, PDO::PARAM_STR);
    $query->bindParam(":correo", $correo, PDO::PARAM_STR);
    $query->bindParam(":mensaje", $mensaje, PDO::PARAM_STR);
    $query->bindParam(":anonimo", $anonimo, PDO::PARAM_STR);
    $query->bindParam(":novedades", $novedades, PDO::PARAM_STR);
    $result = $query->execute();


    if($result){
        header("Location: ../index.html");
        exit();
    }else{
        echo '<p> class="Error"> Error al agregar el registro</p>';
    }

    }


    catch (PDOException $e) {

        echo "Error al registrar: " . $e->getMessage();
    }

}


?>