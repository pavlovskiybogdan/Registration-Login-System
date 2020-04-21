<?php

use Framework\Application;

?>

<div class="change-password-page">
    <div class="page-title">
        <h2><?= _('Change Password') ?></h2>
    </div>

    <div class="alert alert-success closed" role="alert" id="change-password-alert">
        <?= _("Password was changed.") ?> <a href="/login"><?= _('Login') ?></a> <?= _('in your account') ?>
    </div>

    <form class="row" id="change-password-form">
        <div class="form-group col-md-8">
            <input type="hidden" id="token" name="token" value="<?= Application::$app->request->partialUrl[2] ?>" class="form-control" required />
            <strong class="invalid-feedback"><?= _('This is not valid password') ?></strong>
        </div>
        <div class="form-group col-md-8">
            <label for="password"><?= _('New password') ?></label>
            <input type="password" id="password" name="password" class="form-control" required />
            <strong class="invalid-feedback"><?= _('Unsafe or invalid passwords') ?></strong>
        </div>
        <div class="form-group col-md-8">
            <label for="password_confirm"><?= _('Confirm password') ?></label>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control" required />
            <strong class="invalid-feedback"><?= _('This is not valid password') ?></strong>
        </div>
        <div class="form-group col-md-8">
            <button type="submit" class="btn btn-dark"><?= _('Change') ?></button>
        </div>
    </form>
</div>