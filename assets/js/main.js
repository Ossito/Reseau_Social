
$(document).ready(function () {
    /*$('[data-confirm]').on('click', function (e) {
        e.preventDefault(); //Annuler l'action par défaut

        //Récupérer la valeur de l'attribut href
        var href = $(this).attr('href');


        //On aurait pu écrire aussi
        //var message = $(this).attr('data-confirm');
        //Afficher la popup SweetAlert
        swal({

            title: "Êtes-vous sûr?",
            text: "Voulez-vous vraiment supprimer cette publication ?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Annuler",
            confirmButtonText: "Oui",
            confirmButtonColor: "#DD6B55"

        }, function (isConfirm) {
            if (isConfirm) {
                //Si l'utilisateur clique sur Oui il faudra le rediriger l'utilisateur vers la page de suppression
                window.location.href = href;
            }
        });
    });*/

    //Système de like en AJAX
    $("a.like").on("click" , function(event){
        event.preventDefault();

        var id = $(this).attr('id');
        var url = 'ajax/micropost_like.php';
        var action = $(this).data('action');
        var micropost_id = id.split("like")[1];

        $.ajax({
          type: 'POST',
          url: url ,
          data: {
            micropost_id: micropost_id,
            action: action
          },
          success: function(likers){
            $("#likers_" + micropost_id).html(likers);
            if(action == 'like'){
              $("#" + id).html(<i class="fa fa-thumbs-down"></i>,"Je n'aime plus").data('action' , 'unlike');
            }else{
              $("#" + id).html(<i class="fa fa-thumbs-up"></i>,"J'aime").data('action' , 'like');
            }
          }

        });

    });


    //Système de recherche en AJAX
    var url = 'ajax/search.php';

    $('#searchbox').on('keyup', function () {
        var query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                type: 'POST',
                url: url ,
                data: {
                  query: query
                },
                beforeSend: function () {
                    $("#spinner").show();  
                },
                success: function (data) {
                    $("#spinner").hide();
                    $("#display-results").html(data).show();
                }
    
              });
        } else {
            $("#display-results").hide();
        }
        
    });
});
