$(function () {

//Живой поиск
    $('.who').bind('change keyup input click', function () {
        if (this.value.length >= 2) {
            $.ajax({
                type: 'post',
                url: '../scripts/searchBuch.php',
                data: {'referal': this.value},
                response: 'text',
                success: function (data) {
                    $('.search_result').html(data).fadeIn();
                }
            })
        }
    });

    $('.schrank').bind('change keyup input click', function () {
        if (this.value.length != 0) {
            $.ajax({
                type: 'post',
                url: '../scripts/searchBuch.php',
                data: {'schrank_num': this.value},
                response: 'text',
                success: function (data) {
                    $('.search_result').html(data).fadeIn();
                }
            })
        }
    });

    $('.regal').bind('change keyup input click', function () {
        if (this.value.length != 0) {
            $.ajax({
                type: 'post',
                url: '../scripts/searchBuch.php',
                data: {'regal_num': this.value},
                response: 'text',
                success: function (data) {
                    $('.search_result').html(data).fadeIn();
                }
            })
        }
    });

    $('.search_result').hover(function () {
        $('.who').blur(); //Убираем фокус с input
    });

//При выборе результата поиска, прячем список и заносим выбранный результат в input
    $('.search_result').on('click', 'li', function () {
        s_user = $(this).text();
        // $(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $('.search_result').fadeOut();
    })

});