function numjudge(){
    
    var weight=document.getElementById("weight").value;
    
    if(isNaN(weight)||weight==""){
        document.getElementById("button").style.display="none";
        alert("半角の数値を入力してください");
    }else{
        document.getElementById("button").style.display="block";
    }
}

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