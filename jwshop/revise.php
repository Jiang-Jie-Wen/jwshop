<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php 
      $page="register";
      require_once "./navbar.php";
      // 匯入導覽列
    ?>
    <div class="adjnavbar"></div>
    <div class="container-fluid">
        <div class="row justify-content-center pt-5">
            <div class="col-md-10 col-11">
                <form action="#" method="post">
                    <table class="table align-middle">
                        <tr class="table-secondary">
                            <th class="table-comm">商品明細</th>
                            <th class="table-price">價格</th>
                            <th class="table-qty">數量</th>
                            <th class="table-subtotal">小計</th>
                            <th class="table-change">變更</th>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr class="border border-start border-end">
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
                        </tr>
                    </table>
                    <div class=" float-end">
                        <a class="btn btn-info" href="./order.php">返回</a>
                        <input class="btn btn-info" type="submit" value="修改">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>