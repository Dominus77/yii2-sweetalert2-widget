<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class ExampleAsset
 * @package dominus77\sweetalert2\assets
 */
class ExampleAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/src';
        $this->css = [
            'css/example.css',
            'css/buttons.css'
        ];
    }
}