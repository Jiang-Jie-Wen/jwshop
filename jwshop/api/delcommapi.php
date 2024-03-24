<?php
    $itemid = $_GET['itemid'];
    include_once "./connectDB.php";
    $pdo = singletonPDO::getPDO();
    $sql = "DELETE FROM items WHERE itemid = ".$itemid;
    $result = $pdo -> prepare($sql);
    $result -> execute();
    header("Location:../comm.php");
?>