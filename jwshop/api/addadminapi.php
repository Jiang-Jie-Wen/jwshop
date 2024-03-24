<?php 
    include_once "./connectDB.php";
    session_start();
    $pdo = singletonPDO::getPDO();
    $sql = "SELECT * FROM admin WHERE account = ?";
    $result = $pdo -> prepare($sql);
    $result -> execute(array($_POST['account']));
    $row=$result->fetch();
    if($row == ""){                    
        $sql = "INSERT INTO admin (name,account,password,email,createby) VALUES (?,?,?,?,?)";
        $data = [$_POST['name'],$_POST['account'],$_POST['password'],$_POST['email'],$_SESSION['aid']];
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute($data);
        $_SESSION['addadmin']="OK";   
        header("Location:../addadmin.php");
        // exit;
    }
    else{        
        $_SESSION['addadmin']="error";        
        header("Location:../addadmin.php");
        // exit;
    }
    
    
?>