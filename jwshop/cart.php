<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>購物車</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
    <script>
    function inputceil(inval) {
        var str = "comm" + String(inval);
        var val = document.getElementById(str).value;
        if (val <= 0) {
            document.getElementById(str).value = 1;
        } else {
            document.getElementById(str).value = Math.ceil(val);
        }
        qty = document.getElementById(str).value;
        location.href = "./api/cartchangeapi.php?id=" + inval + "&qty=" + qty;;
    }
    </script>
</head>

<body>
    <?php 
      $page="cart";
      require_once "./navbar.php";
      // 匯入導覽列
    ?>
    <div class="adjnavbar"></div>
    <div class="container-fluid">
        <div class="row justify-content-center pt-5">
            <div class="col-md-10 col-12">
                <form action="./checkout.php" method="post">
                    <table class="table align-middle">
                        <tr class="table-secondary">
                            <!-- <th class="table-comm">商品名稱</th>
                            <th class="table-price">價格</th>
                            <th class="table-qty">數量</th>
                            <th class="table-subtotal">小計</th>
                            <th class="table-change">變更</th> -->
                            <th>商品名稱</th>
                            <th>價格</th>
                            <th>數量</th>
                            <th>小計</th>
                            <th>變更</th>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                        <?php 
                            if(empty($_SESSION['cart'])){
                                $checkoutshow = false;
                                echo "<tr><td colspan='5' class='text-center fs-1'>購物車內無商品!</td></tr>";
                            }else{
                                
                                $checkoutshow = true;
                                $arr = $_SESSION['cart'];
                                include_once "./api/connectDB.php";
                                $pdo = singletonPDO::getPDO();
                                foreach($arr as $v){   
                                    
                                    $sql = "SELECT title,price,unit FROM items WHERE itemid = ?";
                                    $result = $pdo -> prepare($sql);
                                    $result -> execute(array($v[0]));
                                    $row = $result ->fetch();
                                    echo "<tr><td>".$row['title']."</td>";
                                    echo "<td>".$row['price']."</td>";
                                    
                                    echo "<td>".'<input type="number"  min="1" step="1" class="inputqty" required
                                    style="height:36px;" id="comm'.$v[0].'" onchange="inputceil('."'".$v[0]."'".')" value="'.$v[1].'">'.$row['unit']."</td>";
                                    echo "<td>".$v[1]*$row['price']."</td>";

                                    echo '<td><a href="./api/cartdelapi.php?id='.$v[0].'" class="btn btn-info d-inline-block" onclick="if(!confirm(\'確認刪除商品?\')){return false;}">刪除</a></td></tr>';
                                   
                                }
                            }
                            
                        ?>
                        <!-- <tr class="border border-start border-end">
                            <td class="">
                                <div class="table-img-height">
                                    <img class="h-100 img-fluid comm-img" src="./images/bgs.jpg" alt="">
                                </div>
                            </td>
                            <td>$100</td>
                            <td><input type="number" value="1" min="1" step="1" class="inputqty" required></td>
                            <td>$100</td>
                            <td><a href="" class="btn btn-info d-block m-auto">刪除</a></td>
                        </tr>
                        <tr class="border border-start border-end">
                            <td>
                                <div class="table-img-height">
                                    <img class="h-100 img-fluid" src="./images/bgs.jpg" alt="">
                                </div>
                            </td>
                            <td>$100</td>
                            <td><input type="number" value="1" min="1" step="1" class="inputqty" required></td>
                            <td>$100</td>
                            <td><a href="" class="btn btn-info d-block m-auto">刪除</a></td>
                        </tr> -->
                    </table>
                    <?php 
                        if($checkoutshow){
                            echo '
                            <div class=" float-end">
                                <input class="btn btn-info" type="submit" value="結帳">
                            </div>
                            ';
                        }
                    ?>

                </form>
            </div>
        </div>
    </div>
</body>

</html>