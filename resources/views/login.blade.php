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
                <div class="memberlog">
                    <p class="form-header">ユーザーログイン</p>
                    <div class="memberform">
                        <form method="post" action="{{url('/member/login')}}">
                        @csrf
                            <input type="text" title="username" placeholder="username" class="username opa" name="username" autocomplete='off' />
                            <input type="password" title="username" placeholder="password" class="password opa" name="password" autocomplete='off' />
                            <button type="submit" class="submitbtn opa">Login</button>
                        </form>
                    </div>
                </div>
                <div class="guestlog">
                    <div class="button">
                        <form method="get" action="guest/login">
                            <button class='guestbutton btn opa' id="guestbutton" type="submit" >ゲストとしてログイン</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="subcontent">
                <a href="{{url('/register')}}">新規ユーザー登録</a>
            </div> 
        </div>

        
    </div>
    <footer>
    </footer>
</body>
</html>