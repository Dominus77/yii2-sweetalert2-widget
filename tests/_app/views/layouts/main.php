<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]) ?>

    <?= $content; ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>