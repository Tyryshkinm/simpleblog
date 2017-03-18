$(document).ready(function () {
    $('div.pencil').on('click', function () {
        var postId = $('span.pencilbutton', this).attr('id');
        $.ajax({
            url: '../../Assets/ajax/editPostAjax.php',
            method: 'POST',
            data: {
                action: 'clickOnPencil',
                postId: postId,
                dataType: 'text',
                async: false
            },
            success: function (data) {
                dataPost = data;
                $('#edit' + postId).html(data).slideToggle("slow");
                $('div.editPostAjax > div > button').on('click', function () {
                    var title = document.getElementById("editTitle"+postId).value;
                    var text = document.getElementById("editText" + postId).value;
                    $.ajax({
                        url: '../../Assets/ajax/editPostAjax.php',
                        method: 'POST',
                        data: {
                            action: 'clickOnSave',
                            postId: postId,
                            title: title,
                            text: text,
                            async: false
                        },
                        success: function () {
                            $('#edit' + postId).html(data).slideToggle("slow");
                            title = '<a class="h2" href="/post/' + postId + '/view">' + title + '</a>';
                            var slicedText = text.slice(0, 200);
                            if (slicedText.length < text.length)
                                slicedText += '...' + '<a href="/post/' + postId + '/view">read more </a>';
                            document.getElementById("title"+postId).innerHTML = title;
                            document.getElementById("text"+postId).innerHTML = slicedText;
                        }
                    });
                });
            }
        });
    });
});