<?php 
    require_once("./connectDB.php");
    session_start();
    $pdo = singletonPDO::getPDO();
    $oid=$_GET['oid'];
    $sql = "DELETE FROM orderform WHERE oid = ".$oid;
    $result = $pdo->prepare($sql);
    $result ->execute();
    $sql = "DELETE FROM orderitem WHERE oid = ".$oid;
    $result = $pdo->prepare($sql);
    $result ->execute();
    header("Location:../order.php");
?>