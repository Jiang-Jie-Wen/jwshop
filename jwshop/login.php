<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>登入</title>
    <style>
    body {
        background-image: url('./images/login.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
    </style>
    <?php 
        require_once('./link.php');
    ?>
    <!-- 引用Bootstrap CSS、JS 和 JQuery -->
</head>

<body>
    <?php 
      $page="login";
    //   $login = false;
      require_once "./navbar.php";
      // 匯入導覽列
      if(isset($_SESSION['login']) && $_SESSION['login']=="error"){
        echo "<script>alert('帳號密碼錯誤，請重新登入')</script>";
        $_SESSION['login']="false";
        }
    ?>
    <div class="container-fluid vh-100">
        <div class="row align-items-center justify-content-center h-100">
            <div
                class="col-lg-6 col-md-8 col-11 border border-1 border-black bg-light  bg-opacity-75 rounded pt-5 text-center">
                <h1 class="pb-4">會員登入</h1>
                <form action="./api/loginapi.php" method="post">
                    <div class="input-group mb-3 w-75 mx-auto">
                        <span class="input-group-text">帳號</span>
                        <input type="text" class="form-control" name="account" id="account">
                    </div>
                    <div class="input-group w-75 mx-auto">
                        <span class="input-group-text">密碼</span>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <input type="hidden" name="action" value="login">
                    <input type="submit" name="login" value="登入" class="btn btn-info my-4">
                </form>
            </div>
        </div>
    </div>
</body>

</html>