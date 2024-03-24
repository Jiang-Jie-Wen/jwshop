<?php
    session_start();
    $id=$_GET['id'];
    $arr = $_SESSION['cart'];
    foreach($arr as $key => $v){
        if($v[0]==$id){
            unset($arr[$key]);   
        }
    }
    var_dump($arr);
    $_SESSION['cart']=$arr;
    header("Location:../cart.php");
?>