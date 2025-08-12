<?php include("theme.php") ?>


<?php include('editionprofil.php') ?>



<script>



$(".com_btn").click(function () {

var id= $(this).data('cache');
$('.' + id).toggle('slow');
});


$("#poste").on('submit', function(e){

e.preventDefault();
$.ajax({
    type: 'POST',
    url: 'ajaxAction.php?addpost',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,
  
    success: function(reponse){  
    }
    });

window.location.reload();

   
});


</script>


<script>


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
            $(button).html('<i class="bi bi-check-circle-fill"></i> effectuer')
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
            $(button).html('<i class="bi bi-check-circle-fill"></i>')
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
            $('.unlike_btn').show();
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

$("#editer-profil").on('submit', function(e){
e.preventDefault();
$.ajax({
    type: 'POST',
    url: 'editer-profilAction.php',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,

    success: function(reponse){  
        window.location.reload();
    }
  
    });

});

$("#groupe").on('submit', function(e){
e.preventDefault();
$.ajax({
    type: 'POST',
    url: 'ajaxAction.php?groupe',
    data: new FormData(this),
    dataType: 'json',
    contentType: false,
    cache: false,
    processData:false,

    success: function(reponse){  
        window.location.reload();
    }
  
    });

});

</script>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


<script src="index.js"></script>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/jquery.timeago.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


