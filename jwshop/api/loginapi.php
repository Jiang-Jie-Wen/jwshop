<?php

// use function PHPSTORM_META\type;

    require_once("./connectDB.php");
    session_start();
    $pdo = singletonPDO::getPDO();
    if($_POST['action']=="login"){
        // $data = [$_POST['account']];
        // $_POST['password']
        $sql = "SELECT * FROM user WHERE account = ?";
        $result = $pdo -> prepare($sql);
        $result -> execute(array($_POST['account']));
        while($row = $result -> fetch()){
            // echo $row['password'];
            // echo $_POST['password'];
            if(strcmp($_POST['password'],$row['password'])==0){
                $_SESSION['user']=$_POST['account'];
                $_SESSION['login']="true";
                $_SESSION['uid']=$row['uid'];
                header("Location: ../index.php");
                exit;
            }else{
                $_SESSION['login']="error";   
            }               
        }                 
        header("Location: ../login.php");
    }
    
?>