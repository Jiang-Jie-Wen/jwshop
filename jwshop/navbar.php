<script>
// function logout() {
//     if (confirm('是否確認登出?')) {
//         location.href("./api/logoutapi.php");
//     }
// }
</script>

<nav class="navbar navbar-light bg-light w-100 position-fixed" style="z-index: 1;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">JWShop</a>
        <div class="d-flex">
            <a class="btn btn-info mx-2" href="cart.php">購物車</a>
            <!-- 常駐 -->
            <?php
                session_start();
                if (isset($_SESSION['login']) && $_SESSION['login']=="true") { //登入 登入時顯示(購物車+會員功能)
                    echo "<div class='btn-group mx-2'>
                            <button type='button' class='btn btn-info dropdown-toggle' data-bs-toggle='dropdown' data-bs-target='#memberlink'
                                aria-expanded='false'>
                                會員功能
                            </button>
                            <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='userlink' id='memberlink'>
                                <li><a class='dropdown-item' href='edit.php'>個人資料管理</a></li>
                                <li><a class='dropdown-item' href='order.php'>查看訂單</a></li>
                                <li>
                                    <hr class='dropdown-divider' />
                                </li>
                                <li><a class='dropdown-item' 
                                href='./api/logoutapi.php'>登出</a></li>
                            </ul>
                        </div>";
                } else { //未登入
                    
                    if ($page != "login") {
                        echo "<a class='btn btn-info mx-2' href='login.php'>登入</a>";
                        //未登入時顯示(購物車+登入)
                    } else {
                        echo "<a class='btn btn-info mx-2' href='register.php'>註冊</a>";
                        //登入頁面顯示(購物車+註冊)
                    }
                }
            ?>
        </div>
    </div>
</nav>