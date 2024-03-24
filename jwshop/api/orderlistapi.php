<?php
$oid = $_GET['oid']; 

include_once "./connectDB.php";
$pdo = singletonPDO::getPDO();
$sql = "UPDATE orderform SET islock = 1 WHERE oid = ".$oid;
$result = $pdo -> prepare($sql);
$result -> execute();


$filename = "訂單編號:".$oid.'.txt';  //檔案名稱
$str = '';  //檔案內容
$total = 0;
$sql = "SELECT * FROM orderform WHERE oid = ".$oid;
$result = $pdo -> prepare($sql);
$result -> execute();
$row = $result -> fetch();
$str .= "買家姓名:".$row['name']."\r\n";
$str .= "連絡電話:".$row['phone']."\r\n";
$str .= "連絡地址:".$row['address']."\r\n";
$str .= "\r\n";
$str .= "購買商品:\r\n";
$str .= "商品名稱\t\t數量\t\t單價\t\t總金額\r\n";

$sql = "SELECT * FROM orderitem WHERE oid = ".$oid;
$result = $pdo -> prepare($sql);
$result -> execute();
while($row = $result -> fetch()){
    $itemsql = "SELECT title,price FROM items WHERE itemid = ".$row['itemid'];
    $itemresult = $pdo -> prepare($itemsql);
    $itemresult -> execute();
    $itemrow = $itemresult->fetch();
    $str .= $itemrow['title']."\t\t".$row['qty']."\t\t$".$itemrow['price']."\t\t$".$row['qty']*$itemrow['price']."\r\n";
    $total += $row['qty']*$itemrow['price'];
}
if($total >= 1000){                                    
    $freight = 0;
}else{
    $freight = 60;  
    $total+=$freight;                                  
}
$str .= "\r\n";
$str .= "運費:$".$freight."\r\n";
$str .= "訂單總金額:$".$total;
header("Content-type: text/plain");
header("Accept-Ranges: bytes");
header("Content-Disposition: p_w_upload; filename=".$filename);
header("Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header("Pragma: no-cache" );
header("Expires: 0" );
exit($str);

?>