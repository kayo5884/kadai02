<?php
$name = $_POST['name'];
$url = $_POST['url'];
$text = $_POST['text'];

try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=bookmark;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo->prepare(
  "INSERT INTO bookmark_table(id,name,url,text,indate)
  VALUES(NULL, :name, :url, :text, sysdate() )"
);

$stmt->bindValue(':name', $name, PDO::PARAM_STR);  
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  
$stmt->bindValue(':text', $text, PDO::PARAM_STR);  

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("ErrorMassage:".$error[2]);
}else{
  header('Location: index.php');
}
?>