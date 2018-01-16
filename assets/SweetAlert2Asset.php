<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class SweetAlert2Asset
 * @package dominus77\sweetalert2\assets
 */
class SweetAlert2Asset extends AssetBundle
{
    public $sourcePath = '@bower/sweetalert2/dist';

    public $css = [];

    public $js = [];

    public function init()
    {
        $min = YII_ENV_DEV ? '' : '.min';
        $this->css[] = 'sweetalert2' . $min . '.css';
        $this->js[] = 'sweetalert2' . $min . '.js';
    }
}
