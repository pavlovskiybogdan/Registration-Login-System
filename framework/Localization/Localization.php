<?php

namespace Framework\Localization;

use Framework\Helpers\Session;

class Localization
{
    const LANGUAGES = [
      'russian' => 'ru_RU',
      'english' => 'en_US'
    ];

    const LANGUAGES_PATH = '/var/www/app/locales';

    /**
     * Current interface language
     * @var string
     */
    private $language;

    /**
     * Localization constructor.
     */
    public function __construct()
    {
        $this->language = self::LANGUAGES['english'];

        if (Session::has('language')) {
            $this->language = Session::get('language');
        }
    }

    /**
     * Localization
     */
    public function localize() : void
    {
        putenv('LC_ALL=' . $this->language);
        setlocale(LC_ALL, $this->language, $this->language . '.utf8');
        bind_textdomain_codeset($this->language, 'UTF-8');
        bindtextdomain($this->language, self::LANGUAGES_PATH);
        textdomain($this->language);
    }

    /**
     * Set interface language
     * @param $language
     */
    public function setLanguage($language) : void
    {
        Session::set('language', $language);
        $this->language = $language;
        $this->localize();
    }

    /**
     * @return bool
     */
    public static function isRussianLang() : bool
    {
        return Session::get('language') === self::LANGUAGES['russian'];
    }

    /**
     * @return bool
     */
    public static function isEnglishLang() : bool
    {
        return Session::get('language') === self::LANGUAGES['english'];
    }
}