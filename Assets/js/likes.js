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
                $('div.wholiked').text(data);
            }
        });
    });
    var counter = 0;
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
                $('div.wholiked').text(data);
            }
        })
    });
});

$(document).ready(function () {
    $('span.heartbutton').mouseover(function () {
        var postId = $(this).attr('id');
        $.ajax({
            url: '../../Assets/ajax/liked.php',
            method: 'POST',
            data: {
                action: 'overHeart',
                postId: postId
            },
            success: function (data) {
                $('div.wholiked').text(data);
            }
        })
    })
});