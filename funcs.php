<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。

//localhost
// function db_conn() 
// {
//     try {
//         $db_name = 'db_gensen'; //データベース名
//         $db_id   = 'root'; //アカウント名
//         $db_pw   = ''; //パスワード：MAMPは'root'
//         $db_host = 'localhost'; //DBホスト
//         $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
//         return $pdo; //関数の外でPDO関数を使う場合にreturn $pdoとする
//     } catch (PDOException $e) {
//         exit('DB Connection Error:' . $e->getMessage());
//     }
// }

// //sakura
function db_conn() 
{
    try {
        $db_name = 'takanag_db_gensen'; //データベース名
        $db_id   = 'takanag_db_gensen'; //アカウント名
        $db_pw   = ''; //パスワード：MAMPは'root'
        $db_host = 'mysql3104.db.sakura.ne.jp'; //DBホスト
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo; //関数の外でPDO関数を使う場合にreturn $pdoとする
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)


//リダイレクト関数: redirect($file_name)
