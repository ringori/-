<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>5-1</title>
</head>
<body>
   <?php
    
    //DB
    $dsn='';
    $user = '';
    $password = '';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
     $sql = "CREATE TABLE IF NOT EXISTS ringo"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date TEXT,"
    . "pass TEXT"
    .");";
    $stmt = $pdo->query($sql);
    ?>
     <?php
    //投稿
  
    //データを挿入
     if (!empty($_POST["comment"]) && (!empty($_POST["name"])&&(!empty($_POST["pass"])))){
         if(empty($_POST["editnum"])){
    $hinichi=date("Y/m/d/ H:i:s");
    $sql = $pdo -> prepare("INSERT INTO ringo (name, comment, date,pass) VALUES (:name, :comment, :date,:pass)");
    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
    $sql -> bindParam(':date', $date, PDO::PARAM_STR);
    $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $date=$hinichi ;
    $pass=$_POST["pass"];
    $sql -> execute();

         }
    if(!empty($_POST["editnum"])){
        $id =$_POST["editnum"] ; //変更する投稿番号
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $pass=$_POST["pass"];//変更したい名前、変更したいコメントは自分で決めること
    $sql = 'UPDATE ringo SET name=:name,comment=:comment, pass=:pass WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_INT);
    $stmt->execute();

        
        
    }}
    

    //編集関連
    if (!empty($_POST["editnum"])){  
        $id = $_POST["editnum"] ; // idがこの値のデータだけを抽出したい、とする
        $sql = 'SELECT * FROM ringo WHERE id=:id ';
        $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
        $stmt->execute();                             // ←SQLを実行する。
        $results = $stmt->fetchAll(); 
            foreach ($results as $row){
        if($id==$row[0]){//$rowの中にはテーブルのカラム名が入る
            $name=$row[1];
            $comment=$row[2];
            $editnum1=$row[0];
                
            }
                
        }
        
    }
        
    //削除
    if (!empty($_POST["delnum"])&&(!empty($_POST["delnum"]))){
      $delnum = $_POST["delnum"];
      $delet=$_POST["delet"];
      $sql = 'SELECT * FROM ringo ';
     
                    $sql = 'delete from ringo where id=:id and pass=:pass';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $delnum, PDO::PARAM_INT);
                    $stmt->bindParam(':pass', $delet, PDO::PARAM_INT);
                    $stmt->execute();
                    
                
          
      }
        
    
?>
          
    
    
   
   <hl>一番高い買い物は？</hl>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="お名前" style="width:300px" 
        value="<?php echo (!empty($_POST["edit"]) && !empty($name)) ? $name : ''; ?>"><br>
        <input type="text" name="comment" placeholder="コメント" style="width:300px"
        value="<?php echo (!empty($_POST["edit"]) && !empty($comment)) ? $comment : ''; ?>"><br>
        <input type="text" name="pass" placeholder="パスワード" style="width:300px"><br>
        <input type ="hidden" name="editnum1" 
        value="<?php echo (!empty($_POST["edit"])) ? $edit : ''; ?>">
        <input type="submit" name="submit" value="送信"><br></br>
    </form>
    
    <form method="POST" action="">
        <input type="number" name="delnum"placeholder="削除投稿番号"><br>
        <input type="delpass" name="pass" placeholder="パスワード" style="width:150px"><br>
        <input type="submit" name="delet" value="削除"><br></br>
    </form>
    
    <form method="POST" action="">
        <input type="number" name="editnum"placeholder="編集投稿番号"><br>
        <input type="editpass" name="pass" placeholder="パスワード" style="width:150px"><br>
        <input type="submit" name="edit"value="編集">
    </form>
    <?php
    $sql = 'SELECT * FROM ringo';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo "投稿番号:".$row['id']."<br>";
        echo $row['name']." -- ";
        echo $row['date']."<br>";
        echo ">>>".$row['comment'].'<br>';
        echo "<hr>";
    }
    ?>
    