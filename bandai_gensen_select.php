<?php

// 1. DB接続
require_once('funcs.php');
$pdo = db_conn();

//2. データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gensen_master');
$status = $stmt->execute();

//3. 表形式のデータ作成
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery: ' . $error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="bandai_gensen_detail.php?place_id=' . $result['place_id'] . '">';
        $view .= $result['place_id'] . ' : ' . $result['name'] . ' : ' . $result['address'] . ' : ' . $result['time'];
        $view .= '</a>';
        $view .= '<a href="bandai_gensen_delete.php?place_id=' . $result['place_id'] . '">';
        $view .= '<button style="color:red; border: 2px solid red;">削除</button>';
        $view .= '</a>';
        $view .= '</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録源泉一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }

        .bandai-menu a {
            text-decoration: none;
            background-color: #6c6c6c;
            color: white;
            margin: 5px;
            padding: 5px 5px;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        /* レスポンシブ対応 */
        @media (max-width: 600px) {
            header h1 {
                font-size: 1.5rem;
            }

            main p {
                font-size: 0.9rem;
            }

            .menu a {
                font-size: 0.9rem;
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="bandai-menu">
                    <a href="bandai.html">番台メニューに戻る</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron">
            <a href="bandai_gensen_detail.php"></a>
            <?= $view ?>
        </div>
    </div>
    <!-- Main[End] -->

</body>

</html>