<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
class LoginController extends Controller
{
    public function guestlogin(){
        return redirect('/MAXcalculate/guest');
    }

    public function register(Request $request){
        $username=$request->username;
        $password=$request->password;

        //ハッシュ化
        $password = password_hash($password, PASSWORD_BCRYPT);
        //dd($password);

        //すでに同じユーザー名がないか確認
        $user = User::where('username', $username)->first();
        //dd($user);
        if($user){
            $send=[
                'namesimilar'=>1
            ];
            return redirect("/register")->withInput($send);
        }


        $user= new User;
        $user->username=$username;
        $user->password=$password;
        $user->save();

        $user = User::where('username', $username)->first();

        $sendinfo=[
            'username'=>$user->username
        ];
        return redirect("/MAXcalculate/member")->withInput($sendinfo);

    }

    public function registerpage(Request $request){
        
        //dd($request->old('similar'));
        $namesimilar=$request->old('namesimilar');
        //dd($namesimilar);
        return view('register',['namesimilar' => $namesimilar]);
    }


    public function memberlogin(Request $request){
        $username=$request->username;
        $password=$request->password;
        //dd($password);
        //dd($username);

        $user = User::where('username', $username)->first();
        //dd($user);
        
        if(!$user){
            return redirect("/failure");
        }else{

            if(!password_verify($password, $user->password)){
                return redirect("/failure");
            }

            $sendinfo=[
                'username'=>$user->username
            ];
            return redirect("/MAXcalculate/member")->withInput($sendinfo);
        }
        
    }




    
     // twitterログイン
     public function redirectToProvider(){
        return Socialite::driver('twitter')->redirect();
        
        
    }

    // コールバック
    public function handleProviderCallback(){
        try {
            $twitterUser = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return redirect('auth/twitter');
        }
        

        

        $user = User::where('userid', $twitterUser->id)->first();
        //dd($user);
        if(!$user){
            $user_info = new User;
            $user_info->name=$twitterUser->name;
            $user_info->userid=$twitterUser->id;
            $user_info->nickname=$twitterUser->nickname;
            $user_info->imgurl=$twitterUser->user['profile_image_url_https'];
            $user_info->token=$twitterUser->token;
            $user_info->tokenSecret=$twitterUser->tokenSecret;
            $user_info->save();

            $user = User::where('userid', $twitterUser->id)->first();
        }else{
            $user->name=$twitterUser->name;
            $user->userid=$twitterUser->id;
            $user->nickname=$twitterUser->nickname;
            $user->imgurl=$twitterUser->user['profile_image_url_https'];
            $user->token=$twitterUser->token;
            $user->tokenSecret=$twitterUser->tokenSecret;
            $user->save();

            $user = User::where('userid', $twitterUser->id)->first();
        }

        $sendinfo=[
            'userid'=>$user->userid
        ];
        //return redirect("/tweet");
        return redirect("/MAXcalculate/member")->withInput($sendinfo);
                        
    }

    // ログアウト
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/");
    }
}
