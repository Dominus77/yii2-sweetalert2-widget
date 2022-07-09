<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class BaseAsset
 * @package dominus77\sweetalert2
 */
class BaseAsset extends AssetBundle
{
    /**
     * @return string
     */
    public function min()
    {
        return YII_ENV_DEV ? '' : '.min';
    }
}
