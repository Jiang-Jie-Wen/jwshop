<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>結帳</title>
    <?php 
        require_once('./link.php'); 
        // 引用Bootstrap CSS、JS 和 JQuery
        
    ?>


</head>

<body>
    <?php 
      $page="checkout";
      require_once "./navbar.php";
      // 匯入導覽列
      require_once('./api/connectDB.php');
      if($_SESSION['user']==''){
        header("Location:./login.php");
      }
        $pdo = singletonPDO::getPDO();
        $uid = $_SESSION['uid'];
        $sql = "SELECT name,phone,address FROM user WHERE uid = ".$uid;
        $result = $pdo -> prepare($sql);
        $result -> execute();
        $row = $result -> fetch();
        $name = $row['name'];
        $phone = $row['phone'];
        $address = $row['address'];
    ?>
    <script>
    function checkboxclick() {
        var check = document.getElementById("equal");
        var user = document.getElementById("user");
        var phone = document.getElementById("phone");
        var address = document.getElementById("address");
        if (check.checked) {
            user.value = "<?php echo $name?>";
            phone.value = "<?php echo $phone?>";
            address.value = "<?php echo $address?>";
        } else {
            user.value = "";
            phone.value = "";
            address.value = "";
        }
    }
    </script>
    <div class="adjnavbar"></div>
    <div class="container-fluid">
        <div class="row pt-3">
            <div class="col col-9 m-auto">
                <form action="./api/checkoutapi.php" method="post" onsubmit="return confirm('確認資料是否無誤?');">
                    <div class="border-bottom border-success border-3 pb-0">
                        <h1 class=" bg-success mb-0" style="width: max-content;border-radius:5px 5px 0 0;">填寫訂購資料</h1>
                    </div>
                    <br>
                    <div class="input-group mb-3 w-50">
                        <span class="input-group-text spanwidth">收件人</span>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="input-group mb-3 w-50">
                        <span class="input-group-text spanwidth">電話</span>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="input-group mb-3 w-50">
                        <span class="input-group-text spanwidth">收件地址</span>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <input type="checkbox" id="equal" onchange="checkboxclick()">資料與帳戶相同

                    <div class="border-bottom border-success border-3 pb-0 pt-3">
                        <h1 class=" bg-success mb-0" style="width: max-content;border-radius:5px 5px 0 0;">訂單內容</h1>
                    </div>
                    <div class="width-100">
                        <table class="col-12 mt-3">
                            <tr class="table-secondary">
                                <th class="table-comm">商品明細</th>
                                <th class="table-price">價格</th>
                                <th class="table-qty">數量</th>
                                <th class="table-subtotal">小計</th>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <?php
                                $arr=$_SESSION['cart'];
                                $total = 0;
                                foreach($arr as $val){
                                    $sql = "SELECT title,price,pic FROM items WHERE itemid = ".$val[0];
                                    $result = $pdo -> prepare($sql);
                                    $result -> execute();
                                    $row = $result -> fetch();
                                    echo '
                                    <tr class="border border-start border-end">
                                        <td>
                                            <div class="table-img-height">
                                                <img class="h-100 img-fluid" src="./images/'.$row['pic'].'" alt="./images/bgs.jpg">
                                            </div>
                                        </td>
                                        <td>$'.$row['price'].'</td>
                                        <td>'.$val[1].'</td>
                                        <td>$'.$row['price']*$val[1].'</td>
                                    </tr>
                                    ';
                                    $total+=$row['price']*$val[1];
                                }
                            ?>
                            <!-- <tr class="border border-start border-end">
                                <td>
                                    <div class="table-img-height">
                                        <img class="h-100 img-fluid" src="./images/bgs.jpg" alt="">
                                    </div>
                                </td>
                                <td>$100</td>
                                <td>1</td>
                                <td>$100</td>
                            </tr> -->
                        </table>
                    </div>
                    <div class="width-100 pt-3">
                        <table class="col-12">
                            <tr>
                                <td colspan="4" class=" text-end">
                                    商品小計 $<?php echo $total?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class=" text-end">
                                    運費:$<?php 
                                    if($total >= 1000){                                    
                                        $freight = 0;
                                    }else{
                                        $freight = 60;                                    
                                    }
                                    echo $freight
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class=" text-end">
                                    訂單金額:$<?php echo $total+$freight?>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="text-end pt-3">
                        <a href="./cart.php" class="btn btn-info">返回</a>
                        <input class="btn btn-info" type="submit" value="送出訂單">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>