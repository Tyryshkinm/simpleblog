var counter = 0;
$(document).ready(function () {
    $('div.post > div > div > button').on('click', function () {
        var postId = $('span.heartbutton', this).attr('id');
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'clickOnHeart',
                postId: postId,
                dataType: 'text',
                async: false
            },
            success: function (data) {
                countData = data.split(",").length - 2;
                Data = data.split(",");
                Data = Data.splice(0, 5);
                Data = Data.join(' ');
                if (countData < 5 && data != 2) {
                    $('div.post > div > div > div > button > span').css('display', 'none');
                } else if (countData >= 5 && data !=2)
                {
                    $('div.post > div > div > div > button > span').css('display', 'block');
                }
                if (data == 1) {
                    $('div.heart:hover .descr').css('display', 'none');
                    $('#' + postId).toggleClass('red');
                } else if (data == 2) {
                } else {
                    $('div.heart:hover .descr').css('display', 'block');
                    $('div.wholiked').html(Data);
                    $('#' + postId).toggleClass('red');
                }
            }
        });
    });
    $('div.post > div > div > div > button').on('click', function () {
        var postId = $('span.viewmore', this).attr('id');
        counter++;
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'overHeart',
                postId: postId,
                viewmore: counter,
                dataType: 'text',
                async: false
            },
            success: function (data) {
                countData = data.split(",").length - 2;
                countLikes = 5 + 10 * counter;
                Data = data.split(",");
                Data = Data.splice(0, countLikes);
                Data = Data.join(' ');
                if (countData < countLikes) {
                    $('div.wholiked').html(Data);
                    $('div.post > div > div > div > button > span').css('display', 'none');
                } else {
                    $('div.wholiked').html(Data);
                    $('div.post > div > div > div > button > span').css('display', 'block');
                }
            }
        })
    });
});

$(document).ready(function () {
    $('div.post > div > div > button').mouseenter(function () {
        var postId = $('span.heartbutton', this).attr('id');
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'overHeart',
                postId: postId,
                dataType: 'text',
                async: false
            },
            success: function (data) {
                countData = data.split(",").length - 2;
                if (countData < 5) {
                    $('div.post > div > div > div > button > span').css('display', 'none');
                }
                Data = data.split(",");
                Data = Data.splice(0, 5);
                Data = Data.join(' ');
                if (data == 1) {
                } else {
                    $('div.wholiked').html(Data);
                    $('div.heart:hover .descr').css('display', 'block');
                }
            }
        })
    });
});

$(document).ready(function () {
    $('div.heart, div.descr').mouseleave(function () {
        $('div.post > div > div > div > button > span').css('display', 'block');
        $('div.descr').css('display', 'none');
        counter = 0;
    });
});

