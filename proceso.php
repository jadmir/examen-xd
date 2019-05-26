<?php

session_start();


$mysqli = new mysqli('localhost', 'root', '' ,'prueba') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$Codigo = '';
$Descripcion = '';
$Precio = '';
$Existencia = '';


if (isset($_POST['Guardar'])){
    $Codigo = $_POST['Codigo'];
    $Descripcion = $_POST['Descripcion'];
    $Precio = $_POST['Precio'];
    $Existencia = $_POST['Existencia'];


    $mysqli->query("INSERT INTO producto (Codigo, Descripcion, Precio, Existencia) VALUES('$Codigo', '$Descripcion', '$Precio', '$Existencia')") or
                    die($mysqli->error);

    $_SESSION['message'] = "El registro se ha guardado!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM producto WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "El registro se ha eliminado!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM producto WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $Codigo = $row['Codigo'];
        $Descripcion = $row['Descripcion'];
        $Precio = $row['Precio'];
        $Existencia = $row['Existencia'];
    }
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $Codigo = $_POST['Codigo'];
    $Descripcion  = $_POST['Descripcion'];
    $Precio = $_POST['Precio'];
    $Existencia = $_POST['Existencia'];

    $mysqli->query("UPDATE producto SET Codigo='$Codigo', Descripcion='$Descripcion', Precio='$Precio', Existencia='$Existencia' WHERE id=$id") or
            die($mysqli->error);

    $_SESSION['message'] = "el registro ha sido actualizado";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}