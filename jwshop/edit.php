<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>編輯個人資料</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php 
      $page="edit";
      require_once "./navbar.php";
      require_once "./api/connectDB.php";
      // 匯入導覽列
      if(isset($_SESSION['edit']) && $_SESSION['edit']=="error"){
        echo "<script>alert('新密碼與確認新密碼不同，請重新填寫')</script>";
        $_SESSION['edit']="false";
      }
      if(isset($_SESSION['edit']) && $_SESSION['edit']=="OK"){
        echo "<script>alert('更改完成!!!')</script>";
        $_SESSION['edit']="false";
      }
      $pdo = singletonPDO::getPDO();
      $sql = "SELECT * FROM user WHERE account = '".$_SESSION['user']."'";
      $result = $pdo -> prepare($sql);
      $result -> execute();
      $row = $result->fetch();
    ?>
    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-lg-6 col-md-8 col-10 border border-1 border-black bg-light rounded p-3  text-center">
                <form action="./api/editapi.php" method="post" onsubmit="return confirm('是否確認修改?')">
                    <div class="input-group mb-3">
                        <span class="input-group-text">姓名</span>
                        <input type="text" class="form-control" name="name" id="name"
                            value="<?php echo $row['account']; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">新密碼</span>
                        <input type="password" class="form-control" minlength="6" maxlength="12" name="password"
                            id="password" placeholder="密碼請設置為6~12碼的英文數字組合" pattern="[0-9A-Za-z]{6,12}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">確認新密碼</span>
                        <input type="password" class="form-control" minlength="6" maxlength="12" name="checkpassword"
                            id="checkpassword" placeholder="密碼請設置為6~12碼的英文數字組合" pattern="[0-9A-Za-z]{6,12}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">信箱</span>
                        <input type="email" class="form-control" name="email" id="email"
                            value="<?php echo $row['email']; ?>" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">電話</span>
                        <input type="tel" class="form-control" name="phone" id="phone"
                            value="<?php echo $row['phone']; ?>" required pattern="[0-9]{10}"
                            placeholder="格式為10碼，ex:0912345678">
                    </div>
                    <div class=" input-group mb-3">
                        <span class="input-group-text">住址</span>
                        <input type="text" class="form-control" name="address" id="address"
                            value="<?php echo $row['address']; ?>" required>
                    </div>
                    <input type="hidden" name="action" value="edit">
                    <input class="btn btn-info" type="submit" value="修改個人資料">
                </form>
            </div>
        </div>
    </div>
</body>

</html>