<?php 
session_start();
$arr = $_SESSION['cart'];
$id = $_GET['id'];
$qty = $_GET['qty'];
$count = count($arr);
for($i=0;$i<$count;$i++){
    if($arr[$i][0]==$id){
        echo "ttt";
        $arr[$i][1]=intval($qty);        
        break;
    } 
}

$_SESSION['cart']=$arr;

header("Location:../cart.php");
?>