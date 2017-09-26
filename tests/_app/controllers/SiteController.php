<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use dominus77\sweetalert2\Alert;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->session->setFlash(Alert::TYPE_SUCCESS, 'Congratulations!');
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionBasic()
    {
        return $this->render('basic');
    }

    /**
     * @return string
     */
    public function actionTitle()
    {
        return $this->render('title');
    }
}