<?php
// dd($errors);
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
    .error-message{
        color:red;
    }
    .login-area {
        width:500px;
        height:700px;
        margin:auto;
        padding:20px;
    }
    .subtitle{
        font-weight:bold;
    }
    p input{
        height:20px;
    }
    .login_button{
        width:480px;
        background-color:yellow;
        text-align:center;
        border:none;
    }
    .create_button{
        text-align:center;
        width:480px;
    }
</style>
    <div class="login-area">
    
        <form class="sign-in" method="get" action="{{ route('user.signin') }}">
            <div><h2>ログイン</h2></div>
            
            <p class="subtitle">ログインID:</p> 
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <p><input type="text" style="width:470px;" name="email" value="" placeholder="メールアドレス"></p>
            
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
            <p class="subtitle">パスワード:</p>
            <p><input type="password" style="width:470px;" name="password" value="" placeholder="パスワード"></p>
            
            <button type="submit" class="login_button">ログイン</button>
            <p class="create_button"><a href="{{ url('/back-to-create') }}">新規登録はこちら</a></p>
        </form>
    </div>

    @if($errors->any())
    <script>
        alert("{{ implode('\n', $errors->all()) }}");
    </script>
@endif

</body>

</html>