README
======
Renders a [SweetAlert2](https://limonte.github.io/sweetalert2/) widget for Yii2.

Installation
------------

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


Usage
-----

Once the extension is installed, simply use it in your code by:

Flash message 
----
View:
```php
<?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
```

Controller:
```php
...
 Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, 'Congratulations!');
...
```

Render Widget
----
View:
```php
use dominus77\sweetalert2\Alert;
...
```

A basic message
```php
<?= Alert::widget([
    'options' => [
        'Any fool can use a computer'
    ],
]); ?>
```
A title with a text under
```php
<?= Alert::widget([
    'options' => [
        'The Internet?',
        'That thing is still around?',
        Alert::TYPE_QUESTION
    ]
]); ?>
```
A success message!
```php
<?= Alert::widget([
    'options' => [
        'Good job!',
        'You clicked the button!',
        Alert::TYPE_SUCCESS
    ]
]); ?>
```
A message with auto close timer
```php
<?= Alert::widget([
    'options' => [
        'title' => 'Auto close alert!',
        'text' => 'I will close in 2 seconds.',
        'timer' => 2000,
    ],
    'callback' => new \yii\web\JsExpression("
        function () {},
        function (dismiss) {
            if (dismiss === 'timer') {
                console.log('I was closed by the timer')
            }
        }
    "),
]); ?>
```
Custom HTML description and buttons
```php
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
]); ?>
```

jQuery HTML with custom animation, requires installation [Animate.css](https://daneden.github.io/animate.css)

Either run:
```
php composer.phar require bower-asset/animate-css "*"
```
or add
```
"bower-asset/animate-css": "*"
```
to the require section of your `composer.json` file.

Example:
```php
<?= Alert::widget([
    'options' => [
        'title' => 'jQuery HTML example',
        'html' => new \yii\web\JsExpression("$('<div>').addClass('some-class').text('jQuery is everywhere.')"),
        'animation' => false,
        'customClass' => 'animated jello', // https://daneden.github.io/animate.css/
    ],
]); ?>
```

A warning message, with a function attached to the "Confirm"-button...
```php
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
        function () {
            swal('Deleted!','Your file has been deleted.','success')
        }
    "),
]); ?>
```
... and by passing a parameter, you can execute something else for "Cancel".
```php
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
        function () {
            swal('Deleted!','Your file has been deleted.','success')
        }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        }
    "),
]); ?>
```

Input Types Example
----
Text:
```php
<?= Alert::widget([
    'options' => [
        'title' => 'Input something',
        'input' => Alert::INPUT_TYPE_TEXT,
        'showCancelButton' => true,
        'inputValidator' => new \yii\web\JsExpression("
            function (value) {
                return new Promise(function (resolve, reject) {
                    if (value) {
                        resolve()
                    } else {
                        reject('You need to write something!')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal({
                type: 'success',
                html: 'You entered: ' + result
            })
        }
    "),
]); ?>
```

Email:
```php
<?= Alert::widget([
    'options' => [
        'title' => 'Input email address',
        'input' => Alert::INPUT_TYPE_EMAIL,
    ],
    'callback' => new \yii\web\JsExpression("
        function (email) {
            swal({
                type: 'success',
                html: 'Entered email: ' + email
            })
        }
    "),
]); ?>
```

Password:
```php
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
        function (password) {
          if (password) {
              swal({
                  type: 'success',
                  html: 'Entered password: ' + password
              })
          }
        }
   "),
]); ?>
```

Textarea:
```php
<?= Alert::widget([
    'options' => [
        'input' => Alert::INPUT_TYPE_TEXTAREA,
        'showCancelButton' => true,
    ],
    'callback' => new \yii\web\JsExpression("
        function (text) {
            if (text) {
                swal(text)
            }
        }
    "),
]); ?>
```

Select:
```php
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
                return new Promise(function (resolve, reject) {
                    if (value === 'RUS') {
                        resolve()
                    } else {
                        reject('You need to select Russia :)')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            if (result) {
                swal({
                    type: 'success',
                    html: 'You selected: ' + result
                })
            }
        }
    "),
]); ?>
```

Radio:
```php
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
                return new Promise(function (resolve, reject) {
                    if (result) {
                        resolve()
                    } else {
                        reject('You need to select something!')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal({
                type: 'success',
                html: 'You selected: ' + result
            })
        }
    "),
]);
?>
```

Checkbox:
```php
<?= Alert::widget([
    'options' => [
        'title' => 'Terms and conditions',
        'input' => Alert::INPUT_TYPE_CHECKBOX,
        'inputValue' => 1,
        'inputPlaceholder' => 'I agree with the terms and conditions',
        'confirmButtonText' => 'Continue <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>',
        'inputValidator' => new \yii\web\JsExpression("
            function (result) {
                return new Promise(function (resolve, reject) {
                    if (result) {
                        resolve()
                    } else {
                        reject('You need to agree with T&C')
                    }
                })
            }
        ")
    ],
    'callback' => new \yii\web\JsExpression("
        function (result) {
            swal({
                type: 'success',
                html: 'You agreed with T&C :' + result
            })
        }
    "),
]); ?>
```

File:
```php
<?= Alert::widget([
    'options' => [
        'title' => 'Select image',
        'input' => Alert::INPUT_TYPE_FILE,
        'inputAttributes' => [
            'accept' => 'image/*',
        ],
    ],
    'callback' => new \yii\web\JsExpression("
        function (file) {
            var reader = new FileReader
            reader.onload = function (e) {
                swal({
                    imageUrl: e.target.result
                })
            }
            reader.readAsDataURL(file)
        }
    "),
]); ?>
```

Range:
```php
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
]); ?>
```

Multiple inputs aren't supported, you can achieve them by using `html` and `preConfirm` parameters.
Inside the `preConfirm()` function you can pass the custom result to the `resolve()` function as a parameter:
```php
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
            swal(JSON.stringify(result))
        }
    "),
]); ?>
```

More Information
-----
Please, check the [SweetAlert2](https://limonte.github.io/sweetalert2/)

License
-----
The BSD License (BSD). Please see [License File](https://github.com/Dominus77/yii2-sweetalert2-widget/blob/master/LICENSE.md) for more information.