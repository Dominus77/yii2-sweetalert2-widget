<?php

use dominus77\sweetalert2\Alert;

$this->title = "A title with a text under"
?>

<?= Alert::widget([
    'options' => [
        'The Internet?',
        'That thing is still around?',
        Alert::TYPE_QUESTION
    ]
]) ?>
