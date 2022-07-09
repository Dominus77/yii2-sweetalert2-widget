<?php

namespace dominus77\sweetalert2\assets;

/**
 * Class AnimateCssAsset
 * @package dominus77\sweetalert2\assets
 * @see https://github.com/animate-css/animate.css
 */
class AnimateCssAsset extends BaseAsset
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = '@npm/animate.css';
        $this->css[] = 'animate' . $this->min() . '.css';
        parent::init();
    }
}
