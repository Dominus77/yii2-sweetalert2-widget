<?php

namespace tests;

use dominus77\sweetalert2\assets\ExampleAsset;
use yii\web\AssetBundle;

/**
 * Class ExampleAssetTest
 * @package tests
 */
class ExampleAssetTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        ExampleAsset::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\sweetalert2\\assets\\ExampleAsset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('example.css', $content);
        $this->assertContains('buttons.css', $content);
    }
}
