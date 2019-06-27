

<?php

    session_start();

    require ('../config/dbconnect.php');
    require ('../includes/functions.php');

    extract($_POST);

    $q = $db->prepare("SELECT id , name, email, pseudo , avatar FROM users WHERE (name LIKE :query OR pseudo LIKE :query OR email LIKE :query) LIMIT 2");
    
    $q->execute([
        'query' => '%' .$query. '%'
    ]);

    $users = $q->fetchAll(PDO::FETCH_OBJ);
    

    if(count($users) > 0){

        foreach($users as $user){
        ?>
            <div class="display-box-user">
                <a href="profile.php?id=<?= $user->id ?>"><img src="<?= $user->avatar ? $user->avatar : get_gravatar_url($user->email , 25) ?>" alt="<? e($user->pseudo) ?> " width="25" height="25">&nbsp;<?= e($user->name) ?> <br> 
                    <?= e($user->email) ?> </a>
            </div>

        <?php
        }
    }else{
        echo '<div class="display-box-user">Aucun utilisateur trouvé.</div>';
    }

    

    
?>