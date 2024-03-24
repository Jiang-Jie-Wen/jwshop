<?php 
    class singletonPDO{
        private static $pdo = null;

        public static function getPDO(){
            if(self::$pdo == null){
                try{
                    self::$pdo = new PDO("mysql:host = localhost;dbname=jwshop","root","1234");
                    self::$pdo ->exec("set names utf8");
                    self::$pdo ->exec("set character_set_client = utf8");
                    self::$pdo ->exec("set character_set_results = utf8");                    
                }catch(PDOException $error){
                    echo "錯誤訊息:".$error;
                }
                return self::$pdo;
            }
        }        
    } 
?>