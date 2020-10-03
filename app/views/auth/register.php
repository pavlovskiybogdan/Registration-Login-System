<div class="register-page">
    <div class="page-title">
        <h2><?= _('Register') ?></h2>
    </div>

    <form class="row" id="register-form" name="registerForm" enctype="multipart/form-data">
        <div class="form-group col-md-12">
            <div class="upload-file">
                <span><?= _('Avatar') ?>*</span>
                <label class="custom-file-upload">
                    <input class="form-control" name="avatar" id="avatar" accept="image/*" type="file"/>
                    <span><?= _('Upload') ?></span>
                    <i class="fa fa-upload"></i>
                </label>
            </div>
            <div id="image-preview">
                <img alt="avatar">
            </div>
        </div>

        <div class="form-group col-md-6">
            <label for="firstname"><?= _('First Name') ?>*</label>
            <input
                type="text"
                id="firstname"
                minlength="3"
                maxlength="50"
                name="firstname"
                class="form-control"
                required
            />
            <strong class="invalid-feedback"><?= _('It\'s not valid first name') ?></strong>
        </div>

        <div class="form-group col-md-6">
            <label for="lastname"><?= _('Last Name') ?>*</label>
            <input
                type="text"
                id="lastname"
                minlength="3"
                maxlength="50"
                name="lastname"
                class="form-control"
                required
            />
            <strong class="invalid-feedback"><?= _('It\'s not valid last name') ?></strong>
        </div>

        <div class="form-group col-md-6">
            <label for="email"><?= _('Email') ?>*</label>
            <input
                type="email"
                id="email"
                minlength="5"
                maxlength="50"
                name="email"
                class="form-control"
                required
            />
            <strong class="invalid-feedback"><?= _('It\'s not valid email') ?></strong>
        </div>

        <div class="form-group col-md-6">
            <label for="country"><?= _('Country') ?>*</label>
            <select class="form-control" id="country" name="country"></select>
            <strong class="invalid-feedback"><?= _('It\'s not valid country') ?></strong>
        </div>

        <div class="form-group col-md-6">
            <label for="password"><?= _('Password') ?>*</label>
            <input
                type="password"
                id="password"
                minlength="6"
                maxlength="50"
                name="password"
                class="form-control"
                required
            />
            <strong class="invalid-feedback"><?= _('Unsafe password') ?></strong>
        </div>

        <div class="form-group col-md-6">
            <label for="password_confirm"><?= _('Confirm password') ?>*</label>
            <input
                type="password"
                id="password_confirm"
                minlength="6"
                maxlength="50"
                name="password_confirm"
                class="form-control"
                required
            />
            <strong class="invalid-feedback"><?= _('Unsafe password') ?></strong>
        </div>

        <div class="form-group col-md-12 mt-2">
            <button type="submit" class="btn btn-dark"><?= _('Submit') ?></button>
            <div class="tip mt-3">
                <span>
                    <?= _('Already have account') ?>?
                    <a href="/login"><?= _('Sign in') ?></a>
                </span>
            </div>
        </div>
    </form>
</div>
