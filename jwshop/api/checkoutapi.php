<?php
    session_start();
    require_once('./connectDB.php');
    $pdo = singletonPDO::getPDO();
    $uid=$_SESSION['uid'];
    $name=$_POST['user'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    date_default_timezone_set('Asia/Taipei');
    $time=date('Y-m-d H:i:s');;
    $sql = "INSERT INTO orderform (uid,name,phone,address,createdate) VALUES ($uid,'$name',$phone,'$address','$time')";
    
    $result = $pdo->prepare($sql);
    $result ->execute();
    $sql = "SELECT oid FROM orderform WHERE uid = ".$uid." ORDER BY oid DESC LIMIT 1";
    $result = $pdo->prepare($sql);
    $result ->execute();
    $row = $result ->fetch();
    $oid = $row['oid'];
    $arr=$_SESSION['cart'];
    foreach($arr as $val){
        $pricesql = "SELECT price FROM items WHERE itemid = ".$val[0];
        $priceresult = $pdo->prepare($pricesql);
        $priceresult ->execute();
        $pricerow = $priceresult -> fetch();
        $price = $pricerow['price'];
        $addsql = "INSERT INTO orderitem (oid,itemid,qty,price) VALUES ($oid,$val[0],$val[1],$price)";
        $addresult = $pdo->prepare($addsql);
        $addresult ->execute();
    }
    unset($_SESSION['cart']);
    
    header("Location:../index.php");
?>