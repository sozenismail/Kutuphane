<?php
    // error_reporting(0);
    defined('DB_DSN') or define('DB_DSN', 'mysql:host=localhost; dbname=kutuphane; charset=utf8');
	defined('DB_USR') or define('DB_USR', 'root');
	defined('DB_PWD') or define('DB_PWD', '');
    try{
        $db = new PDO(DB_DSN,DB_USR, DB_PWD, 
                        array(
                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    ));
    }catch(PDOException $e){
        echo $e->getMessage();
    }

    session_start();
?>