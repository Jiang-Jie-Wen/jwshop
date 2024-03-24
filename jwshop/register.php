<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>註冊</title>
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
      $page="register";
      require_once "./navbar.php";
      // 匯入導覽列
      if(isset($_SESSION['register']) && $_SESSION['register']=="error"){
        echo "<script>alert('此帳號已經註冊!請換一個帳號!');</script>";
        $_SESSION['register']="";
      }
    ?>
    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-lg-6 col-md-8 col-10 border border-1 border-black bg-light rounded p-3  text-center">
                <form action="./api/registerapi.php" method="post" name="registerform">
                    <div class="input-group mb-3">
                        <span class="input-group-text">姓名</span>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">帳號</span>
                        <input type="text" class="form-control" name="account" id="account" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">密碼</span>
                        <input type="password" class="form-control" name="password" id="password" required minlength="6"
                            maxlength="12" placeholder="密碼請設置為6~12碼的英文數字組合" pattern="[0-9A-Za-z]{6,12}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">確認密碼</span>
                        <input type="password" class="form-control" name="checkpassword" id="checkpassword" required
                            minlength="6" maxlength="12" placeholder="密碼請設置為6~12碼的英文數字組合" pattern="[0-9A-Za-z]{6,12}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">信箱</span>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">電話</span>
                        <input type="tel" class="form-control" name="phone" id="phone" required pattern="[0-9]{10}"
                            placeholder="格式為10碼，ex:0912345678">
                    </div>
                    <div class=" input-group mb-3">
                        <span class="input-group-text">住址</span>
                        <input type="text" class="form-control" name="address" id="address" required>
                    </div>
                    <div class="row justify-content-around">
                        <input type="hidden" name="action" value="login">
                        <div class="col"><input type="button" value="註冊帳戶" class="btn btn-info" onclick="sub()">
                        </div>
                        <div class="col"><a href="index.php" class="btn btn-info">返回首頁</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>