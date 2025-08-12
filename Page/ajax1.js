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
            window.location.href="home.php";
        }
        });
        window.location.href="home.php";
       
});