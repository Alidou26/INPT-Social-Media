$(document).ready(function(e){

    //inscription

    $("#formInscription").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'PageAction/inscriptionAction.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(reponse){
               if(reponse == 0)
               {
                   window.location.href='index.php';
               }

               else {
                $(".alert-inscription-danger").show();
                $(".alert-inscription-danger").html(reponse);
                setTimeout(function(){$(".alert-inscription-danger").hide();},5000);
               }
            
                }
                
            });
    });

    //connexion

    $("#formConnexion").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'PageAction/connexionAction.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            success: function(reponse){
               if(reponse['status'] == 0)
               {
                   window.location.href=reponse['url'];
    
    
               }
    
    
               else {
                $(".alert-inscription-danger").show();
                $(".alert-inscription-danger").html(reponse['status']);
                setTimeout(function(){$(".alert-inscription-danger").hide();},5000);
               }
            
                }
                
            });
    });






})