<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録画面</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
    <div class="namesimilar">{{$namesimilar}}</div>
    <header>
        <div>
            <div class="headerlogo">
                筋トレ理論値計算アプリ
            </div>
        </div>
       
    </header>
    <div class="main">
    <div class="maincontent">
            <div class="register">
                <div class="memberlog">
                    <p class="form-header">新規ユーザー登録</p>
                    <div class="memberform">
                        <form method="post" action="{{url('/member/register')}}">
                        @csrf
                            <input type="text" title="username" placeholder="username"　id="username" class="username opa" name="username" autocomplete='off' />
                            <input type="password" title="username" placeholder="password" id="password" class="password opa" name="password" autocomplete='off' />
                            <p class="pass-con-ms">パスワード確認</p>
                            <input type="password" title="username" placeholder="password" id="passwordcf" class="password opa" name="password-confirm" autocomplete='off' />
                            <button type="button" class="submitbtn opa regibtn" onclick="submit();">登録</button> <!-- buttonのタイプにしてエンターを使えなくする。-->
                        </form>
                    </div>
                </div>
            </div>
            <div class="subcontent">
                <a href="{{url('/')}}">ログイン画面</a>
            </div> 
    </div>
    <footer>
    </footer>
<script src="js/register.js"></script>
</body>
</html>