
    
    
    <?php if(relation_link_to_display($_GET['id']) == CANCEL_RELATION_LINK): ?>
        <h6>Demande d'amitié bien envoyé </h6>
        <a href="delete_friend.php?id=<?= $_GET['id']?>" class="btn btn-danger pull-center"><i class="fa fa-minus-circle faa-pulse animated"></i> Annuler la demande</a>

    <?php elseif(relation_link_to_display($_GET['id']) == ACCEPT_REJECT_RELATION_LINK): ?>
        <!-- Accepter ou rejeter la demande d'ami -->

        <a href="accept_friend_request.php?id=<?= $_GET['id']?>" class="btn btn-success pull-right"><i class="fa fa-check faa-pulse animated"></i> Accepter la demande</a><br><br>
        <a href="delete_friend.php?id=<?= $_GET['id']?>" class="btn btn-danger pull-right"><i class="fa fa-times faa-pulse animated"></i> Supprimer la demande</a>

    <?php elseif(relation_link_to_display($_GET['id']) == DELETE_RELATION_LINK): ?>
        <!-- Retirer de la liste d'amis -->
        <h6>Vous êtes déjà amis</h6>
        <a href="delete_friend.php?id=<?= $_GET['id']?>" class="btn btn-danger pull-center"><i class="fa fa-times faa-pulse animated"></i> Retirer de mes amis</a>
        

    <?php elseif(relation_link_to_display($_GET['id']) == ADD_RELATION_LINK): ?>
        <a href="add_friend.php?id=<?= $_GET['id']?>" class="btn btn-primary pull-right"><i class="fa fa-plus faa-pulse animated"></i> Ajouter comme ami</a>
    <?php endif;?>