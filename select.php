<?php
try {
  $pdo = new PDO('mysql:dbname=bookmark;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM bookmark_table");

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
    $view .=$result['indate'].':'.$result['name'].' '.$result['url']. ' '.$result['text'];
    $view .= "</p>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
