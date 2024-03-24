<?php

// use function PHPSTORM_META\type;

    require_once("./connectDB.php");
    session_start();
    $pdo = singletonPDO::getPDO();
    if($_POST['action']=="login"){
        // $data = [$_POST['account']];
        // $_POST['password']
        $sql = "SELECT * FROM admin WHERE account = ?";
        $result = $pdo -> prepare($sql);
        $result -> execute(array($_POST['account']));
        while($row = $result -> fetch()){
            // echo $row['password'];
            // echo $_POST['password'];
            if(strcmp($_POST['password'],$row['password'])==0){
                $_SESSION['admin']=$_POST['account'];
                $_SESSION['adminlogin']="true";
                $_SESSION['aid']=$row['aid'];
                header("Location: ../comm.php");
                exit;
            }else{
                $_SESSION['adminlogin']="error";   
            }               
        }            
        header("Location: ../admin.php");
    }
    
?>