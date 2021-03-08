function numjudge(){
    var target=$('#targetweight').val();
    if(isNaN(target)||target==""){
        alert("半角の数値を入力してください");
        $('#set').css('display','none');
    }else{
        $('#set').css('display','block');
    }
}


var judge1=0;
var judge2=0;
function numjudge1(){
    
    var weight=$('#weight').val();
    //console.log(weight);
    if(isNaN(weight)||weight==""){
        alert("半角の数値を入力してください");
    }
    else {
        judge1=1;
    }

    if(judge1==1&&judge2==1){
        $('#button').css('display','block');
    }else{
        $('#button').css('display','none');
    }
}

function numjudge2(){
    
    var length=$('#length').val();
    //console.log(length);
    if(isNaN(length)||length==""){
        alert("半角の数値を入力してください");
    }
    else {
        judge2=1;
    }

    if(judge1==1&&judge2==1){
        $('#button').css('display','block');
    }else{
        $('#button').css('display','none');
    }
}

$('#targetweight').change(function(){
    numjudge();
});

$('#weight').change(function(){
    judge1=0;
    numjudge1();
});

$('#length').change(function(){
    judge2=0;
    numjudge2();
});


//メニュータグ表示
var clickjudge1=0;
$('.menu-trigger').click(function(){
    clickjudge1+=1;
    if(clickjudge1%2!==0){
        $('.menu').css('display','flex');
        $('.menu-trigger').text('close');
    }else{
        $('.menu').css('display','none');
        $('.menu-trigger').text('menu');
    }
    //console.log(clickjudge);

});

var clickjudge2=0;
$('.record-trigger').click(function(){
    clickjudge2+=1;
    if(clickjudge2%2!==0){
        $('.record-menu').css('display','flex');
        $('.record-trigger').text('close');
    }else{
        $('.record-menu').css('display','none');
        $('.record-trigger').text('record');
    }
    //console.log(clickjudge);

});