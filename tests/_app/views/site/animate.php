<?php

use dominus77\sweetalert2\Alert;

$this->title = "A basic message"
?>

<?= Alert::widget([
    'options' => [
        'title' => 'jQuery HTML example',
        'html' => new \yii\web\JsExpression("$('<div>').addClass('some-class').text('jQuery is everywhere.')"),
        'animation' => false,
        'customClass' => 'animated jello', // https://daneden.github.io/animate.css/
    ],
]) ?>
