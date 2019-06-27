

<a href="profile.php?id=<?= $notification->user_id ?>">
    <img src="<?= $notification->avatar ? $notification->avatar : get_avatar_url($notification->email, 40) ?>" alt="Image de profil de <?= e($notification->pseudo) ?>" class="avatar-xs" style="width:28px;height:28px;border-radius:50px;"> <?= e($notification->pseudo) ?>
</a>
vous a envoyé une demande d'amitié <span class="timeago" title="<?= $notification->created_at ?>"><?= $notification->created_at ?></span>.
    <a class="btn btn-success btn-sm" href="accept_friend_request.php?id=<?= $notification->user_id ?>"><i class="fa fa-check faa-pulse animated"></i> Accepter la demande</a>
    <a class="btn btn-danger btn-sm" href="delete_friend.php?id=<?= $notification->user_id?>"><i class="fa fa-times faa-pulse animated"></i> Supprimer la demande</a
