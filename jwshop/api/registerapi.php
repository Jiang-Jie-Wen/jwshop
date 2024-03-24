<?php 
    include_once "./connectDB.php";
    $pdo = singletonPDO::getPDO();
    $sql = "SELECT * FROM user WHERE account = ?";
    $result = $pdo -> prepare($sql);
    $result -> execute(array($_POST['account']));
    $row=$result->fetch();
    if($row == ""){                    
        $sql = "INSERT INTO user (name,account,password,email,phone,address) VALUES (?,?,?,?,?,?)";
        $data = [$_POST['name'],$_POST['account'],$_POST['password'],$_POST['email'],$_POST['phone'],$_POST['address']];
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute($data);
        header("Location:../index.php");
        // exit;
    }
    else{
        session_start();
        $_SESSION['register']="error";        
        header("Location:../register.php");
        // exit;
    }
    
    
?>