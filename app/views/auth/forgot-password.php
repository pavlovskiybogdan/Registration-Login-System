<div class="forgot-password-page">
    <div class="page-title">
        <h2><?= _('Password Reset') ?></h2>
    </div>

    <div class="alert alert-success closed" role="alert">
        <?= _('Check your email for confirmation letter') ?>
    </div>

    <form class="row" id="password-reset-form">
        <div class="form-group col-md-8">
            <label for="email">E-Mail <?= _('Address') ?></label>
            <input type="email" id="email" name="email" class="form-control" required />
            <strong class="invalid-feedback"><?= _('This email address doesn\'t exist.') ?></strong>
        </div>
        <div class="form-group col-md-8">
            <button type="submit" class="btn btn-dark"><?= _('Reset') ?></button>
        </div>
    </form>
</div>