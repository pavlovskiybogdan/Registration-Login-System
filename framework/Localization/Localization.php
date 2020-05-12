<?php

namespace Framework\Localization;

use Framework\Helpers\Session;
use Framework\Component;

/**
 * Class Localization
 * @package Framework\Localization
 */
class Localization extends Component
{
    const LANGUAGES = [
      'russian' => 'ru_RU',
      'english' => 'en_US'
    ];

    const LANGUAGES_PATH = '/var/www/app/locales';

    /**
     * Current interface language
     */
    private string $language;

    public function __construct()
    {
        $this->language = self::LANGUAGES['english'];

        if (Session::has('language')) {
            $this->language = Session::get('language');
        }
    }

    public function localize(): void
    {
        putenv('LC_ALL=' . $this->language);
        setlocale(LC_ALL, $this->language, $this->language . '.utf8');
        bind_textdomain_codeset($this->language, 'UTF-8');
        bindtextdomain($this->language, self::LANGUAGES_PATH);
        textdomain($this->language);
    }

    /**
     * Set the interface language
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        Session::set('language', $language);
        $this->language = $language;
        $this->localize();
    }

    /**
     * @return bool
     */
    public static function getIsRussianLang(): bool
    {
        return Session::get('language') === self::LANGUAGES['russian'];
    }

    /**
     * @return bool
     */
    public static function getIsEnglishLang(): bool
    {
        return Session::get('language') === self::LANGUAGES['english'];
    }
}