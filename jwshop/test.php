<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once('./link.php'); ?>
</head>

<body>
    <nav class="navbar navbar-light bg-light position-fixed w-100" style="z-index: 1;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">JWShop</a>
            <div class="d-flex">
                <a class="btn btn-info mx-2" href="cart.php">購物車</a>



                <div class='btn-group mx-2'>
                    <button type='button' class='btn btn-info dropdown-toggle' data-bs-toggle='dropdown'
                        data-bs-target='#memberlink' aria-expanded='false'>
                        會員功能
                    </button>
                    <ul class='dropdown-menu dropdown-menu-end' aria-labelledby='userlink' id='memberlink'>
                        <li><a class='dropdown-item' href='edit.php'>個人資料管理</a></li>
                        <li><a class='dropdown-item' href='order.php'>查看訂單</a></li>
                        <li>
                            <hr class='dropdown-divider' />
                        </li>
                        <li><a class='dropdown-item' href='#'>登出</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <div class="adjnavbar"></div>
    <!-- <div style="height: 80px;width:100%;"></div> -->
    <div class=" container-fluid position-relative" style="z-index: 0;">
        <div class="row" style="z-index: 0;">
            <div style="z-index: 0;">
                <div class="input-group mb-3 " style="z-index: 0;">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">Dropdown</button>
                    <ul class="dropdown-menu" id="commlist">
                        <li><a class="dropdown-item">Action</a></li>
                        <li><a class="dropdown-item">Another action</a></li>
                        <li><a class="dropdown-item">Something else here</a></li>

                        <li><a class="dropdown-item">Separated link</a></li>
                    </ul>
                    <input type="text" class="form-control" aria-label="Text input with dropdown button">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>