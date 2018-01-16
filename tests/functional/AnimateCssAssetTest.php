<?php

namespace tests;

use dominus77\sweetalert2\assets\AnimateCssAsset;
use yii\web\AssetBundle;

/**
 * Class AnimateAssetTest
 * @package tests
 */
class AnimateCssAssetTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function testRegister()
    {
        $min = YII_ENV_DEV ? '' : '.min';

        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        AnimateCssAsset::register($view);
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\sweetalert2\\assets\\AnimateCssAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        //$this->assertContains('jquery.js', $content);
        $this->assertContains('animate' . $min . '.css', $content);
    }
}
