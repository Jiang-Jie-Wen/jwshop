<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JWShop</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
    <script>
    function inputceil(inval) {
        var val = document.getElementById(inval).value;
        if (val <= 0) {
            document.getElementById(inval).value = 1;
        } else {
            document.getElementById(inval).value = Math.ceil(val);
        }
    }
    </script>
</head>

<body>
    <?php 
      $page="index";
      require_once "./navbar.php";
      // 匯入導覽列         
      include_once "./api/connectDB.php";
      $pdo = singletonPDO::getPDO();
    //   $sql = "SELECT * FROM items";
    //   $result = $pdo -> prepare($sql);
    //   $result -> execute();
    //   $record = $result->rowCount();
    //   $per_page = 12;
    //   $total_page = ceil($record/$per_page);
    //   if(isset($_GET['page'])){
    //     $page = $_GET['page'];
    //   }else{
    //     $page = 1;
    //   }
    //   $start = ($page-1)*$per_page;
        if(isset($_SESSION['addcart']) && $_SESSION['addcart']=="OK"){            
            echo "<script>alert('商品已加入購物車!');</script>";
            $_SESSION['addcart']="";
        }
    ?>
    <script>
    function addcart(id) {
        qty = document.getElementById("comm" + id).value;
        window.location.href = "./api/cartapi.php?id=" + id + "&qty=" + qty;
    }
    </script>
    <div class="adjnavbar"></div>
    <div class="container-fluid  position-relative" style="z-index: 0;">
        <div class="row justify-content-center pt-5">
            <!-- 搜尋欄 -->
            <div class="col-11 col-md-10">
                <form action="#" method="get" name="search">
                    <div class=" container-fluid">
                        <div class="row d-flex justify-content-between">
                            <div class="col-3">
                                <select name="categorylist" class="form-select" id="categorylist">
                                    <option value="*" selected>全部</option>
                                    <?php
                                        $sql = 'SELECT * FROM category';
                                        $result = $pdo -> prepare($sql);
                                        $result -> execute();
                                        while($row = $result -> fetch()){
                                            echo "<option value='".$row['cid']."'>".$row['title']."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="searchtext">
                                    <button class="btn btn-outline-secondary" type="submit">搜尋</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="search">
                </form>
            </div>
        </div>
        <div class="row justify-content-center pt-5">
            <!-- 商品 -->
            <div class="col-11 col-md-10">
                <div class="row">

                    <?php
                    //$sql="SELECT * FROM items WHERE category = ".$_POST['categorylist']." LIMIT ".$start.",".$per_page;
                        if(isset($_GET['action'])&&$_GET['action']=="search"){
                            $sql = "SELECT * FROM items WHERE ";
                            if($_GET['categorylist']!="*"){
                                $sql .= "category = ".$_GET['categorylist']." && ";
                            }
                            $sql .= "title like '%".$_GET['searchtext']."%'";
                            // $sql .= "LIMIT ".$start.",".$per_page;
                            
                        }else{
                            $sql="SELECT * FROM items";
                            // $sql="SELECT * FROM items LIMIT ".$start.",".$per_page;
                        }                        
                        $result = $pdo -> prepare($sql);
                        $result -> execute();
                        $record = $result->rowCount();
                        $per_page = 12;
                        $total_page = ceil($record/$per_page);
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                          }else{
                            $page = 1;
                          }
                        $start = ($page-1)*$per_page;
                        $sql .= " LIMIT ".$start.",".$per_page;
                        $result = $pdo -> prepare($sql);
                        $result -> execute();
                        while($row = $result -> fetch()){
                            echo '
                            <div class="card col-6 col-md-4 col-lg-3 d-inline-block my-2 border-0">
                                <img src="./images/'.$row['pic'].'" alt="圖片" class="img-fluid m-auto d-block">
                                <div class="card-body border">
                                    <h5 class="card-title">'.$row['title'].'</h5>
                                    <p class="card-text">$'.$row['price'].'</p>
                                    <div class="text-center">
                                        <input type="number" value="1" min="1" step="1" class="inputqty" required
                                        style="height:36px;" id="comm'.$row['itemid'].'" onchange="inputceil('."'".'comm'.$row['itemid']."'".')">
                                        <button onclick="addcart('.'\''.$row['itemid'].'\''.')" class="btn btn-primary">加入購物車</button>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?>

                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-5">
            <!-- 分頁 -->
            <div class="col-11 col-md-10">
                <nav>
                    <ul class="pagination justify-content-center">
                        <?php 
                            $prev = $page -1;
                            $next = $page +1;
                            $str="";
                            if(isset($_GET['action'])&&$_GET['action']=="search"){
                                $str = "categorylist=".$_GET['categorylist']."&searchtext=".$_GET['searchtext']."&"."action=".$_GET['action']."&";
                            }
                            if($page > 1){
                                echo '<li class="page-item"><a class="page-link" href="?'.$str.'page=1">首頁</a></li>';
                                echo '<li class="page-item"><a class="page-link" href="?'.$str.'page='.$prev.'">上一頁</a></li>';
                            }
                            if($page < $total_page){
                                echo '<li class="page-item"><a class="page-link" href="?'.$str.'page='.$next.'">下一頁</a></li>';
                                echo '<li class="page-item"><a class="page-link" href="?'.$str.'page='.$total_page.'">末頁</a></li>';
                            }    
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>