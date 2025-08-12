$(".followbtn").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);

    $.ajax({
        url: 'ajaxAction.php?follow',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> Suivie')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});


$(".refuser").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    console.log('clicked');
    $.ajax({
        url: 'ajaxAction.php?refuser',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i>Invitation Refuse')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});




$(".invitation").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    console.log('clicked');
    $.ajax({
        url: 'ajaxAction.php?invitation',
        method: 'post',
        dataType: 'json',
        data: { user_id: user_id_v },
        success: function (response) {
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> invitation envoye')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});



$(".like_btn").click(function () {
    var post_id_v = $(this).data('postId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'ajaxAction.php?like',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v },
        success: function (response) {
            console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $(button).siblings('.unlike_btn').show();
                $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - (-1));
                //location.reload();

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');

            }


        }
    });
});







$(".unlike_btn").click(function () {
    var post_id_v = $(this).data('postId');
    var button = this;
    $(button).attr('disabled', true);
    $.ajax({
        url: 'ajaxAction.php?unlike',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v },
        success: function (response) {

            if (response.status) {

                $(button).attr('disabled', false);
                $(button).hide()
                $('.unlike_btn').hide();
                $('.like_btn').show();

                // location.reload();
                $('#likecount' + post_id_v).text($('#likecount' + post_id_v).text() - 1);

            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});




//for adding comment
$(".add-comment").click(function () {
    var button = this;
	var input = $(this).data('input');// pour le boutton input

	var comment_v = $('.'+ input).val();
    if (comment_v == '') {
        return 0;
    }
    var post_id_v = $(this).data('postId');
    var cs = $(this).data('cs');
    var page = $(this).data('page');


    $(button).attr('disabled', true);
    $(button).siblings('.'+ input).attr('disabled', true);
    $.ajax({
        url: 'ajaxAction.php?addcomment',
        method: 'post',
        dataType: 'json',
        data: { post_id: post_id_v, comment: comment_v },
        success: function (response) {
            console.log(response);
            if (response.status) {

                $(button).attr('disabled', false);
                $(button).siblings('.'+ input).attr('disabled', false);
                $('.'+ input).val(' ');
                $("."+ cs).prepend(response.comment);

                $('.nce').hide();
                if (page == 'estdsm') {
                   
                }

            } else {
                $(button).attr('disabled', false);
                $(button).siblings('.'+ input).attr('disabled', false);

                alert('something is wrong,try again after some time');


            }



        }
    });
});



$(".integrerGroupe").click(function () {
    var user_id_v = $(this).data('userId');
    var button = this;
    $(button).attr('disabled', true);
    console.log('clicked');
    $.ajax({
        url: 'ajaxAction.php?integrerGroupe',
        method: 'post',
        dataType: 'json',
        data: { id_groupe: user_id_v },
        success: function (response) {
            if (response.status) {
                $(button).data('userId', 0);
                $(button).html('<i class="bi bi-check-circle-fill"></i>')
            } else {
                $(button).attr('disabled', false);

                alert('something is wrong,try again after some time');
            }
        }
    });
});