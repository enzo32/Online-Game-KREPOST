$(document).ready(function () { // Ждём загрузки страницы
    var countarmour;
    var result;
    //покупка вещей
    $(".thingsNumber").change(function () {
        countarmour = $(this).val();
        var sale = $(this).parent().prev().text();
        result = $(this).parent().next().children().val(countarmour * sale);
        // console.log('result', result.val());
    });

    //покупка воинов
    $(".warriorsNumber").change(function () {
        countarmour = $(this).val();
        var sale = $(this).parent().prev().text();
        result = $(this).parent().next().children().val(countarmour * sale);
        // console.log('result', result.val());
    });

    //покупка осадного оружия
    $(".SiegeWeaponsNumber").change(function () {
        countarmour = $(this).val();
        var sale = $(this).parent().prev().text();
        result = $(this).parent().next().children().val(countarmour * sale);
        // console.log('result', result.val());
    });

    //покупка свитков магии
    $(".ScrollsOfMagicNumber").change(function () {
        countarmour = $(this).val();
        var sale = $(this).parent().prev().text();
        result = $(this).parent().next().children().val(countarmour * sale);
        // console.log('result', result.val());
    });


    //покупка вещей
    $(".buyThings").click(function () {
        var id = $(this).data('thingsBar');
        if (countarmour === 0) {
            alert("Введите количество для покупки больше 0");
        } else {
            $.post('/game/buyarmor',
                    {id: id, data: countarmour, totalprice: result.val()},
                    function (data) {
                        if (data.code === 1) {
                            alert("Вы успешно преобрели вещи");
                            location.reload();
                        }
                        if (data.code === -2) {
                            alert("У Вас недостаточно денег, пополните счет, пожалуйста");
                        }
                        if (data.code === -3) {
                            alert("ARROR");
                        }
                    }
            );
        }


    });


    //покупка воинов
    $(".byuWarriors").click(function () {
        var id = $(this).data('warriorsBar');
        if (countarmour === 0) {
            alert("Введите количество для покупки больше 0");
        } else {
            $.post('/game/buywarriors',
                    {id: id, data: countarmour, totalprice: result.val()},
                    function (data) {
                        if (data.code === 1) {
                            alert("Вы успешно преобрели вещи");
                            location.reload();
                        }
                        if (data.code === -2) {
                            alert("У Вас недостаточно денег, пополните счет, пожалуйста");
                        }
                        if (data.code === -3) {
                            alert("ARROR");
                        }
                    }
            );
        }


    });

    //покупка осадного оружия
    $(".buySiegeWeapons").click(function () {
        var id = $(this).data('siegeweaponsBar');
        if (countarmour === 0) {
            alert("Введите количество для покупки больше 0");
        } else {
            $.post('/game/buysiegeweapons',
                    {id: id, data: countarmour, totalprice: result.val()},
                    function (data) {
                        if (data.code === 1) {
                            alert("Вы успешно преобрели вещи");
                            location.reload();
                        }
                        if (data.code === -2) {
                            alert("У Вас недостаточно денег, пополните счет, пожалуйста");
                        }
                        if (data.code === -3) {
                            alert("ARROR");
                        }
                    }
            );
        }


    });


    //покупка свитков магии
$(".buyScrollsOfMagic").click(function () {
        var id = $(this).data('scrollsofmagicBar');
        if (countarmour === 0) {
            alert("Введите количество для покупки больше 0");
        } else {
            $.post('/game/buyscrollsofmagic',
                    {id: id, data: countarmour, totalprice: result.val()},
                    function (data) {
                        if (data.code === 1) {
                            alert("Вы успешно преобрели вещи");
                            location.reload();
                        }
                        if (data.code === -2) {
                            alert("У Вас недостаточно денег, пополните счет, пожалуйста");
                        }
                        if (data.code === -3) {
                            alert("ARROR");
                        }
                    }
            );
        }


    });

});

