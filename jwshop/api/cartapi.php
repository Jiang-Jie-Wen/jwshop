<?php
session_start();
$id = $_GET['id'];
$qty = $_GET['qty'];
$count=0;
$arr = array();
if (empty($_SESSION["cart"])) { //購物車是空的
    $arr = array(array($id,intval($qty)));
    $_SESSION["cart"]=$arr;
}else{      //購物車非空的
    $arr = $_SESSION["cart"];
    $check = false;  //確認商品(itemid)是否已加入
    foreach($arr as $v){        
        if($v[0]==$id){
            $arr[$count][1]+=intval($qty);
            $check=true;
        }
        $count++;
    }
    if($check){
        
    }else{
        $arr2 = array($id,intval($qty));
        $arr[]=$arr2;
    }
    $_SESSION['cart']=$arr;
}
$_SESSION['addcart']="OK";
echo "<script>history.go(-1)</script>";
?>