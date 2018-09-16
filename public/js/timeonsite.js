function startTime()
{
    var tm = new Date();
    var y = tm.getFullYear();
    var mon = tm.getMonth() + 1;
    var d = tm.getDate();
    var h = tm.getHours();
    var m = tm.getMinutes();
    var s = tm.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    mon = checkTime(mon);
    document.getElementById('txt').innerHTML = d + "-" + mon + "-" + y + "/" + h + ":" + m + ":" + s;
    t = setTimeout('startTime()', 500);
    

    
}



function TimeNow(time) {
    var dayT;
    var hoursT;
    var minutesT;
    var timetourn = new Date(time);
    var timeNow = new Date();

    hoursT = timetourn.getHours() * 60;
    minutesT = timetourn.getMinutes();
    dayT = timetourn.getDate();
    var countT = hoursT + minutesT;
    var hoursN = timeNow.getHours() * 60;
    var minutesN = timeNow.getMinutes();
    var dayN = timeNow.getDate();
    var countN = hoursN + minutesN;
    var metka = 'Невозможно зарегестрироваться';

    if (dayT === dayN) {
        if ((countT - countN) <= 20 && (countT - countN) >= 5) {
            return 1;
        } else {
            return metka;
        }
    } else if (dayT > dayN) {

        return metka;
    } else {
        return 0;
    }

}

function checkTime(i)
{
    if (i < 10)
    {
        i = "0" + i;
    }
    return i;
}

