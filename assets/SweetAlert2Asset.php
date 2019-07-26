<?php

namespace dominus77\sweetalert2\assets;

use yii\web\AssetBundle;

/**
 * Class SweetAlert2Asset
 * @package dominus77\sweetalert2\assets
 */
class SweetAlert2Asset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/sweetalert2/dist';

    /**
     * @var array
     */
    public $js = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->js[] = 'https://cdn.jsdelivr.net/npm/sweetalert2@7';
    }
}
