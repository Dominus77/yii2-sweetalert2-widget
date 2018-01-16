<?php

namespace tests;

/**
 * Class AssetManager
 * @package tests
 */
class AssetManager extends \yii\web\AssetManager
{
    private $_hashes = [];
    private $_counter = 0;

    /**
     * @inheritdoc
     */
    public function hash($path) {
        if (!isset($this->_hashes[$path])) {
            $this->_hashes[$path] = $this->_counter++;
        }
        return $this->_hashes[$path];
    }
}
