var namesimilar=$('.namesimilar').text();
console.log(namesimilar);
if(namesimilar==1){
    alert("ユーザー名が既に使われています。違うユーザー名を入力してください。")
}

var passjg=0;
var passcfjg=0;
var namejg=0;
var total=passjg+passcfjg+namejg;

var passwordjudge=function(){
    
    var password=$('#password').val();
    var passwordcf=$('#passwordcf').val();
        //console.log(passwordcf);
        if(password==passwordcf){
            $('.regibtn').css('display','block');
        }else{
            $('.regibtn').css('display','none');
            alert("パスワードが一致していません。");
        }
        
   
}

$('.username').change(function(){

    var username=$('.username').val();
    //console.log(username);
    if(username==""||password==null){
        namejg=0;
        $('.regibtn').css('display','none');
    }else{
        namejg=1;
    }
    //console.log(namejg);
    total=passjg+passcfjg+namejg;
    if(total==3){
        passwordjudge();
    }
});

$('#password').change(function(){

    var password=$('#password').val();
    if(password==""||password==null){
        passjg=0;
        $('.regibtn').css('display','none');
    }else{
        passjg=1;
    }
    //console.log(passjg);
    total=passjg+passcfjg+namejg;
    if(total==3){
        passwordjudge();
    }
});

$('#passwordcf').change(function(){

    var passwordcf=$('#passwordcf').val();
    if(passwordcf==""||password==null){
        passcfdjg=0;
        $('.regibtn').css('display','none');
    }else{
        passcfjg=1;
    }
    //console.log(passcfjg);
    total=passjg+passcfjg+namejg;
    //console.log(total);
    if(total==3){
        passwordjudge();
    }
});
