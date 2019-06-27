

<div class="card-body status-media" id="micropost<?= $micropost->m_id ?>">
  <img src="<?= $micropost->avatar ? $micropost->avatar : get_gravatar_url($micropost->email , 40) ?>" alt="<?= e($micropost->pseudo); ?>" style="width:35px;height:35px;border-radius:80px;">
  <div class="media-body">
    <h4 class="media-heading" style="font-weight:700;"><i class="fa fa-user"></i> <?= e($micropost->pseudo); ?> </h4>
    <div class="row">
      <div class="col-sm-7">
        <p style="font-size:15px;"><i class="fa fa-clock-o faa-tada animated"></i> <span class="timeago" title="<?= $micropost->created_at ?>"><?= $micropost->created_at ?></span></p>
      </div>
      <div class="col-md-5">
        <?php if($micropost->user_id == get_session('user_id')): ?>
          <a class="btn btn-danger btn-xs" onclick="return confirm('Êtes-vous vraiment sûr de vouloir cette publication ?')" href="delete_micropost.php?id=<?= $micropost->m_id ?>" style="margin-top:-8px;color:#fff;"><i class="fa fa-trash faa-pulse animated"></i> Supprimer</a>
        <?php endif; ?>
      </div>
    </div>
    <p style="font-weight:bold;"> <?= nl2br(replace_links(e($micropost->content))); ?> </p>
    
    <hr>

    <div class="row">
      <div class="col-md-5">
        <?php if(user_has_already_liked_the_micropost($micropost->m_id)): ?>
          <a id="unlike<?= $micropost->m_id ?>" data-action = "unlike"  href="unlike_micropost.php?id=<?= $micropost->m_id ?>" class="btn btn-danger like" style="font-size:15px;"><i class="fa fa-thumbs-down faa-pulse animated"></i> Je n'aime plus</a>
        <?php else: ?>
          <a id="like<?= $micropost->m_id ?>"data-action = "like" href="like_micropost.php?id=<?= $micropost->m_id ?>" class="btn btn-primary like" style="font-size:15px;"><i class="fa fa-thumbs-up faa-pulse animated"></i> J'aime</a>
        <?php endif; ?>
      </div>
    </div><br>
    <div class="" id="likers_<?= $micropost->m_id?>">
      <!--<p style="margin-top:6px;">Nombre de J'aime (<?=  $micropost->like_count ?>) </p> -->
      <p style="font-size:12px;margin-left:-8px;"> <?= get_likers_text($micropost->m_id) ?></p>
    </div>
 
  </div>
</div>


