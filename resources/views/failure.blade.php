<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <div>
            <div class="headerlogo">
                筋トレ理論値計算アプリ
            </div>
        </div>
       
    </header>
    <div class="main">
        <div class="maincontent">
            <div class="login">
                <div class="errorms">
                    <p class="errorhead">ログイン失敗</p>
                    <p class="errorex">ユーザー名またはパスワードが</p>
                    <p class="errorex">正しいか確認してください</p>
                </div>
                <div class="redirect">
                    <a href="{{url('/')}}">ログイン画面へ</a>
                </div>
            </div>
            
        </div>

        
    </div>
    <footer>
    </footer>
</body>
</html>