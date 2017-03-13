var counter = 0;
$(document).ready(function () {
    $('span.heartbutton').on('click', function () {
        $(this).toggleClass('red');
        var postId = $(this).attr('id');
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'clickOnHeart',
                postId: postId
            },
            success: function (data) {
                if (data == 1) {
                    $('div.heart:hover .descr').css('visibility', 'hidden');
                } else {
                    $('div.heart:hover .descr').css('visibility', 'visible');
                    $('div.wholiked').text(data);
                }
            }
        });
    });
    $('span.viewmore').on('click', function () {
        var postId = $(this).attr('id');
        counter++;
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'overHeart',
                postId: postId,
                viewmore: counter
            },
            success: function (data) {
                countData = data.split(" ").length;
                if (countData < 5 + 10 * counter) {
                    $('div.wholiked').text(data);
                    $('span.viewmore').css('display', 'none');
                } else {
                    $('div.wholiked').text(data);
                    $('span.viewmore').css('display', 'block');
                }
            }
        })
    });
});

$(document).ready(function () {
    $('span.heartbutton').mouseenter(function () {
        var postId = $(this).attr('id');
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'overHeart',
                postId: postId
            },
            success: function (data) {
                if (data == 1) {
                    $('div.heart:hover .descr').css('visibility', 'hidden');
                } else {
                    $('div.heart:hover .descr').css('visibility', 'visible');
                    $('div.wholiked').text(data);
                }
            }
        })
    });
});

$(document).ready(function () {
    $('div.descr').mouseleave(function () {
        $('span.viewmore').css('display', 'block');
        counter = 0;
    });
});