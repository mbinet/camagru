<?php
    $DB_DSN = 'mysql:dbname=camagru;host=' . getenv('IP') . '';
    $DB_USER = 'mbinet';
    $DB_PASSWORD = '';
    
    
    try { 
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
