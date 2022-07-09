<?php

namespace dominus77\sweetalert2\assets;

/**
 * Class SweetAlert2Asset
 * @package dominus77\sweetalert2\assets
 */
class SweetAlert2Asset extends BaseAsset
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@npm/sweetalert2/dist';
        $min = $this->min();
        $this->js[] = 'sweetalert2' . $min . '.js';
        $this->css[] = 'sweetalert2' . $min . '.css';
        parent::init();
    }
}
