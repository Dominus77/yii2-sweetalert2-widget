<?php

namespace tests;

use dominus77\sweetalert2\Alert;
use yii\helpers\Json;

/**
 * Class AlertTest
 * @package tests
 */
class AlertTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function testGetOptions()
    {
        $alert = new Alert();
        $alert->options = [
            'id' => 'test_id',
            'Any fool can use a computer'
        ];
        $this->assertJson(Json::encode($alert->options), $alert->getOptions());
    }
    /**
     * @throws \Exception
     */
    public function testRegisterSwalQueue()
    {
        \Yii::$app->session->setFlash('success', 'Your message');
        $alert = Alert::widget(['useSessionFlash' => true]);
        $this->assertContains('', $alert);
    }
    /**
     * @throws \Exception
     */
    public function testRunFlash()
    {
        \Yii::$app->session->setFlash('success', [
            [
                'title' => 'Your title',
                'message' => 'Your message',
                'animation' => false,
                'customClass' => 'animated jello',
            ]
        ]);
        $alert = Alert::widget(['useSessionFlash' => true]);
        $this->assertContains('', $alert);
    }
    /**
     * @throws \Exception
     */
    public function testRegisterSwal()
    {
        $alert = Alert::widget([
            'options' => [
                'title' => 'Your title',
                'message' => 'Your message',
                'animation' => false,
                'customClass' => 'animated jello', // https://daneden.github.io/animate.css/
            ],
        ]);
        $this->assertContains('', $alert);
    }
}
