<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增商品</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php
      $page="addcomm"; 
      require_once "./adminnavbar.php";
      // 匯入導覽列
      include_once "./api/connectDB.php";
      $pdo = singletonPDO::getPDO();
      if(isset($_POST['action']) && $_POST['action']=="addcomm"){
        if($_FILES['pic']['type'] == "image/png" || $_FILES['pic']['type'] == "image/jpg" || $_FILES['pic']['type'] == "image/jpeg"){
            $categorysql = "SELECT cid FROM category WHERE title = '".$_POST['category']."'";//-------
            $categoryresult = $pdo -> prepare($categorysql);
            $categoryresult -> execute();
            $categoryrow = $categoryresult ->fetch();
            if($categoryrow['cid']==""){//無此種類 新增
                $categorysql = "INSERT INTO category (title) VALUES ('".$_POST['category']."')";
                $categoryresult = $pdo -> prepare($categorysql);
                $categoryresult -> execute();
                $categorysql = "SELECT cid FROM category WHERE title = '".$_POST['category']."'";
                $categoryresult = $pdo -> prepare($categorysql);
                $categoryresult -> execute();
                $categoryrow = $categoryresult ->fetch();
                $category =$categoryrow['cid'];
            }else{
                $category =$categoryrow['cid'];
            }//-------
            $sql = "INSERT INTO items (title,price,unit,isrelease,category,pic) VALUES (?,?,?,?,?,?)";
            $picname = $_SESSION['aid']."_".time();            
            if($_FILES['pic']['type'] == "image/png"){
                $picname .= ".png";
            }
            if($_FILES['pic']['type'] == "image/jpg"){
                $picname .= ".jpg";
            }
            if($_FILES['pic']['type'] == "image/jpeg"){
                $picname .= ".jpeg";
            }
            $data = array($_POST['title'],$_POST['price'],$_POST['unit'],$_POST['isrelease'],$category,$picname);
            $result = $pdo -> prepare($sql);
            $result -> execute($data);    
            move_uploaded_file($_FILES["pic"]["tmp_name"],"./images/".$picname);
            echo "<script>alert('新增商品完成!');</script>";  
        }else{
            echo "<script>alert('請選擇 png 、 jpg 或 jpeg 檔上傳');</script>";            
        }
      }
    ?>
    <div class="adjnavbar"></div>
    <div class="container-fluid mt-5">
        <div class="row pt-3">
            <div class="col-11 col-md-10 m-auto text-center">
                <form action="./addcomm.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3 w-75 mx-auto">
                        <span class="input-group-text">商品名稱</span>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    <div class="input-group mb-3 w-75 mx-auto">
                        <label class="input-group-text" for="pic">商品圖片</label>
                        <input type="file" class="form-control" name="pic" id="pic" required
                            accept="image/jpeg,image/jpg,image/png" placeholder="僅能上傳jpg/jpeg/png檔">
                    </div>
                    <div class="input-group mb-3 w-75 mx-auto">
                        <span class="input-group-text">商品價格</span>
                        <input type="number" class="form-control" name="price" id="price" required>
                    </div>
                    <div class="input-group mb-3 w-75 mx-auto">
                        <span class="input-group-text">商品單位</span>
                        <input type="text" class="form-control" name="unit" id="unit" required>
                    </div>
                    <div class="input-group mb-3 w-75 mx-auto">
                        <label class="input-group-text" for="category">商品種類</label>
                        <input class="form-control" list="categorylist" id="category" name="category" required>
                        <datalist id="categorylist">
                            <!-- <select class="form-select" name="category" id="category">-->
                            <?php
                                $sql = "SELECT cid,title FROM category";
                                $result = $pdo -> prepare($sql);
                                $result -> execute();
                                while($row = $result -> fetch()){
                                    echo "<option value='".$row['title']."'>";
                                    // echo "<option value='".$row['cid']."'>".$row['title']."</option>";
                                }
                            ?>
                            <!--</select> -->
                        </datalist>
                    </div>
                    <div class="input-group mb-3 w-75 mx-auto">
                        <label class="input-group-text">是否公布</label>
                        <select class="form-select" name="isrelease" id="isrelease">
                            <option value="1" selected>是</option>
                            <option value="0">否</option>
                        </select>
                    </div>
                    <input type="hidden" name="action" value="addcomm">
                    <input type="submit" name="addcomm" value="新增商品" class="btn btn-info my-4">
                </form>
            </div>
        </div>
    </div>
</body>

</html>