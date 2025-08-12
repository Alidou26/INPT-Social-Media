$(document).ready(function(){
    setInterval(function(){
        let pseudo_recepteur = $("#pseudo_recepteur").val();
        $.ajax({
            type: "POST",
            url: "../PageAction/afficheConversationAction.php",
            data: {pseudo_recepteur: pseudo_recepteur},
            success: function(response){
                $("#messages").html(response);
            }
        });
    }, 500);
});