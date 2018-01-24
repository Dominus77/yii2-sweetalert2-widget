# yii2-sweetalert2-widget

[![Latest Version](https://poser.pugx.org/dominus77/yii2-sweetalert2-widget/v/stable)](https://packagist.org/packages/dominus77/yii2-sweetalert2-widget)
[![Software License](https://poser.pugx.org/dominus77/yii2-sweetalert2-widget/license)](https://github.com/Dominus77/yii2-sweetalert2-widget/blob/master/LICENSE.md)
[![Build Status](https://travis-ci.org/Dominus77/yii2-sweetalert2-widget.svg?branch=v1.3.4)](https://travis-ci.org/Dominus77/yii2-sweetalert2-widget)
[![codecov](https://codecov.io/gh/Dominus77/yii2-sweetalert2-widget/branch/master/graph/badge.svg)](https://codecov.io/gh/Dominus77/yii2-sweetalert2-widget)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dominus77/yii2-sweetalert2-widget/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dominus77/yii2-sweetalert2-widget/?branch=master)
[![Total Downloads](https://poser.pugx.org/dominus77/yii2-sweetalert2-widget/downloads)](https://packagist.org/packages/dominus77/yii2-sweetalert2-widget)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/acb4c440-45cc-4496-8287-6b477550ab30/mini.png)](https://insight.sensiolabs.com/projects/acb4c440-45cc-4496-8287-6b477550ab30)

Renders a [SweetAlert2](https://sweetalert2.github.io/) widget for Yii2.

![Logo SweetAlert2](swal2-logo.png)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require dominus77/yii2-sweetalert2-widget "*"
```

or add

```
"dominus77/yii2-sweetalert2-widget": "*"
```

to the require section of your `composer.json` file.

## Usage
Once the extension is installed, simply use it in your code by:

## Flash message

View:
```
<?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]) ?>
```

Controller:
```
<?php
 Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, 'Congratulations!');

```
also
```
<?php
 Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
    [
        'title' => 'Your title',
        'text' => 'Your message',
        'confirmButtonText' => 'Done!',
    ]
 ]);
```
or
```
<?php
Yii::$app->session->setFlash('', [
    [
        'title' => 'Auto close alert!',
        'text' => 'I will close in 2 seconds.',
        'timer' => 2000,
    ],
    [
        'callback' => new \yii\web\JsExpression("
            function (result) {
                if (result.dismiss === 'timer') {
                    console.log('I was closed by the timer')
                }
            }
        "),
    ],
]);
```

## Render Widget
View:
```
<?php
use dominus77\sweetalert2\Alert;
```

A basic message
```
<?= Alert::widget([
    'options' => [
        'Any fool can use a computer'
    ],
]) ?>
```

A title with a text under
```
<?= Alert::widget([
    'options' => [
        'The Internet?',
        'That thing is still around?',
        Alert::TYPE_QUESTION
    ]
]) ?>
```

A success message!
```
<?= Alert::widget([
    'options' => [
        'Good job!',
        'You clicked the button!',
        Alert::TYPE_SUCCESS
    ]
]) ?>
```

A message with auto close timer
```
<?= Alert::widget([
    'options' => [
        'title' => 'Auto close alert!',
        'text' => 'I will close in 2 seconds.',
        'timer' => 2000,
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if (result.dismiss === 'timer') {
                console.log('I was closed by the timer')
            }
        }
    "),
]) ?>
```

Custom HTML description and buttons
```
<?= Alert::widget([
    'options' => [
        'title' => '<i>HTML</i> <u>example</u>',
        'type' => Alert::TYPE_INFO,
        'html' => 'You can use <b>bold text</b>,'
            . '<a href="//github.com">links</a> '
            . 'and other HTML tags',
        'showCloseButton' => true,
        'showCancelButton' => true,
        'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> Great!',
        'cancelButtonText' => '<i class="fa fa-thumbs-down"></i>',
    ],
]) ?>
```

jQuery HTML with custom animation [Animate.css](https://daneden.github.io/animate.css)

Example:
```
<?= Alert::widget([
    'options' => [
        'title' => 'jQuery HTML example',
        'html' => new \yii\web\JsExpression("$('<div>').addClass('some-class').text('jQuery is everywhere.')"),
        'animation' => false,
        'customClass' => 'animated jello', // https://daneden.github.io/animate.css/
    ],
]) ?>
```

A warning message, with a function attached to the "Confirm"-button...
```
<?= Alert::widget([
    'options' => [
        'title' => 'Are you sure?',
        'text' => "You won't be able to revert this!",
        'type' => Alert::TYPE_WARNING,
        'showCancelButton' => true,
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
        'confirmButtonText' => 'Yes, delete it!',
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if(result.value === true){
                swal('Deleted!','Your file has been deleted.','success')
            }
        }
    "),
]) ?>
```

... and by passing a parameter, you can execute something else for "Cancel".
```
<?= Alert::widget([
    'options' => [
        'title' => 'Are you sure?',
        'text' => "You won't be able to revert this!",
        'type' => Alert::TYPE_WARNING,
        'showCancelButton' => true,
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
        'confirmButtonText' => 'Yes, delete it!',
        'cancelButtonText' => 'No, cancel!',
        'confirmButtonClass' => 'btn btn-success',
        'cancelButtonClass' => 'btn btn-danger',
        'buttonsStyling' => false,
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if(result.value) {
                swal('Deleted!','Your file has been deleted.','success')
            }
            if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        }
    "),
]) ?>
```

## Input Types Example

Text:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Input something',
        'input' => Alert::INPUT_TYPE_TEXT,
        'showCancelButton' => true,
        'inputValidator' => new \yii\web\JsExpression("
            function (value) {
                return new Promise(function (resolve) {
                    if (value) {
                        resolve()
                    } else {
                        resolve('You need to write something!')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if(result.value) {
                swal({
                    type: 'success',
                    html: 'You entered: ' + result.value
                })
            }
        }
    "),
]) ?>
```

Email:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Input email address',
        'input' => Alert::INPUT_TYPE_EMAIL,
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal({
                type: 'success',
                html: 'Entered email: ' + result.value
            })
        }
    "),
]) ?>
```

Password:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Enter your password',
        'input' => Alert::INPUT_TYPE_PASSWORD,
        'inputAttributes' => [
        'maxlength' => 10,
            'autocapitalize' => 'off',
            'autocorrect' => 'off',
        ]
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
          if (result.value) {
              swal({
                  type: 'success',
                  html: 'Entered password: ' + result.value
              })
          }
        }
   "),
]) ?>
```

Textarea:
```
<?= Alert::widget([
    'options' => [
        'input' => Alert::INPUT_TYPE_TEXTAREA,
        'showCancelButton' => true,
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if (result.value) {
                swal(result.value)
            }
        }
    "),
]) ?>
```

Select:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Select Russia',
        'input' => Alert::INPUT_TYPE_SELECT,
        'inputOptions' => [
            'SRB' => 'Serbia',
            'RUS' => 'Russia',
            'UKR' => 'Ukraine',
            'HRV' => 'Croatia',
        ],
        'inputPlaceholder' => 'Select country',
        'showCancelButton' => true,
        'inputValidator' => new \yii\web\JsExpression("
            function (value) {
                return new Promise(function (resolve) {
                    if (value === 'RUS') {
                        resolve()
                    } else {
                        resolve('You need to select Russia :)')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if (result.value) {
                swal({
                    type: 'success',
                    html: 'You selected: ' + result.value
                })
            }
        }
    "),
]) ?>
```

Radio:
```
<?php
$script = new \yii\web\JsExpression("
    // inputOptions can be an object or Promise
    var inputOptions = new Promise(function (resolve) {
        setTimeout(function () {
            resolve({
                '#ff0000': 'Red',
                '#00ff00': 'Green',
                '#0000ff': 'Blue'
            })
        }, 2000)
    })
");
$this->registerJs($script, \yii\web\View::POS_HEAD);

echo Alert::widget([
    'options' => [
        'title' => 'Select color',
        'input' => Alert::INPUT_TYPE_RADIO,
        'inputOptions' => new \yii\web\JsExpression("inputOptions"),
        'inputValidator' => new \yii\web\JsExpression("
            function (result) {
                return new Promise(function (resolve) {
                    if (result) {
                        resolve()
                    } else {
                        resolve('You need to select something!')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal({
                type: 'success',
                html: 'You selected: ' + result.value
            })
        }
    "),
]); ?>
```

Checkbox:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Terms and conditions',
        'input' => Alert::INPUT_TYPE_CHECKBOX,
        'inputValue' => 1,
        'inputPlaceholder' => 'I agree with the terms and conditions',
        'confirmButtonText' => 'Continue <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>',
        'inputValidator' => new \yii\web\JsExpression("
            function (result) {
                return new Promise(function (resolve) {
                    if (result) {
                        resolve()
                    } else {
                        resolve('You need to agree with T&C')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal({
                type: 'success',
                html: 'You agreed with T&C :' + result.value
            })
        }
    "),
]) ?>
```

File:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Select image',
        'input' => Alert::INPUT_TYPE_FILE,
        'inputAttributes' => [
            'accept' => 'image/*',
            'aria-label' => 'Upload your profile picture',
        ],
    ],
    'callback' => new \yii\web\JsExpression("
        function(result) {
            var reader = new FileReader
            reader.onload = function (e) {
                swal({
                    title: 'Your uploaded picture',
                    imageUrl: e.target.result,
                    imageAlt: 'The uploaded picture'
                })
            }
            reader.readAsDataURL(result.value)
        }
    "),
]) ?>
```

Range:
```
<?= Alert::widget([
    'options' => [
        'title' => 'How old are you?',
        'type' => Alert::TYPE_QUESTION,
        'input' => Alert::INPUT_TYPE_RANGE,
        'inputAttributes' => [
            'min' => 8,
            'max' => 120,
            'step' => 1,
        ],
        'inputValue' => 25,
    ]
]) ?>
```

Multiple inputs aren't supported, you can achieve them by using `html` and `preConfirm` parameters.
Inside the `preConfirm()` function you can pass the custom result to the `resolve()` function as a parameter:
```
<?= Alert::widget([
    'options' => [
        'title' => 'Multiple inputs',
        'html' => '<input id="swal-input1" class="swal2-input"> <input id="swal-input2" class="swal2-input">',
        'preConfirm' => new \yii\web\JsExpression("
            function () {
                return new Promise(function (resolve) {
                    resolve([
                        $('#swal-input1').val(),
                        $('#swal-input2').val()
                    ])
                })
            }
        "),
        'onOpen' => new \yii\web\JsExpression("
            function () {
                $('#swal-input1').focus()
            }
        "),
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal(JSON.stringify(result.value))
        }
    "),
]) ?>
```
Ajax request example
```
<?= Alert::widget([
    'options' => [
        'title' => 'Submit email to run ajax request',
        'input' => Alert::INPUT_TYPE_EMAIL,
        'showCancelButton' => true,
        'confirmButtonText' => 'Submit',
        'showLoaderOnConfirm' => true,
        'preConfirm' => new \yii\web\JsExpression("
            function (email) {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        if (email === 'taken@example.com') {
                            swal.showValidationError(
                                'This email is already taken.'
                            )
                        }
                        resolve()
                    }, 2000)
                })
            }
        "),
        'allowOutsideClick' => false,
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if (result.value) {
                swal({
                    type: 'success',
                    title: 'Ajax request finished!',
                    html: 'Submitted email: ' + result.value
                })
            }
        }
    "),
]) ?>
```

## Testing
```
$ phpunit
```

## More Information
Please, check the [SweetAlert2](https://sweetalert2.github.io/)

## License
The BSD License (BSD). Please see [License File](https://github.com/Dominus77/yii2-sweetalert2-widget/blob/master/LICENSE.md) for more information.

## Sensio Labs
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/acb4c440-45cc-4496-8287-6b477550ab30/big.png)](https://insight.sensiolabs.com/projects/acb4c440-45cc-4496-8287-6b477550ab30)
