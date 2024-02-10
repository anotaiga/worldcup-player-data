<?php
    $referer = @$_SERVER['HTTP_REFERER'];

    if (empty($referer)) {
        // リダイレクトの場合
        header(("Location: ../login"));
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
    <!-- <style>
        table {
            table-layout: fixed;
            width: 100%;
            height:60px;
            /* white-space:nowrap; */
            /* background: #eee; */
            text-align:center;
        }
    </style> -->
    <style>
    table {
        border-collapse: collapse;
        table-layout: fixed;
            width: 100%;
            height:60px;
            /* white-space:nowrap; */
            /* background: #eee; */
            text-align:center;
    }

    th, td {
        border: 2px solid white;
        text-align: center;
        padding: 8px;
    }


    th {
        background-color: #f2f2f2;
    }

    .odd-row td {
        background-color: #f2f2f2; /* 奇数行の背景色を白に設定 */
    }

    .even-row td {
        background-color: #fff; /* 偶数行の背景色を灰色に設定 */
    }

    td.detail_button a {
        display: block;
        text-align: center;
    }
    .table-container{
        border: 2px solid black;
    }
    ul{
        display: flex;
        justify-content: center;
    }
    li{
        list-style:none;
    }
</style>

<div class="table-container">

    <table>
        <tr>
            <th>No</th>
            <th>背番号</th>
            <th width="10%">ポジション</th>
            <th width="30%">所属</th>
            <th width="15%">名前</th>
            <th width="15%">国</th>
            <th width="15%">誕生日</th>
            <th>身長</th>
            <th>体重</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>
    @foreach ($players as $index => $player) 
    <table class="{{ ($index % 2 == 0) ? 'even-row' : 'odd-row' }}">
        <tr>
            <td>{{ $player -> id}}</td>
            <td>{{ $player -> uniform_num}}</td>
            <td width="10%">{{ $player -> position}}</td>
            <td width="30%">{{ $player -> club}}</td>
            <td width="15%">{{ $player -> name}}</td>
            <td width="10%">{{ $player -> country_name}}</td>
            <td width="15%">{{ $player -> birth}}</td>
            <td>{{ $player -> height}}</td>
            <td>{{ $player -> weight}}</td>
            <td class="detail_button"><a href="{{  route('player.detail',['player_id'=>$player->id]) }}">詳細</a></td>

        
        </tr>
    @endforeach
    </table>
</div>
    {{ $players ->links() }}
</body>
</html>
