<?php

// require("services/connection.php");

function limpiarDatos($datos){
    $datos = trim($datos); // * Elimina espacios antes y despues
    $datos = stripslashes($datos); // * Elimina '\'
    $datos = htmlspecialchars($datos); // * Convierte caracteres especiales en entidades HTML
    return $datos;
}

// function obtenerSucursalID($pdo, $userId, $punto_venta){
//     $stm = $pdo->prepare("SELECT fkSucursal FROM punto_venta WHERE fkUsuario = $userId AND idPunto = $punto_venta[0];");
//     $stm->execute();
//     $result = $stm->fetch();
//     return ($result) ? $result : false;
// }

// function obtenerPuntosVenta($pdo, $userId){
//     $stm = $pdo->prepare("SELECT idPunto FROM punto_venta WHERE fkUsuario = $userId;");
//     $stm->execute();
//     return $stm->fetchAll();
//     // return ($result) ? $result : false;
// }