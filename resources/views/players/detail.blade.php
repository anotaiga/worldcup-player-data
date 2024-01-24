<?php
$referer = @$_SERVER['HTTP_REFERER'];

if (empty($referer)) {
    // リダイレクトの場合
    header(("Location: ../index"));
}
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        table{
            width: 100%;
            height: 60px;
            table-layout: fixed;
            text-align: center;
            border-collapse: collapse;
        }
        
        td {
            border: 2px solid white;
            text-align: center;
            padding: 8px;
        }
        tr:nth-child(odd) td {
        background-color: #f2f2f2; /* 奇数行の背景色を白に設定 */
        }

        tr:nth-child(even) td {
        background-color: #fff; /* 偶数行の背景色を灰色に設定 */
        }

    </style>
    <div class="A" style="display:flex">
        <table border="3" >
            <tr>
                <td>No</td>
                <td>{{ $player->id }}</td>
            </tr>
            
            <tr>
                <td>背番号</td>
                <td>{{ $player ? $player->uniform_num : 'N/A' }}</td>
            </tr>
            
            <tr>
                <td>ポジション</td>
                <td>{{ $player ? $player->position : 'N/A' }}</td>
            </tr>
            
            <tr>
                <td>名前</td>
                <td>{{ $player ? $player->name : 'N/A' }}</td>
            </tr>
            
            <tr>
                <td>所属</td>
                <td>{{ $player ? $player->club : 'N/A' }}</td>
            </tr>
            
            <tr>
                <td>誕生日</td>
                <td>{{ $player ? $player->birth : 'N/A' }}</td>
            </tr>
            
            <tr>
                <td>身長</td>
                <td>{{ $player ? $player->height : 'N/A' }}</td>
            </tr>
            
            <tr>
                <td>体重</td>
                <td>{{ $player ? $player->weight : 'N/A' }}</td>
            </tr>
        </table>
    </div>
    <div class="back_button"><a href="{{ route('reindex') }}">戻る</a></div>
</body>
</html>


