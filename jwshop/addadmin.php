<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>新增管理者</title>
    <?php require_once('./link.php'); ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
    <script>
    function sub() {
        $pwd = document.getElementById('password').value;
        $cpwd = document.getElementById('checkpassword').value;
        if ($pwd == $cpwd) {
            registerform.submit();
        } else {
            alert("密碼輸入不相同!");
            document.getElementById('password').value = "";
            document.getElementById('checkpassword').value = "";
        }
    }
    </script>
</head>

<body>
    <?php 
      $page="addadmin";
      require_once "./adminnavbar.php";
      // 匯入導覽列
      if(isset($_SESSION['addadmin']) && $_SESSION['addadmin']=="error"){
        echo "<script>alert('此帳號已經註冊!請換一個帳號!');</script>";
        $_SESSION['addadmin']="";
      }
      if(isset($_SESSION['addadmin']) && $_SESSION['addadmin']=="OK"){
        echo "<script>alert('新增管理者成功!');</script>";
        $_SESSION['addadmin']="";
      }
    ?>
    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-12 col-md-10 col-lg-8 m-auto">
                <form action="./api/addadminapi.php" method="post">
                    <div class="border-bottom border-success border-3 pb-0">
                        <h1 class=" bg-success mb-0" style="width: max-content;">新增管理者</h1>
                    </div>
                    <br>
                    <div class="input-group mb-3 w-100">
                        <span class="input-group-text spanwidth">姓名</span>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="input-group mb-3 w-100">
                        <span class="input-group-text spanwidth">帳號</span>
                        <input type="text" class="form-control" name="account" id="account" required>
                    </div>
                    <div class="input-group mb-3 w-100">
                        <span class="input-group-text spanwidth">密碼</span>
                        <input type="password" class="form-control" required minlength="6" maxlength="12"
                            name="password" id="password" placeholder="密碼長度請設置為6~12碼的英文數字組合"
                            pattern="[0-9A-Za-z]{6,12}">
                    </div>
                    <div class="input-group mb-3 w-100">
                        <span class="input-group-text spanwidth">確認密碼</span>
                        <input type="password" class="form-control" required minlength="6" maxlength="12"
                            name="checkpassword" id="checkpassword" placeholder="密碼長度請設置為6~12碼的英文數字組合"
                            pattern="[0-9A-Za-z]{6,12}">
                    </div>
                    <div class="input-group mb-3 w-100">
                        <span class="input-group-text spanwidth">信箱</span>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="text-end">
                        <input class="btn btn-info" type="reset" class="btn" value="重新填寫">
                        <input class="btn btn-info" type="submit" class="btn" value="新增">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>