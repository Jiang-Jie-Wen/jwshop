<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>訂單管理</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php 
      $page="orderlist";
      require_once "./adminnavbar.php";
      // 匯入導覽列
      include_once "./api/connectDB.php";
      $pdo = singletonPDO::getPDO();
    ?>
    <div class="adjnavbar"></div>
    <div class="container-fluid">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8 col-10 m-auto">
                <table class="table align-middle">
                    <tr>
                        <th>訂單編號</th>
                        <th>訂購時間</th>
                        <th>訂單金額</th>
                        <th>訂單內容</th>
                        <th>數量</th>
                        <th style="width: 120px;">功能</th>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                    </tr>
                    <?php
                            $sql = "SELECT oid,createdate,islock FROM orderform";
                            $result = $pdo -> prepare($sql);
                            $result -> execute();                            
                            while($row = $result -> fetch()){
                                $sql2 = "SELECT itemid,qty FROM orderitem where oid = ?";
                                $itemresult = $pdo -> prepare($sql2);
                                $itemresult -> execute(array($row['oid']));
                                $count = $itemresult -> rowCount();
                                echo "<tr><td rowspan='".$count."'>".$row['oid']."</td>";
                                echo "<td rowspan='".$count."'>".$row['createdate']."</td>";
                                echo "<td id ='total".$row['oid']."' rowspan='".$count."'></td>";
                                $firsttime = true;
                                $total=0;
                                while($itemrow = $itemresult->fetch()){
                                    $sql3 = "SELECT price,title,unit FROM items WHERE itemid = ?";
                                    $titlereuslt = $pdo -> prepare($sql3);
                                    $titlereuslt -> execute(array($itemrow['itemid']));
                                    $titlerow = $titlereuslt -> fetch();
                                    
                                    
                                    if($firsttime){
                                        echo "<td>".$titlerow['title']."</td>";
                                        echo "<td>".$itemrow['qty'].$titlerow['unit']."</td>";
                                        echo "<td rowspan='".$count."'>";
                                        // echo '<a href="./api/orderapi.php?oid='.$row['oid'].'" class="btn btn-info d-inline-block">修改訂單</a>';
                                        if($row['islock']){
                                            echo "已列印出貨單!";
                                        }else{
                                            echo '<a href="./api/orderlistapi.php?oid='.$row['oid'].'" class="btn btn-info d-inline-block">列印訂單</a>';
                                        }                                        
                                        echo "</td></tr>";
                                        $firsttime = false;
                                    }else{
                                        echo "<tr><td>".$titlerow['title']."</td>";
                                        echo "<td>".$itemrow['qty'].$titlerow['unit']."</td></tr>";   
                                    }
                                    $total += $titlerow['price']*$itemrow['qty'];
                                }
                                echo "<script>$().ready(function(){document.getElementById('total".$row['oid']."').innerHTML = ".$total.";})</script>";
                            }
                        ?>
                    <!-- <tr>
                        <td rowspan="2">0001</td>
                        <td>商品1</td>
                        <td>1</td>
                        <td rowspan="2"><input class="btn btn-info" type="button" value="列印出貨單" onclick=""></td>
                    </tr>
                    <tr>
                        <td>商品2</td>
                        <td>2</td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>

</body>

</html>