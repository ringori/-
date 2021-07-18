<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>5-1</title>
</head>
<body>
   <?php
    //DB
    $dsn='mysql:dbname=tb230059db;host=localhost';
    $user = 'tb-230059';
    $password = 'HvR93eBRYf';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
     $sql = "CREATE TABLE IF NOT EXISTS tbtest"."CREATE TABLE IF NOT EXISTS tbtest1"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
   ?>
   
    <form method="POST" action="">
        <input type="text" name="name" placeholder="お名前" style="width:300px" 
        value="<?php echo (!empty($_POST["edit"]) && !empty($name)) ? $name : ''; ?>"><br>
        <input type="text" name="comment" placeholder="コメント" style="width:300px"
        value="<?php echo (!empty($_POST["edit"]) && !empty($comment)) ? $comment : ''; ?>"><br>
        <input type="text" name="password" placeholder="パスワード" style="width:300px"><br>
        <input type ="hidden" name="edit_num" 
        value="<?php echo (!empty($_POST["edit"])) ? $edit : ''; ?>">
        <input type="submit" name="submit" value="送信"><br></br>
    </form>
    
    <form method="POST" action="">
        <input type="number" name="delete"placeholder="削除投稿番号"><br>
        <input type="text" name="password" placeholder="パスワード" style="width:150px"><br>
        <input type="submit" value="削除"><br></br>
    </form>
    
    <form method="POST" action="">
        <input type="number" name="edit"placeholder="編集投稿番号"><br>
        <input type="text" name="password" placeholder="パスワード" style="width:150px"><br>
        <input type="submit" value="編集">
    </form>
    
    