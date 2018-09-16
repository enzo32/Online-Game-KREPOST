function attackPlayer(hod, nomer) {
    var level = 1;
    if (hod === 0) {
        var defence2 = Number($('#defancePlayer2').val());
        var countPlayer1 = countWarriors(hod);
        var atackplayer = countAttack(hod);
        //console.log("atackplayer", atackplayer);
        var udar = ((level + nomer) * (atackplayer / defence2)) * countPlayer1;
        //console.log("udar", udar);
        var life = Number($("#lifePlayer2").val());
        $("#lifePlayer2").val(life - Math.round(udar));
        var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
        if (isNull === true) {
            gameEnd();
        }
    } else {
        var atackplayer2 = countAttack(hod);
        var countPlayer2 = countWarriors(hod);
        var defence = Number($('.defancePlayer1').val());
        var udar1 = (2 * level + nomer) * (atackplayer2 / defence) * countPlayer2;
        var life = Number($(".lifePlayer1").val());
        $(".lifePlayer1").val(life - Math.round(udar1));
        var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
        if (isNull === true) {
            gameEnd();
        }
    }

}
function countWarriors(hod) {
    var count;
    if (hod === 0) {
        $('#player1 .tab-content .active .countPlayer1').each(function (index, value) {
            count = $(value).val();
        });

    } else {
        $('#player2 .tab-content .active .countPlayer2').each(function (index, value) {
            count = $(value).val();
        });
    }
    //console.log("count", count);
    return count;
}

function countAttack(hod) {
    var attack;
    if (hod === 0) {
        $('#player1 .tab-content .active .attackPlayer1').each(function (index, value) {
            attack = $(value).val();
        });
    } else {
        $('#player2 .tab-content .active .attackPlayer2').each(function (index, value) {
            attack = $(value).val();
        });

    }
    //console.log("attack", attack);
    return attack;
}

function deffancePlayer(hod, nomer) {
    var level = 1;
    var atackplayer = 10;
    var defence = 100;
    if (hod === 0) {
        var defanceP = Number($('.defancePlayer1').val());
        $('.defancePlayer1').val(defanceP + nomer);
    } else {
        var defanceP = Number($('#defancePlayer2').val());
        $('#defancePlayer2').val(defanceP + nomer);
    }
}

function lifeIsNull(life) {
    if (life <= 0) {
        return true;
    } else {
        return false;
    }
}

function gameEnd() {
    var player1 = $(".lifePlayer1").val();
    var player2 = $("#lifePlayer2").val();
    if (player1 <= 0 && player2 > 0) {
        $(".playerwar").block({message: "Выиграл Player 2"});
    } else {
        $(".playerwar").block({message: "Выиграл Player 1"});
    }

    var det = $('#countdown');
    det.detach();
}


function redManna(hod) {
    var stil = 10; // коэфициет манны какой-то 
    var level = 1;
    var defence = 5;

    if (hod === 0) {
        var t = $("#redmanna");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($("#lifePlayer2").val());

            var udar = (level + nomer) * (stil / defence);

            $("#lifePlayer2").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }

        } else {
            alert("Не хватает манны");
        }

    } else {
        var t = $("#redmannaAI");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($(".lifePlayer1").val());

            var udar = (level + nomer) * (stil / defence);

            $(".lifePlayer1").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }
        } else {
            alert("Не хватает манны");
        }
    }
}


function greenManna(hod) {
    var stil = 10; // коэфициет манны какой-то 
    var level = 1;
    var defence = 5;

    if (hod === 0) {
        var t = $("#greenmanna");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($("#lifePlayer2").val());

            var udar = (level + nomer) * (stil / defence);

            $("#lifePlayer2").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }

        } else {
            alert("Не хватает манны");
        }

    } else {
        var t = $("#greenmannaAI");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($(".lifePlayer1").val());

            var udar = (level + nomer) * (stil / defence);

            $(".lifePlayer1").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }
        } else {
            alert("Не хватает манны");
        }
    }
}

function blumannaManna(hod) {
    var stil = 10; // коэфициет манны какой-то 
    var level = 1;
    var defence = 5;

    if (hod === 0) {
        var t = $("#blumanna");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($("#lifePlayer2").val());

            var udar = (level + nomer) * (stil / defence);

            $("#lifePlayer2").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }

        } else {
            alert("Не хватает манны");
        }

    } else {
        var t = $("#blumannaAI");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($(".lifePlayer1").val());

            var udar = (level + nomer) * (stil / defence);

            $(".lifePlayer1").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }
        } else {
            alert("Не хватает манны");
        }
    }
}


function whitemannaManna(hod) {
    var stil = 10; // коэфициет манны какой-то 
    var level = 1;
    var defence = 5;

    if (hod === 0) {
        var t = $("#whitemanna");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($("#lifePlayer2").val());

            var udar = (level + nomer) * (stil / defence);

            $("#lifePlayer2").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }

        } else {
            alert("Не хватает манны");
        }

    } else {
        var t = $("#whitemannaAI");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($(".lifePlayer1").val());

            var udar = (level + nomer) * (stil / defence);

            $(".lifePlayer1").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }
        } else {
            alert("Не хватает манны");
        }
    }
}


function astralmannaManna(hod) {
    var stil = 10; // коэфициет манны какой-то 
    var level = 1;
    var defence = 5;

    if (hod === 0) {
        var t = $("#astralmanna");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($("#lifePlayer2").val());

            var udar = (level + nomer) * (stil / defence);

            $("#lifePlayer2").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }

        } else {
            alert("Не хватает манны");
        }

    } else {
        var t = $("#astralmannaAI");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($(".lifePlayer1").val());

            var udar = (level + nomer) * (stil / defence);

            $(".lifePlayer1").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }
        } else {
            alert("Не хватает манны");
        }
    }
}

function deathmannaManna(hod) {
    var stil = 10; // коэфициет манны какой-то 
    var level = 1;
    var defence = 5;

    if (hod === 0) {
        var t = $("#deathmanna");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($("#lifePlayer2").val());

            var udar = (level + nomer) * (stil / defence);

            $("#lifePlayer2").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($("#lifePlayer2").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }

        } else {
            alert("Не хватает манны");
        }

    } else {
        var t = $("#deathmannaAI");
        var nomer = Number($(t).val());
        if (nomer > 0) {
            var life = Number($(".lifePlayer1").val());

            var udar = (level + nomer) * (stil / defence);

            $(".lifePlayer1").val(life - Math.round(udar));
            var isNull = lifeIsNull(Number($(".lifePlayer1").val()));
            $(t).val(0);
            if (isNull === true) {
                gameEnd();
            }
        } else {
            alert("Не хватает манны");
        }
    }
}

