

<?php
  session_start();
  require("includes/init.php");
  include('filters/auth_filter.php');


  //Récupération de toutes les notifications de l'utilisateur connecté
  // (Aussi bien les notifications lues que les notifications non lues).
  $q = $db->prepare("SELECT users.pseudo , users.avatar , users.email, notifications.subject_id , notifications.name , notifications.user_id , notifications.seen , notifications.created_at FROM notifications LEFT JOIN users ON users.id = user_id WHERE subject_id = ?");
  $q->execute([get_session('user_id')]);


  $notifications = $q->fetchAll(PDO::FETCH_OBJ);


  // Après avoir récupéré les notifications de l'utilisateur connecté,
  // nous modifions la valeur de leur attribut 'seen' afin d'indiquer que
  // l'utilisateur vient de lire ces notifications.
  $q = $db->prepare("UPDATE notifications SET seen = '1' WHERE subject_id = ?");
  
  $q->execute([get_session('user_id')]);


  $q = $db->prepare("SELECT notifications.id FROM notifications LEFT JOIN users ON users.id = user_id WHERE subject_id = ?");
  
  $q->execute([get_session('user_id')]);
  $notifications_total = $q->rowCount();
    
  
  
  //Pagination de la page de notifications
  if($notifications_total >= 1){
    $nbre_notifications_par_page = 2;
    $nbre_pages_max_gauche_et_droite = 4;
    $last_page = ceil($notifications_total / $nbre_notifications_par_page);
  
    if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $page_num = $_GET['page'];
  }else {
    $page_num = 1;
  }
  
  if($page_num < 1){
    $page_num = 1;
  }else if($page_num > $last_page) {
    $page_num = $last_page;
  }
  
  $limit = 'LIMIT '.($page_num - 1) * $nbre_notifications_par_page. ',' . $nbre_notifications_par_page;
  $q = $db->prepare("SELECT users.pseudo, users.avatar, users.email,notifications.subject_id, notifications.name,notifications.user_id, notifications.seen,
                    notifications.created_at FROM notifications LEFT JOIN users ON users.id = user_id WHERE subject_id = ? ORDER BY notifications.created_at DESC $limit ");
  $q->execute([get_session('user_id')]);

  $notifications = $q->fetchAll(PDO::FETCH_OBJ);
  $pagination = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
    
  if($last_page != 1){
    if($page_num > 1){
      $previous = $page_num - 1;
      $pagination .= '<li class="page-item"><a class="page-link" href="notifications.php?page='.$previous.'" aria-label="Next"><span aria-hidden="true">&laquo;</span></a></li>';
      
  for($i = $page_num - $nbre_pages_max_gauche_et_droite; $i < $page_num; $i++){
    if($i > 0){
      $pagination .= '<li class="page-item"><a class="page-link" href="notifications.php?page='.$i.'">'.$i.'</a></li>';
      }
    }
  }
      $pagination .= '<li class="page-item active" aria-current="page"><a class="page-link" href="#">'.$page_num.'</a></li>';

  for($i = $page_num+1; $i <= $last_page; $i++){
    $pagination .= '<li class="page-item"><a class="page-link" href="notifications.php?page='.$i.'">'.$i.'</a></li> ';
      if($i >= $page_num + $nbre_pages_max_gauche_et_droite){
        break;
      }
    }
      
    if($page_num != $last_page){
      $next = $page_num + 1;
      $pagination .= '<li class="page-item"><a class="page-link" href="notifications.php?page='.$next.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li> ';
      }
    }
    
    $pagination .= '</ul></nav>';
      require("views/notifications.view.php");
    }else {
      set_flash('Aucune notification disponible pour le moment...');
      redirect('index.php');
    }

    $q = $db->prepare("UPDATE notifications SET seen = '1' WHERE subject_id = ?");
    $q->execute([get_session('user_id')]);

  ?>