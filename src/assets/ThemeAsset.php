<?php

namespace dominus77\sweetalert2\assets;

/**
 * Class BaseThemeAsset
 * @package dominus77\sweetalert2\assets\themes
 */
class ThemeAsset extends BaseAsset
{
    const THEME_BOOTSTRAP4 = 'bootstrap-4';
    const THEME_BORDERLESS = 'borderless';
    const THEME_BULMA = 'bulma';
    const THEME_DARK = 'dark';
    const THEME_DEFAULT = 'default';
    const THEME_MATERIAL_UI = 'material-ui';
    const THEME_MINIMAL = 'minimal';
    const THEME_WORDPRESS_ADMIN = 'wordpress-admin';

    /**
     * @var string[]
     */
    public $depends = [
        SweetAlert2Asset::class
    ];

    /** @var string */
    public static $theme;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@npm/sweetalert2--themes';
        if (self::$theme !== null) {
            $this->css[] = $this->themeCssPath();
        }
        parent::init();
    }

    /**
     * @return string
     */
    public function themeCssPath()
    {
        return self::$theme . '/' . self::$theme . $this->min() . '.css';
    }

    /**
     * @param $view
     * @param $theme
     * @return ThemeAsset
     */
    public static function register($view, $theme = null)
    {
        self::$theme = $theme;
        return parent::register($view);
    }
}
