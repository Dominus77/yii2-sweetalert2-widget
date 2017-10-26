<?php

namespace tests;

use dominus77\sweetalert2\assets\SweetAlert2Asset;
use yii\web\AssetBundle;

/**
 * Class SweetAlert2AssetTest
 * @package tests
 */
class SweetAlert2AssetTest extends TestCase
{
    public function testRegister()
    {
        $min = YII_ENV_DEV ? '' : '.min';

        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        SweetAlert2Asset::register($view);
        $this->assertEquals(1, count($view->assetBundles));
        $this->assertTrue($view->assetBundles['dominus77\\sweetalert2\\assets\\SweetAlert2Asset'] instanceof AssetBundle);
        $content = $view->renderFile('@tests/views/layouts/rawlayout.php');
        $this->assertContains('sweetalert2' . $min . '.css', $content);
        $this->assertContains('sweetalert2' . $min . '.js', $content);
    }
}