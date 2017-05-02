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

Once the extension is installed, simply use it in your code by  :

Flash message
----
View:
```php
<?= \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
```

Controller:
```php
Yii::$app->session->setFlash('success', 'Congratulations!');
```

Render Widget
----
View:
```php
use dominus77\sweetalert2\Alert;
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
        'question'
    ]
]); ?>
```
A success message!
```php
<?= Alert::widget([
    'options' => [
        'Good job!',
        'You clicked the button!',
        'success'
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
jQuery HTML with custom animation
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

Further Information
-----
Please, check the [SweetAlert2](https://limonte.github.io/sweetalert2/)
License
-----
The BSD License (BSD). Please see [License File](https://github.com/Dominus77/yii2-sweetalert2-widget/blob/master/LICENSE.md) for more information.