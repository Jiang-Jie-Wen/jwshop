<?php 
    session_start();
?>
<nav class="navbar navbar-light bg-light position-fixed w-100">
    <div class="container-fluid">
        <span class="navbar-brand">JWShop管理系統</span>
        <div class="d-flex">
            <a class="btn btn-light mx-2" href="addadmin.php">新增管理者</a>
            <!--  -->
            <a class="btn btn-light mx-2" href="comm.php">商品管理</a>
            <!--  -->
            <a class="btn btn-light mx-2" href="orderlist.php">訂單管理</a>
            <!--  -->
            <a class="btn btn-light mx-2" href="./api/adminlogoutapi.php">登出</a>
            <!--  -->
        </div>
    </div>
</nav>