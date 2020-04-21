<?php
/**
 * @var User $user
 */

use App\src\Entities\User;
use Framework\Helpers\Session;

?>

<?php if (Session::get('success_login')): ?>
    <div class="alert alert-success">
        Logged!
    </div>
<?php endif; ?>

<div class="profile-page">
    <div class="row profile">
        <div class="profile__left col-md-5">
            <figure>
                <img class="img rounded-circle" src="<?= $user->avatarPath() ?>" alt="avatar">
            </figure>
            <h6><?= $user->fullname ?></h6>
            <div class="pt-1 pb-3 profile_left__nav">
                <a href="/logout">
                    <i class="fa fa-sign-out pr-1"></i>
                    <?= _('Logout') ?>
                </a>
            </div>
        </div>
        <div class="profile__right col-md-7">
            <h3 class="mb-4"><?= _('Profile') ?></h3>
            <div class="profile_right__info">
                <span><?= _('First Name') ?>: <?= _($user->firstname) ?></span>
                <span><?= _('Last Name') ?>: <?= _($user->lastname) ?></span>
                <span><?= _('Email') ?>: <?= _($user->email) ?></span>
                <span><?= _('Country') ?>: <?= _($user->country) ?></span>
            </div>
        </div>
    </div>
</div>