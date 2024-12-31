<?php

// 1.DB接続する
require_once('funcs.php'); // 関数を定義しているファイルを呼び出す
$pdo = db_conn();

// 2.データ取得SQL作成 登録済みのものを持ってくるので攻撃気にしないで良い
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table;");
$status = $stmt->execute();

// 3.データ表示
$values = "";
if ($status === false) {
  sql_error($stmt);
}
// 全データ取得
$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($values, JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ブックマーク（DB呼び出し、HTML表示）</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }

    td {
      border: 1px solid brown;
    }
  </style>
</head>

<body id="main">
  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">登録データ一覧表示</a>
        </div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <div>
    <div class="container jumbotron">
      <!-- <a href="detail.php"></a> -->
      
      <div>
        <table>
          <?php foreach ($values as $value) { ?>
            <tr>
              <td><?= h($value["id"]) ?></td>
              <td><?= h($value["name"]) ?></td>
              <td><?= h($value["url"]) ?></td>
              <td><?= h($value["comment"]) ?></td>
              <td><?= $value["date"] ?></td>
              <td><a href="detail.php?id=<?= h($value['id']) ?>">更新</a></td>
              <td><a href="delete.php?id=<?= h($value['id']) ?>">削除</a></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <br>
  <h1>入力ページに戻る</h1>
  <div><a href="index.php">index.phpファイル</a>に戻ります</div>
  <!-- Main[End] -->
</body>

</html>