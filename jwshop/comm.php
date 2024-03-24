<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>商品管理</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php
      $page="comm"; 
      require_once "./adminnavbar.php";
      // 匯入導覽列
      include_once "./api/connectDB.php";
      $pdo = singletonPDO::getPDO();
    ?>
    <div class="adjnavbar"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-11 col-md-10 m-auto">
                <div class="border-bottom border-success border-3 pb-0 mt-5">
                    <h1 class=" bg-success mb-0" style="width: max-content;">商品管理</h1>
                </div>

                <div class="text-end my-3">
                    <a href="./addcomm.php" class="btn btn-info">新增商品</a>
                </div>

                <table class="col-12 table align-middle">
                    <tr class="table-secondary">
                        <th>商品名稱</th>
                        <th>商品圖片</th>
                        <th>商品種類</th>
                        <th>商品金額</th>
                        <th>商品單位</th>
                        <th>是否公布</th>
                        <th style="width: 140px;">編輯功能</th>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                    </tr>
                    <?php 
                        $sql = "SELECT * FROM items";
                        $result = $pdo -> prepare($sql);
                        $result -> execute(); 
                        while($row = $result -> fetch()){
                            if($row['isrelease']==1){
                                $isrelase = "是";
                            }else{
                                $isrelase = "否";
                            }
                            $sql2 = "SELECT title FROM category WHERE cid = ".$row['category'];
                            
                            $cateresult = $pdo -> prepare($sql2);
                            $cateresult -> execute();
                            $caterow = $cateresult -> fetch();
                            echo "<tr>
                            <td>".$row['title']."</td>
                            <td><div class='table-img-height'><img  class='h-100 img-fluid' src='./images/".$row['pic']."' alt=''></div></td>
                            <td>".$caterow['title']."</td>
                            <td>".$row['price']."</td>
                            <td>".$row['unit']."</td>
                            <td>".$isrelase."</td>
                            <td><a href='./editcomm.php?itemid=".$row['itemid']."' class='btn btn-info'>編輯</a>
                            <a href='./api/delcommapi.php?itemid=".$row['itemid']."' onclick='return confirm(\"是否確認刪除\")' class='btn btn-info'>刪除</a></td>
                            </tr>
                            ";
                        }
                    ?>
                    <!-- <tr>
                        <td>商品1</td>
                        <td>說明1</td>
                        <td>種類1</td>
                        <td>100</td>
                        <td>顆</td>
                        <td>是</td>
                        <td>
                            <button class="btn btn-info" onclick="">編輯</button>
                            <button class="btn btn-info" onclikc="">刪除</button>
                        </td>
                    </tr> -->

                </table>
            </div>
        </div>
    </div>
</body>

</html>