$(document).ready(function () {


//регистрация на турнир
    $(".regTournament").click(function () {

        var id = $(this).data('tournamentidBar');
        var costtotournament = $(this).data('costtotournamentBar');
        var timetour = $(this).data('tournamenttimeBar');
        var raz = TimeNow(timetour);
        
        if (raz === 1) {
            //console.log("raz", raz);
            $.post('/tournament/regto',
                    {id: id, cost: costtotournament},
                    function (data) {
                        if (data.code === 1) {
                            alert("Вы успешно зарегестрировались на турнир");
                            location.reload();
                            
                            
                        }
                        if (data.code === -2) {
                            alert("У Вас недостаточно денег, пополните счет, пожалуйста");
                        }
                        if (data.code === -3) {
                            alert("ARROR");
                        }
                        if (data.code === -4) {
                            alert("Вы уже зарегестрированы на этот турнир");
                        }
                    }
            );
        } else if (raz === 0) {
            alert("Турнир завершен!!!!");
        } else {
            alert(raz);
        }
    });
    
    

// снятие заявки
$(".unregisterTournament").click(function () {

        var id = $(this).data('untournamentidBar');
        var costtotournament = $(this).data('costtotournamentBar');

            $.post('/tournament/unreg',
                    {id: id, cost: costtotournament},
                    function (data) {
                        if (data.code === 1) {
                            alert("Вы успешно сняли заявку на регистрацию на турнир");
                            location.reload();
                            
                        }
                        if (data.code === -1) {
                            alert("ERROR");
                        }
                    }
            );
       
    });







});
