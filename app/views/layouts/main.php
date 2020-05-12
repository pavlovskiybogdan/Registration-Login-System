<?php

/**
 * @var View $self
 */

use Framework\View\View;
use Framework\Application;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= $self->cssPath() ?>">
    <title>Test Task</title>
</head>
<body>
    <nav class="top-nav d-flex mb-5">
        <div class="top-nav__left">
            <span><a href="/">App</a></span>
        </div>
        <div class="top-nav__right ml-auto mr-5">
            <span id="change-language-trigger"><?= _('Language') ?></span>
            <i class="fa fa-chevron-down"></i>
        </div>
    </nav>

    <div class="choose-language-block closed" id="lang-block">
        <ul>
            <li class="<?= Application::$app->localization->isEnglishLang ? 'chosen' : '' ?>" data-lang="en_US">English</li>
            <li class="<?= Application::$app->localization->isRussianLang ? 'chosen' : '' ?>" data-lang="ru_RU"><?= _('Russian') ?></li>
        </ul>
    </div>

    <div id="root">
        <div class="container">
            <?php $self->content() ?>
        </div>
    </div>

    <script src="<?= $self->jsPath() ?>"></script>
</body>
</html>