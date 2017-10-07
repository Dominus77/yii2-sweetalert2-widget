<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class SweetAlert2Asset
 * @package dominus77\sweetalert2\assets
 */
class SweetAlert2Asset extends AssetBundle
{
    public $sourcePath = '@dominus77/sweetalert2/assets/src';

    public $css = [];

    public $js = [];

    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'dist/sweetalert2' . $min . '.css';
        $this->js[] = 'dist/sweetalert2' . $min . '.js';
    }

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}