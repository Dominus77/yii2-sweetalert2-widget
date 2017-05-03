<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class ExampleAsset
 * @package dominus77\sweetalert2\assets
 */
class ExampleAsset extends AssetBundle
{
    public $sourcePath = '@dominus77/sweetalert2/assets/src';

    public $css = [
        'css/example.css',
        'css/buttons.css'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}