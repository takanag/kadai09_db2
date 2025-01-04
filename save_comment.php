<?php
header("Content-Type: application/json");

// 保存先のCSVファイル名
$csvFile = 'Comment.csv';

// POSTデータの取得
$placeId = $_POST['place_id'] ?? '';
$rating = $_POST['rating'] ?? '';
$recommendation = $_POST['recommendation'] ?? '';

// 必要なデータが全て揃っているか確認
if (!$placeId || !$rating || !$recommendation) {
    echo json_encode(['status' => 'error', 'message' => '必要なデータが不足しています。']);
    exit;
}

// コメントデータをCSVに保存
$commentData = [
    $placeId,
    $rating,
    $recommendation,
];

$csvHandle = fopen($csvFile, 'a'); // 追記モードでファイルを開く
if ($csvHandle) {
    fputcsv($csvHandle, $commentData); // データを書き込み
    fclose($csvHandle);

    echo json_encode(['status' => 'success', 'message' => 'コメントが保存されました。']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'コメントの保存に失敗しました。']);
}
?>