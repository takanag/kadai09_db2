<?php
// DB接続情報
try {
    require_once('funcs.php');
    $pdo = db_conn();

    // POSTデータを取得
    $place_id = $_POST['place_id'] ?? null;
    $name = $_POST['name'] ?? null;
    $review_summary = $_POST['review_summary'] ?? null;
    $facility_type = $_POST['facility_type'] ?? null;
    $address = $_POST['address'] ?? null;
    $tel = $_POST['tel'] ?? null;
    $business_hours = $_POST['business_hours'] ?? null;
    $regular_holiday = $_POST['regular_holiday'] ?? null;
    $spring_quality = $_POST['spring_quality'] ?? null;
    $effect = $_POST['effect'] ?? null;
    $amenities = $_POST['amenities'] ?? null;
    $facilities = $_POST['facilities'] ?? null;
    $access = $_POST['access'] ?? null;
    $other_info = $_POST['other_info'] ?? null;

    // 必須項目のチェック
    if (!$place_id || !$name) {
        throw new Exception("場所IDまたは名前が不足しています。");
    }

    // SQLクエリの作成
    $sql = "INSERT INTO gensen_master (
        place_id, name, review_summary, facility_type, address, tel, 
        business_hours, regular_holiday, spring_quality, effect, 
        amenities, facilities, access, other_info
    ) VALUES (
        :place_id, :name, :review_summary, :facility_type, :address, :tel, 
        :business_hours, :regular_holiday, :spring_quality, :effect, 
        :amenities, :facilities, :access, :other_info
    )";

    // SQLステートメントを準備
    $stmt = $pdo->prepare($sql);

    // パラメータをバインド
    $stmt->bindParam(':place_id', $place_id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':review_summary', $review_summary);
    $stmt->bindParam(':facility_type', $facility_type);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':business_hours', $business_hours);
    $stmt->bindParam(':regular_holiday', $regular_holiday);
    $stmt->bindParam(':spring_quality', $spring_quality);
    $stmt->bindParam(':effect', $effect);
    $stmt->bindParam(':amenities', $amenities);
    $stmt->bindParam(':facilities', $facilities);
    $stmt->bindParam(':access', $access);
    $stmt->bindParam(':other_info', $other_info);

    // クエリを実行
    $stmt->execute();

    // 成功メッセージを返す
    echo json_encode(['status' => 'success', 'message' => '温泉情報が保存されました。']);

} catch (Exception $e) {
    // エラーメッセージを返す
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
