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
    .login-area {
        width:500px;
        height:700px;
        margin:auto;
        padding:20px;
    }
    p input{
        height:20px;
    }
    .role {
        display: flex;
    }
    .role p {
        display: flex;
        margin-right:15px;
    }
    .add_button{
        margin-top:30px;
        width:480px;
        background-color:yellow;
        text-align:center;
    }
    .back_button{
        width:480px;
        background-color:black;
        color:white;
        text-align:center;
    }
    .subtitle{
        font-weight:bold;
    }
    .error-message{
        color:red;
    }
    .countrySelect_same {
    position: absolute;
    width: 480px;
    z-index: 2;
    }
    
    .none_same {
    position: absolute;
    width: 480px;
    z-index: 1;
    }

    
</style>
    <div class="login-area">
        <div><h2>新規登録画面</h2></div>
        <form method="get" action="{{ route('user.register') }}">
        
        <p class="subtitle">ログインID:</p> 
        @error('email')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <p><input type="text" style="width:470px;" name="email" value="" placeholder="メールアドレス"></p>
        
        <p class="subtitle">パスワード:</p>
        @error('password')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <p><input type="text" style="width:470px;" name="password" value="" placeholder="パスワード"></p>
        
        <p class="subtitle">パスワード確認:</p>
        @error('password2')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <p><input type="text" style="width:470px;" name="password2" value="" placeholder="パスワード"></p>
        
        <p class="subtitle" style="margin-bottom:0px;">ユーザー種別選択:</p>
        @error('select')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <div class="role" name="role">
            <p><input type="radio" name="role" value="1" onclick="enableSelect()" checked>一般ユーザー</p>
            <p><input type="radio" name="role" value="0" onclick="disableSelect()">管理ユーザー</p>
        </div>

        <p class="subtitle">所属国選択:</p>
        @error('country_id')
            <p class="error-message">{{ $message }}</p>
        @enderror
        <select id="countrySelect" class="none_same" style="width:480px;" name="country_id">
            @foreach($countries as $country)
                <option type="hidden" value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
            <option id="zero" style="display:none;" value="0"></option>
        </select>
        <div id="none" class="countrySelect_same" style="width:480px; display:none;" name="country_id" value="0"></div>
        
        
        <p><button type="submit" class="add_button" onclick="return confirm('この情報でユーザー登録をしますか？')">登録</button></p>
        <p class="back_button"><a href="{{ url('/back-to-login') }}">ログイン画面に戻る</a></p>
        </form>
        
    </div>


    <script>
        function enableSelect() {
            // document.getElementById('countrySelect').disabled = false;
            document.getElementById('none').style.display = 'none';
            document.getElementById('countrySelect').value = '1';
            document.getElementById('zero').style.display -'none';
        }

        function disableSelect() {
            // document.getElementById('countrySelect').disabled = true;
            document.getElementById('none').style.display = 'block';
            document.getElementById('countrySelect').value = '0';
            document.getElementById('zero').style.display -'block';

        }
    </script>


</body>
</html>