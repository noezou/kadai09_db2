<?php

//1. データ取得＝URLで送られてくるのでGETを使う
$id     = $_GET['id'];

//2. DB接続します
require_once('funcs.php'); // 関数を定義しているファイルを呼び出す
$pdo = db_conn(); //

//3．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id=:id'); // idはURL（外から持ってきているので）一旦変数に入れる
$stmt->bindValue(':id', $id, PDO::PARAM_INT); // 数値の場合 PDO::PARAM_INT
$status = $stmt->execute(); //実行

//4．データ登録処理後
if ($status === false) {
  sql_error($stmt);
} else {
  redirect("select.php");
}

?>