<?php
    $referer = @$_SERVER['HTTP_REFERER'];

    if (empty($referer)) {
        // リダイレクトの場合
        header(("Location: ../index1/1"));
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

    .even-row tr {
        background-color: #f2f2f2; /* 偶数行の背景色を灰色に設定 */
    }

    td.detail_button a {
        display: block;
        text-align: center;
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
        background-color:black;
        color:white;
        weight:500px;
        margin: 0 auto;
        text-align:center;
    }
</style>

<div class="table-container">
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
                <td>国</td>
                <td>{{ $player->my_country_name }}</td>
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

            <tr>
                <td>総得点</td>
                <td>
                    @if($goals->count()>0)
                    {{ $goals->count()}}点
                    @else
                    無得点です。
                    @endif
                </td>
            </tr>

            <tr>
                <td>得点履歴</td>
                <td>
                    @if($goals->count()>0)
                    @foreach($goals->sortBy('kickoff') as $goal)
                    {{ $goal->kickoff }}開始{{ $goal->enemy_country }}戦{{ $goal->goal_time }}
                    @if(!$loop->last)
                    <br>
                    @endif
                    @endforeach
                    @else
                    {{--無--}}
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="back_button" ><a href="{{ url('/back-to-index') }}" class="btn btn-primary">戻る</a></div>

</body>
</html>