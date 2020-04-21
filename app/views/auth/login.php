<div class="login-page">
    <div class="page-title">
        <h2><?= _('Login') ?></h2>
    </div>

    <form class="row" id="login-form">
        <div class="form-group col-md-8">
            <label for="email">E-Mail <?= _('Address') ?></label>
            <input type="email" id="email" name="email" class="form-control" required />
            <strong class="invalid-feedback"><?= _('These credentials do not match our records.') ?></strong>
        </div>
        <div class="form-group col-md-8">
            <label for="password"><?= _('Password') ?></label>
            <input type="password" id="password" name="password" class="form-control" required />
            <strong class="invalid-feedback"><?= _('These credentials do not match our records.') ?></strong>
        </div>
        <div class="form-group col-md-8">
            <button type="submit" class="btn btn-dark"><?= _('Login') ?></button>
            <div class="tip mt-3">
                <span><a href="/reset-password"><?= _('Forget password?') ?></a></span>
            </div>
            <div class="tip mt-1">
                <span><?= _('Don\'t have account?') ?> <a href="/register"><?= _('Sign up') ?></a></span>
            </div>
        </div>
    </form>
</div>