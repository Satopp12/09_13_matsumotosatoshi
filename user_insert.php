<?php
include('functions.php');

// 入力チェック
if (
    !isset($_POST['lid']) || $_POST['lid'] == '' ||
    !isset($_POST['lpw']) || $_POST['lpw'] == ''
) {
    exit('ParamError');
}

//POSTデータ取得
$username = $_POST['username'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg = $_POST['life_flg'];

//DB接続
$pdo = connectToDb();

//データ登録SQL作成
$sql = 'INSERT INTO user_table (id, username, lid, lpw, kanri_flg, life_flg) VALUES(NULL, :a1, :a2, :a3, :a4, :a5)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $username, PDO::PARAM_STR);
$stmt->bindValue(':a2', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a3', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':a4', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':a5', $life_flg, PDO::PARAM_INT);
$status = $stmt->execute();

//データ登録処理後
if ($status == false) {
    showSqlErrorMsg($stmt);
} else {
    //index.phpへリダイレクト
    header('Location: user_index.php');
}
