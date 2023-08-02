setInterval(function(){   
    var date = new Date();   
    var year = date.getFullYear();    //获取当前年份   
    var mon = date.getMonth()+1;      //获取当前月份   
    var da = date.getDate();          //获取当前日   
    var day = date.getDay();          //获取当前星期几   
    var h = date.getHours();          //获取小时   
    var m = date.getMinutes();        //获取分钟   
    var s = date.getSeconds();        //获取秒   
    var d = document.getElementById('Date'); 
    switch(day){
        case 0:
            day='日';
            break;
        case 1:
            day='一';
            break;
        case 2:
            day='二';
            break;
        case 3:
            day='三';
            break;
        case 4:
            day='四';
            break;
        case 5:
            day='五';
            break;
        case 6:
            day='六';
            break;
    }   
      d.innerHTML=year+'年'+mon+'月'+da+'日&nbsp&nbsp&nbsp'+'星期'+day+"&nbsp&nbsp&nbsp时间："+h+':'+m+':'+s;  
    },1000)