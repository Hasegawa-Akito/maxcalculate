   var Y=$('#hidden_year').val();
   var m=$('#hidden_month').val();
   var type=$('#hidden_type').val();
   var type_name=$('#hidden_type_name').val();


   //ドロップボックスの初期値を設定
   $("#type_select").val(type);
   $("#year_select").val(Y);
   $("#month_select").val(m);


    //グラフ作成
	//ラベル
    var date;
    var labels=[];
    var weight_log=[];
    for(date=1;date<=31;date++){
        var jsid='#'+date;
        var weight=$(jsid).text();
        if(!weight){
            weight=null;
        }
        //console.log(weight);
        weight_log.push(weight);
        labels.push(date);
    }

    //console.log(weight_log);
	//console.log(labels);

   var ctx = document.getElementById("myChart");
   var myChart = new Chart(ctx, {
		type: 'line',
		data : {
			labels: labels,
			datasets: [
				{
					label: '記録変動',
                    spanGaps: true,
					data: weight_log,
					borderColor: "#00bfff",
         			backgroundColor: "rgba(0,0,0,0)"
				}
			]
		},
		options: {
			title: {
				display: true,
				text: type_name+" "+Y+"年"+m+"月"
			},
            maintainAspectRatio: false

		}
   });
   

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

$('#radio-on').click(function(){
    $('.record-menu').css('display','none');
    $('.chart').css('display','block');
});
$('#radio-off').click(function(){
    $('.record-menu').css('display','block');
    $('.chart').css('display','none');
});

//グラフ作成
	//ラベル
    var date;
    var labels=[];
    var weight_log=[];
    for(date=1;date<=31;date++){
        var jsid='.'+date;
        var weight=$(jsid).text();
        if(!weight){
            weight=null;
        }
        //console.log(weight);
        weight_log.push(weight);
        labels.push(date);
    }

    //console.log(weight_log);
	//console.log(labels);

    

    