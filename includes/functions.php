

<?php

    //Échapper au caractères non valide de l'utilisateur
    if(!function_exists('e')){
      function e($string){
        if($string){
          return htmlspecialchars($string);
        }
      }
    }

    //Création de la fonction "not_empty" pour vérifier tous les champs ont été rempli ou pas !!!!!
    if(!function_exists('not_empty')){
      function not_empty($fields = []){
        if(count($fields) != 0){
          foreach ($fields as $field){
            if(empty($_POST[$field]) || trim($field) == ""){
              return false;
            }
          }
          return true;
        }
      }
    }

    //Création d'une fonction "is_already_in_use" pour vérifier si l'email ou le pseudo ont été déjà utilisé ou pas !!!
    if(!function_exists('is_already_in_use')){
      function is_already_in_use($field , $value , $table){

        global $db;

        $q = $db->prepare("SELECT id FROM $table WHERE $field = ?");
        $q->execute([$value]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;
      }
    }

    //Création de fonction pour afficher un message flash ("D'activation de compte")
    if(!function_exists('set_flash')){
      function set_flash($message , $type = 'info'){
          $_SESSION['notification']['message'] = $message;
          $_SESSION['notification']['type'] = $type;
      }
    }

    //Fonction pour rediriger l'utilisateur vers une page voulue ou adéquat
    if(!function_exists('redirect')){
      function redirect($page){
        header('Location: '. $page);
        exit();
      }
    }

    //Fonction pour sauvegarder les informations de notre utilisateur en session
    if(!function_exists('save_input_data')){
      function save_input_data(){
        foreach ($_POST as $key => $value){
          if(strpos($key , 'password') === false){
            $_SESSION['input'][$key] = $value;
          }
        }
      }
    }

    //Fonction pour récupérer les informations de notre utilisateur qui était session
    if(!function_exists('get_input')){
      function get_input($key){
          if(!empty($_SESSION['input'][$key])){
              return e($_SESSION['input'][$key]);
          }else{
            return null;
          }
       }
    }

    //Fonction pour récupérer les informations de notre utilisateur qui était session
    if(!function_exists('clear_input_data')){
      function clear_input_data(){
          if(isset($_SESSION['input'])){
              $_SESSION['input'] = [];
          }
       }
    }

    //Gérer l'état active ou non des liens dans le menu
    if(!function_exists('set_active')){
      function set_active($file , $class="active"){
        $page = array_pop(explode('/' , $_SERVER['SCRIPT_NAME']));

        if($page == $file.'.php'){
          return $class;
        }else{
          return "";
        }
      }
    }

    //Fonction pour gérer l'URL de l'identifiant de l'utilisateur
    if(!function_exists('get_session')){
      function get_session($key){
        if($key){
            return !empty($_SESSION[$key])
            ? e($_SESSION[$key])
            : null;
        }
      }
    }

    //Fonction pour retrouver l'utilisateur grâce à son identifiant
    if(!function_exists('find_user_by_id')){
      function find_user_by_id($id){
        global $db;

        $q = $db->prepare("SELECT name,pseudo,email,city,country,sex,facebook,instagram,available_for_hiring,bio,avatar FROM users WHERE id = ?");
        $q->execute([$id]);

        $data = $q->fetch(PDO::FETCH_OBJ);
        $q->closeCursor();

        return $data;
      }
    }

    //Gravatar URL pour afficher une photo sur le profil
    if(!function_exists('get_gravatar_url')){
      function get_gravatar_url($email, $size = 25){
        return "http://gravatar.com/avatar/".md5(strtolower(trim(e($email))))."?s=".$size.'&d=wavatar';
      }
    }

    //Vérifier si l'utilisateur est connecté
    if(!function_exists('is_logged_in')){
      function is_logged_in(){
        return isset($_SESSION['user_id']) && isset($_SESSION['pseudo']);
      }
    }

    //Fonction pour retrouver le code de l'utilisateur grâce à son identifiant
    if(!function_exists('find_code_by_id')){
      function find_code_by_id($id){
        global $db;

        $q = $db->prepare('SELECT code FROM codes WHERE id = ?');
        $q->execute([$id]);

        $data = $q->fetch(PDO::FETCH_OBJ);

        $q->closeCursor();

        return $data;
      }
    }

    //Fonction pour la langue de notre réseau (soit le français ou l'Anglais)"N'est pas utilisé pour le moment"
    if(!function_exists('get_current_locale')){
      function get_current_locale(){
        return $_SESSION['locale'];
      }
    }

    //Hashé le mot de passe avec Bcrypt plus sécurisé que sha1
    if(!function_exists('bcrypt_hash_password')){
      function bcrypt_hash_password($value , $options = array()){
        $cost = isset($options['rounds']) ? $options['rounds'] : 12;
        $hash = password_hash($value , PASSWORD_BCRYPT , array('cost' => $cost));

        if($hash == false){
          throw new Exception("Bcrypt hashing n'est pas supporté");
        }
        return $hash;
      }
    }

    //Vérifiacation du mot de passe avec password_verify
    if(!function_exists('bcrypt_verify_password')){
      function bcrypt_verify_password($value , $hashedValue){
        return password_verify($value , $hashedValue);
      }
    }

    //Pour rediriger l'utilisateur vers la page à laquelle il tentait d'aller
    if(!function_exists('redirect_intent_or')){
      function redirect_intent_or($default_url){
        if($_SESSION['forwarding_url']){
          $url = $_SESSION['forwarding_url'];
        }else{
          $url = $default_url;
        }
        $_SESSION['forwarding_url'] = null;
        redirect($url);
      }
    }

    //Se souvenir de moi 
    if(!function_exists('remember_me')){
      function remember_me($user_id){

        global $db;

          //Générer un token de manière aléatoire
          $token = openssl_random_pseudo_bytes(24);

          //Générer un sélecteur de manière aléatoire et s'assurer que ce sélecteur est unique
          do{
            $selector = openssl_random_pseudo_bytes(9);
          }while(cell_count('auth_tokens' , 'selector' , $selector) > 0);

          /*
            Sauvegarder les informations en base données
              c'est-à-dire le (user_id , le sélecteur , expiration(14jours) et le token version (hashé))
          */
          $q = $db->prepare("INSERT INTO auth_tokens (expires , selector , user_id , token) VALUES (DATE_ADD(NOW() , INTERVAL 14 DAY ) , :selector , :user_id , :token )");
          $q->execute([
            'selector' => $selector,
            'user_id' => $user_id,
            'token' => hash('sha256' , $token)
          ]);

          //Créer un cookie 'authentification => auth'(httpOnly => true) qui va expirer dans 14 jours avec ce qui est stocké en base de données
          //Encodage: Contenu du cookie base64_encode(selector). ':' .base64_encode(token)
          setcookie('auth'  , base64_encode($selector).':'.base64_encode($token) , time()+1209600 , null , null , false , true);
      }
    }


    //Fonction pour L'Auto Login Connexion automatique
    if(!function_exists('auto_login')){
      function auto_login(){

        global $db;

        //Vérifier si le cookie créer existe
        if(!empty($_COOKIE['auth'])){
          $split = explode(':' , $_COOKIE['auth']);

          if(count($split) !== 2){
            return false;
          }

          //Récupérer via ce cookie le sélecteur et le token
          list($selector , $token) = $split;

          //Vérifier au niveau de la table 'auth_token' qu'il y a un enregistrement qui un sélécteur = $selector 
          $q = $db->prepare("SELECT auth_tokens.token , auth_tokens.user_id , users.id , users.pseudo , users.avatar , users.email FROM auth_tokens LEFT JOIN users ON auth_tokens.user_id = users.id WHERE selector = ? AND expires >= CURDATE() ");
          
          //Décoder notre sélecteur précédemment encodé dans la base de données
          $q->execute([base64_decode($selector)]);

          $data = $q->fetch(PDO::FETCH_OBJ);

          //Si on trouve un enregistrement on compare les deux tokens 
          if($data){
            if(hash_equals($data->token , hash('sha256' , base64_decode($token)))){
              
              /*
                Ainsi on va enregistrer les informations en session (si tout est bon sans erreur)
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['avatar'] = $avatar;
                $_SESSION['email'] = $email;
              */
              
              session_regenerate_id(true);
              $_SESSION['user_id'] = $data->user_id;
              $_SESSION['pseudo'] = $data->pseudo;
              $_SESSION['avatar'] = $data->avatar;
              $_SESSION['email'] = $data->email;

              return true;
            }
          }
        }
              return false;
        //Retourner 'true' si tout va bien et 'false' si il y des erreurs ou des choses à corriger 
      }
    }


    //Fonction qui retourne le nombre d'enregistrement trouvé respectant une certaine condition (cell_count)
    if(!function_exists('cell_count')){
      function cell_count($table , $field_name ,  $field_value){
        global $db;

        $q = $db->prepare("SELECT * FROM $table WHERE $field_name = ?");
        $q->execute([$field_value]);

        return $q->rowCount();
      }
    }


    //Fonction qui trouve les liens cliquables dans un texte
    if(!function_exists('replace_links')){
      function replace_links($texte){
        return preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|
        [a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]
        +|\(([^\s()<>]+|(\[^\s()<>]+\)))*\))+(?:\(([^\s()<>]+
        |(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»
        ‘‘’’‘ ’ ]))/', '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '
        /(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1"
        target="_blank">$1</a>', '$1<a href="">@$2</a>', '
        $1<a href="index.php?hashtag=$2">#$2</a>'), $texte);
      }
    }


    //Fonction qui vérifie le lien à afficher en fonction de la demande
    if(!function_exists('relation_link_to_display')){
      function relation_link_to_display($id){
        global $db;

        $q = $db->prepare("SELECT user_id1 , user_id2 , status FROM friends_relationships WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1) ");
        $q->execute([
          'user_id1' => get_session('user_id'),
          'user_id2' => $id
        ]);
        
        $data = $q->fetch();

        if($data['user_id1'] == $id && $data['status'] == '0'){
          //Lien pour accepter ou refuser la demande d'amitié
          return "accept_reject_relation_link";

        }elseif($data['user_id1'] == get_session('user_id') && $data['status'] == '0'){
          //Mettre un message de notification pur dire que la demdande d'ami a déjà été bien envoyé et un lien pour supprimer la demande
          return "cancel_relation_link";

        }elseif($data['status'] == '1'){
          //lien pour supprimer la relation d'amitié
          return "delete_relation_link";
        }else{
          //Lien pour ajouter l'utilisateur / la personne comme ami
          return "add_relation_link";
        }
        $q->closeCursor();

      }
    }


    //Fonction qui compte de status à '1' pour définir le nombre d'amis
    if(!function_exists('friends_count')){
      function friends_count($id){
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships WHERE (user_id1 = :user_connected OR user_id2 = :user_connected) AND status = '1'");

        $q->execute([
          'user_connected' => $id
        ]);

        $count = $q->rowCount();

        $q->closeCursor();

        return $count;
      }
    }


    //Fonction qui vérifie si une demande d'amitié à été déjà envoyé soit du côté de l'utilisateur connecté soit de celui non connecté (vis-versa pour compréhension)
    if(!function_exists('if_a_friend_request_has_already_been_sent')){
      function if_a_friend_request_has_already_been_sent($id1 , $id2){
        global $db;

        $q = $db->prepare("SELECT status FROM friends_relationships WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1) ");

        $q->execute([
          'user_id1' => $id1,
          'user_id2' => $id2
        ]);

        $count = $q->rowCount();

        $q->closeCursor();

        return (bool) $count;
      }
    }


    //Fonction qui vérifie si l'utilisateur connecté est déjà ami à un autre utilisateur non connecté (vis-versa pour compréhension)
     /* if(!function_exists('current_user_is_friend_with')){
        function current_user_is_friend_with($second_user_id){
          global $db;
    
          $q = $db->prepare("SELECT status FROM friends_relationships WHERE ((user_id1 = :user_id1 AND user_id2 = :user_id2) 
                            OR (user_id1 = :user_id2 AND user_id2 = :user_id1)) AND status = '1' ");
    
          $q->execute([
            'user_id1' => get_session('user_id'),
            'user_id2' => $second_user_id
          ]);
    
          $count = $q->rowCount();
    
          $q->closeCursor();
    
          return (bool) $count;
        }
      }*/


    //Fonction qui permet de savoir si un utilisateur a dejà effectué une action de j'aime (like)
    if(!function_exists('user_has_already_liked_the_micropost')){
      function user_has_already_liked_the_micropost($micropost_id){
        global $db;
        

        $q = $db->prepare("SELECT id FROM micropost_like WHERE user_id = :user_id AND micropost_id = :micropost_id");
        $q->execute([
          'user_id' => get_session('user_id'),
          'micropost_id' => $micropost_id
        ]);

        return (bool) $q->rowCount();
      }
    }


    //Fonction qui permet de mettre à jour dans la base de données si un utilisateur à aimé une publication
    if(!function_exists('like_micropost')){
      function like_micropost($micropost_id){
        global $db;

        $q = $db->prepare("INSERT INTO micropost_like (user_id , micropost_id) VALUES (:user_id , :micropost_id)");

        $q->execute([
         'user_id' => get_session('user_id'),
         'micropost_id' => $micropost_id
        ]);
        
        //Dès qu'un utilisateur aime une publication (micropost) on incrémente le like_count dans la base de données
        $q = $db->prepare("UPDATE microposts SET like_count = like_count + 1 WHERE id = :micropost_id");

        $q->execute([
          'micropost_id' => $micropost_id
        ]);
      }
    }

    //Fonction qui permet de mettre à jour dans la base de données si un utilisateur à décidé de plus aimer une publication
    if(!function_exists('unlike_micropost')){
      function unlike_micropost($micropost_id){
        global $db;

        $q = $db->prepare("DELETE FROM micropost_like WHERE user_id = :user_id AND micropost_id = :micropost_id");

        $q->execute([
          'user_id' => get_session('user_id'),
          'micropost_id' => $micropost_id
        ]);
        
        //Dès qu'un utilisateur aime une publication (micropost) on incrémente le like_count dans la base de données
        $q = $db->prepare("UPDATE microposts SET like_count = like_count - 1 WHERE id = :micropost_id");

        $q->execute([
          'micropost_id' => $micropost_id
        ]);
      }
    }

    //Fonction pur récupérer le nombres de likes pour une publication (micropost) donnée
    if(!function_exists('get_like_count')){
      function get_like_count($micropost_id){
        global $db;

        $q = $db->prepare("SELECT like_count FROM microposts WHERE id = :id");
        
        $q->execute([
          'id' => $micropost_id
        ]);
        
        $data = $q->fetch(PDO::FETCH_OBJ);

        return intval ($data->like_count);
      }
    }

    //Fonction qui va retourner les "pseudo" de ceux qui ont aimé les microposts
    if(!function_exists('get_likers')){
      function get_likers($micropost_id){
        global $db;

        $q = $db->prepare("SELECT users.id , users.pseudo FROM users LEFT JOIN micropost_like ON users.id = micropost_like.user_id WHERE micropost_like.micropost_id = ? LIMIT 3");

        $q->execute([$micropost_id]);

        return $q->fetchAll(PDO::FETCH_OBJ);
      }
    }

    //FOnction qui permet de vérifier si l'utilsateur connecté à aimé un micropost
    if(!function_exists('check_if_the_current_user_has_liked_the_micropost')){
      function check_if_the_current_user_has_liked_the_micropost($micropost_id){
        global $db;

        $q = $db->prepare("SELECT id FROM micropost_like WHERE user_id = ? AND micropost_id = ?");

        $q->execute([
          get_session('user_id'),
          $micropost_id
        ]);

        $count = $q->rowCount();

        $q->closeCursor();

        return (bool) $count;
      }
    }

    //Fonction pour afficher les utilisateurs qui ont aimé des publications
    if(!function_exists('get_likers_text')){
      function get_likers_text($micropost_id){
        
        $like_count = get_like_count($micropost_id);//Nombre de j'aime d'une publication
        
        $likers = get_likers($micropost_id);

        $output = '';

        if($like_count > 0){
          
          $remaining_like_count = $like_count - 3;
          $itself_like = check_if_the_current_user_has_liked_the_micropost($micropost_id);//Fonction qui vérifie si l'utilisateur connecté à aimé une publication (micropost)
          
          foreach($likers as $liker){
            if(get_session('user_id') !== $liker->id){
              $output .= '<a href="profile.php?id='.$liker->id.'"> '.e($liker->pseudo).' </a>, ';
            }
            
          }
  
          $output  = $itself_like ? 'Vous, ' . $output : $output;

          if(($like_count == 2 || $like_count == 3) && $output === ""){
            $output = trim ($output , ', ');//Retire toutes les virgules qui se trouvent à la fin
            $arr = explode(', ' , $output);// le "explode" va diviser la chaîne de caractère au niveau de la virgule et retourner un tableau 
            $lastItem = array_pop($arr);//Le "array_pop" va retourner le dernier élément du tableau précedemment obtenu
            $output = implode(', ' , $arr);
            $output = ' et ' .$lastItem;
          }

          $output = trim ($output , ', ');
          
          switch($like_count){
            case 1:
              $output .= $itself_like ? ' aimez cela.' : ' aime cela.';
            break;
            
            case 2:
              $output .= $itself_like ? ' aimez cela.' : ' aiment cela.';
            break;
            
            case 3:
              $output .= $itself_like ? ' aimez cela.' : ' aiment cela.';
            break;

            case 4:
              $output .= $itself_like ? ' et une autre personne aimez cela.' : ' et une autre personne aiment cela.';
            break;

            default:
              $output .= $itself_like ? ' et '.$remaining_like_count. ' autres personnes aimez cela.' : ' et '.$remaining_like_count.' autres personnes aiment cela.';
            break;
          }
        }
        
        

        return $output;
      }
    }


    //Fonction pour permettre de créer manuellement un micropost pour l'utilisateur
    if(!function_exists('create_micropos_for_the_current_user')){
      function create_micropost_for_the_current_user($content){

        global $db;

        $q = $db->prepare("INSERT INTO microposts (content,user_id,created_at) VALUES (:content , :user_id , NOW())");
        $q->execute([
          'content' => $content,
          'user_id' => get_session('user_id')
        ]);
      }
    } 

    



?>
