<?php

// use function PHPSTORM_META\type;

    require_once("./connectDB.php");
    session_start();
    $pdo = singletonPDO::getPDO();
    if($_POST['action']=="edit"){       
        // $sql = "SELECT * FROM user WHERE account = ?";
        // $result = $pdo -> prepare($sql);
        // $result -> execute(array($_POST['account']));
        if($_POST['password']=="" && $_POST['checkpassword']==""){
            $sql = "UPDATE user SET name = ?,email = ?,phone = ?,address = ? WHERE uid = ?";
            $data = [$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address'],$_SESSION['uid']];
            $result = $pdo -> prepare($sql);
            $result -> execute($data);
            $row = $result -> fetch();
            $_SESSION['edit']="OK";
            header("Location: ../edit.php");
            exit;
        }else{
            if(strcmp($_POST['password'],$_POST['checkpassword'])==0){
                $sql = "UPDATE user SET name = ?,email = ?,phone = ?,address = ?,password = ? WHERE uid = ?";
                $data = [$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['password'],$_SESSION['uid']];
                $result = $pdo -> prepare($sql);
                $result -> execute($data);
                $row = $result -> fetch();
                $_SESSION['edit']="OK";
                header("Location: ../edit.php");
                exit;
            }else{
                $_SESSION['edit']="error";   
            }    
        }                         
        header("Location: ../edit.php");
    }
    
?>