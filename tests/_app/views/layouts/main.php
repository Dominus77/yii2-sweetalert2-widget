<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= mb_substr(Yii::$app->language, 0, strrpos(Yii::$app->language, '-')); ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->name . ' | ' . Html::encode($this->title) ?></title>
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