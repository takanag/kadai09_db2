<?php
header("Content-Type: application/json");

// 保存先のCSVファイル
$csvFile = 'Comment.csv';

// GETパラメータからplace_idを取得
$placeId = $_GET['place_id'] ?? '';

// コメントリストを初期化
$comments = [];

// CSVファイルを読み込み
if (file_exists($csvFile)) {
    $csvHandle = fopen($csvFile, 'r');
    if ($csvHandle) {
        while (($data = fgetcsv($csvHandle)) !== false) {
            // CSVフォーマット: [place_id, rating, recommendation]
            if ($data[0] === $placeId) {
                $comments[] = [
                    'place_id' => $data[0],
                    'rating' => $data[1],
                    'recommendation' => $data[2],
                ];
            }
        }
        fclose($csvHandle);
    }
}

// JSON形式でコメントを返す
echo json_encode(['comments' => $comments]);
