<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>查看訂單</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php 
      $page="order";
      require_once "./navbar.php";
      // 匯入導覽列      
      include_once "./api/connectDB.php";
      $pdo = singletonPDO::getPDO();
    ?>
    <div class="adjnavbar"></div>
    <div class="container-fluid">
        <div class="row justify-content-center pt-5">
            <div class="col-md-10 col-12">
                <form action="#" method="post">
                    <table class="table align-middle">
                        <tr class="table-secondary">
                            <th>訂單編號</th>
                            <th>訂購時間</th>
                            <th>訂單金額</th>
                            <th>商品名稱</th>
                            <th>數量</th>
                            <th>功能</th>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                        </tr>
                        <?php
                            $sql = "SELECT oid,createdate,islock FROM orderform where uid = ?";
                            $result = $pdo -> prepare($sql);
                            $result -> execute(array($_SESSION['uid']));                            
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
                                            echo "訂單已送出，無法取消!";
                                        }else{
                                            echo '<a href="./api/orderdelapi.php?oid='.$row['oid'].'" class="btn btn-info d-inline-block">取消訂單</a>';
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
                            <td rowspan="2">000001</td>
                            <td rowspan="2">2023-09-17 05:00:00</td>
                            <td rowspan="2">$160</td>
                            <td>商品1</td>
                            <td>1</td>
                            <td rowspan="2"> -->
                        <!-- <div>訂單已寄送無法修改</div> -->
                        <!-- <input class="btn btn-info" type="submit" value="取消訂單" name="action">
                            </td>
                        </tr>
                        <tr>
                            <td>商品2</td>
                            <td>0</td>
                        </tr> -->
                    </table>

                </form>
            </div>
        </div>
    </div>
</body>

</html>