<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class AnimateCssAsset
 * @package dominus77\sweetalert2\assets
 * https://github.com/daneden/animate.css
 */
class AnimateCssAsset extends AssetBundle
{
    public $sourcePath = '@vendor/daneden/animate.css';
    public $css = [];

    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'animate' . $min . '.css';
    }
}