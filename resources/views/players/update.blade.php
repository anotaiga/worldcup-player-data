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
<style>
    table {
        border-collapse: collapse;
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
    }

    tbody tr:nth-child(even) td {
        background-color: white;
    }
    
    tbody tr:nth-child(even) th {
        background-color: white;
    }
    .even-row tr {
        background-color: #f2f2f2; /* 偶数行の背景色を灰色に設定 */
    }


    .table-container{
        border: 2px solid black;
        background-color: #f2f2f2;

    }
    ul{
        display: flex;
        justify-content: center;
    }
    li{
        list-style:none;
    }
    .back_button{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .center {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .edit{
        background-color:yellow;
        color:black;
        width:700px;
        margin: 0 auto;
        text-align:center;
    }
    a.btn{
        background-color:black;
        color:white;
        width:700px;
        margin: 0 auto;
        text-align:center;
    }
</style>

<div class="table-container">
    <form method="GET" action="{{ route('player.edit', ['player_id' => $player->id]) }}">
        <table border="3" >
            
        <tr>
                <th>No</th>
                <td name="id">{{ $player->id }}</td>
            </tr>
            
            <tr>
                <th>背番号</th>
                <td><input type="text" style="width:300px;" name="uni_num" value="{{ $player->uniform_num }}"></td>
            </tr>
            
            <tr>
                <th>ポジション</th>
                <td>
                    <select style="width:300px;"  name="position" >
                        <option selected>{{ $player->position }}</option>
                        <option>GK</option>
                        <option>DF</option>
                        <option>MF</option>
                        <option>FW</option>
                    </select>
                </td>
            </tr>
            
            <tr>
                <th>名前</th>
                <td><input type="text" style="width:300px;" name="name" value="{{ $player->name }}"></td>
            </tr>
            
            <tr>
                <th>国</th>
                <td>
                    <select style="width:300px;" name="my_country_name">
                        <option selected>{{ $player->my_country_name }}</option>
                        @foreach($countries as $index => $country)
                            @if($index % 23 == 0)
                            <option>{{ $country->my_country_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>

                
            </tr>
            <tr>
                <th>所属</th>
                <td><input type="text" style="width:300px;" name="club" value="{{ $player->club }}"></td>
            </tr>

            <tr>
                <th>誕生日</th>
                <td><input type="date" name="birth" style="width:300px;" value="{{ $player->birth }}" min="1900-01-01" max="2014-7-13"></td>
            </tr>
            
            <tr>
                <th>身長</th>
                <td><input type="text" style="width:300px;" name="height" value="{{ $player->height }}"></td>
            </tr>
            
            <tr>
                <th>体重</th>
                <td><input type="text" style="width:300px;" name="weight" value="{{ $player->weight }}"></td>
            </tr>


        </table>
    </div>
    <div class="center"><button type="submit" class="edit">編集</button></div>
    <div class="back_button" ><a href="{{ url('/back-to-index') }}" class="btn btn-primary">戻る</a></div>
    


</body>
</html>