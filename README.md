# yii2-sweetalert2-widget

[![Latest Version](https://poser.pugx.org/dominus77/yii2-sweetalert2-widget/v/stable)](https://packagist.org/packages/dominus77/yii2-sweetalert2-widget)
[![Software License](https://poser.pugx.org/dominus77/yii2-sweetalert2-widget/license)](https://github.com/Dominus77/yii2-sweetalert2-widget/blob/master/LICENSE.md)
[![Build Status](https://travis-ci.org/Dominus77/yii2-sweetalert2-widget.svg?branch=v1.3.4)](https://travis-ci.org/Dominus77/yii2-sweetalert2-widget)
[![codecov](https://codecov.io/gh/Dominus77/yii2-sweetalert2-widget/branch/master/graph/badge.svg)](https://codecov.io/gh/Dominus77/yii2-sweetalert2-widget)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Dominus77/yii2-sweetalert2-widget/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Dominus77/yii2-sweetalert2-widget/?branch=master)
[![Total Downloads](https://poser.pugx.org/dominus77/yii2-sweetalert2-widget/downloads)](https://packagist.org/packages/dominus77/yii2-sweetalert2-widget)

Renders a [SweetAlert2](https://sweetalert2.github.io/) widget for Yii2.

![Logo SweetAlert2](/swal2-logo.png)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
php composer.phar require dominus77/yii2-sweetalert2-widget "^2.0"
```

or add

```bash
"dominus77/yii2-sweetalert2-widget": "^2.0"
```

to the require section of your `composer.json` file.

## Usage
Once the extension is installed, simply use it in your code by:

## Flash message

View:
```php
<?php \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]); ?>
```

Controller:

A basic message
```php
Yii::$app->session->setFlash('message', 'Any fool can use a computer');

```
A title with a text under
```php
Yii::$app->session->setFlash(Alert::TYPE_QUESTION, [
    'title' => 'The Internet?',
    'text' => 'That thing is still around?',
]);
```
A modal with a title, an error icon, a text, and a footer
```php
Yii::$app->session->setFlash(Alert::TYPE_ERROR, [
    'title' => 'Oops...',
    'text' => 'Something went wrong!',
    'footer' => '<a href="">Why do I have this issue?</a>'
]);
```
A modal window with a long content inside:
```php
Yii::$app->session->setFlash('image1', [
    'imageUrl' => 'https://placeholder.pics/svg/300x1500',
    'imageHeight' => 1500,
    'imageAlt' => 'A tall image'
]);
```
Custom HTML description and buttons with ARIA labels
```php
Yii::$app->session->setFlash('customHtml', [
    'title' => '<strong>HTML <u>example</u></strong>',
    'icon' => Alert::TYPE_INFO,
    'html' => '
       You can use <b>bold text</b>, 
       <a href="//sweetalert2.github.io">links</a>
       and other HTML tags
     ',
    'showCloseButton' => true,
    'showCancelButton' => true,
    'focusConfirm' => false,
    'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> Great!',
    'confirmButtonAriaLabel' => 'Thumbs up, great!',
    'cancelButtonText' => '<i class="fa fa-thumbs-down"></i>',
    'cancelButtonAriaLabel' => 'Thumbs down',
]);
```
A dialog with three buttons
```php
Yii::$app->session->setFlash('dialog', [
    'title' => 'Do you want to save the changes?',
    'showDenyButton' => true,
    'showCancelButton' => true,
    'confirmButtonText' => 'Save',
    'denyButtonText' => "Don't save",
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success');
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
            }
        }
    ")
]);
```
A custom positioned dialog
```php
Yii::$app->session->setFlash('position', [
    'position' => 'top-end',
    'icon' => Alert::TYPE_SUCCESS,
    'title' => 'Your work has been saved',
    'showConfirmButton' => false,
    'timer' => 1500
]);
```
Custom animation with [Animate.css](https://animate.style/)

Set to View:
```php
<?php \dominus77\sweetalert2\Alert::widget([
    'useSessionFlash' => true,
    'customAnimate' => true
]); ?>
```
also
```php
Yii::$app->session->setFlash('customAnimate', [
    'title' => 'Custom animation with Animate.css',
    'showClass' => [
        'popup' => 'animate__animated animate__fadeInDown'
    ],
    'hideClass' => [
        'popup' => 'animate__animated animate__fadeOutUp'
    ],
]);
```
A confirm dialog, with a function attached to the "Confirm"-button
```php
Yii::$app->session->setFlash('confirm', [
    'title' => 'Are you sure?',
    'text' => "You won't be able to revert this!",
    'icon' => Alert::TYPE_WARNING,
    'showCancelButton' => true,
    'confirmButtonColor' => '#3085d6',
    'cancelButtonColor' => '#d33',
    'confirmButtonText' => 'Yes, delete it!',
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
            }
        }
    ")
]);
```
... and by passing a parameter, you can execute something else for "Cancel"
```php
Yii::$app->session->setFlash('confirm2', [
    'title' => 'Are you sure?',
    'text' => "You won't be able to revert this!",
    'icon' => Alert::TYPE_WARNING,
    'showCancelButton' => true,
    'confirmButtonText' => 'Yes, delete it!',
    'cancelButtonText' => 'No, cancel!',
    'reverseButtons' => true,
    'mixinOptions' => [
        'customClass' => [
            'confirmButton' => 'btn btn-success',
            'cancelButton' => 'btn btn-danger',
        ],
        'buttonsStyling' => false
    ],
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if (result.isConfirmed) {
                SwalQueue.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                SwalQueue.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        }
    ")
]);
```
A message with a custom image
```php
Yii::$app->session->setFlash('image', [
    'title' => 'Sweet!',
    'text' => 'Modal with a custom image.',
    'imageUrl' => 'https://unsplash.it/400/200',
    'imageWidth' => 400,
    'imageHeight' => 200,
    'imageAlt' => 'Custom image',
]);
```
A message with custom width, padding, background and animated Nyan Cat
```php
Yii::$app->session->setFlash('NyanCat', [
    'title' => 'Custom width, padding, color, background.',
    'width' => 600,
    'padding' => '3em',
    'color' => '#716add',
    'background' => '#fff url(/images/trees.png)',
    'backdrop' => "rgba(0,0,123,0.4) url('/images/nyan-cat.gif') left top no-repeat",
]);
```
A message with auto close timer
```php
Yii::$app->session->setFlash('key1', [
    'title' => 'Auto close alert!',
    'html' => 'I will close in <b></b> milliseconds.',
    'timer' => 2000,
    'timerProgressBar' => true,
    'didOpen' => new \yii\web\JsExpression("
        () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b');
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft();
            }, 100)
        }
    "),
    'willClose' => new \yii\web\JsExpression("
        () => {                            
            clearInterval(timerInterval);
        }
    "),
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer');
            }
        }
    "),
]);
```
Right-to-left support for Arabic, Persian, Hebrew, and other RTL languages
```php
Yii::$app->session->setFlash('rlt', [
    'title' => 'هل تريد الاستمرار؟',
    'icon' => Alert::TYPE_QUESTION,
    'iconHtml' => '؟',
    'confirmButtonText' => 'نعم',
    'cancelButtonText' => 'لا',
    'showCancelButton' => true,
    'showCloseButton' => true,
]);
```
AJAX request example
```php
Yii::$app->session->setFlash('ajax', [
    'title' => 'Submit your Github username',
    'input' => 'text',
    'inputAttributes' => [
        'autocapitalize' => 'off'
    ],
    'showCancelButton' => true,
    'confirmButtonText' => 'Look up',
    'showLoaderOnConfirm' => true,
    'backdrop' => true,
    'preConfirm' => new \yii\web\JsExpression("
        (login) => {
            return fetch('//api.github.com/users/' + login)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        'Request failed: ' + error
                    );
                })
        }
    "),
    'allowOutsideClick' => new \yii\web\JsExpression("
        () => !Swal.isLoading()
    "),
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: result.value.login + '\'s avatar',
                    imageUrl: result.value.avatar_url
                });
            }
        }
    ")
]);
```
Mixin example
```php
Yii::$app->session->setFlash('toast', [
    'icon' => Alert::TYPE_SUCCESS,
    'title' => 'Signed in successfully',
    'mixinOptions' => [
        'toast' => true,
        'position' => 'top-end',
        'showConfirmButton' => false,
        'timer' => 3000,
        'timerProgressBar' => true,
        'didOpen' => new \yii\web\JsExpression("
            (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        ")
    ],
]);
```
Multiple
```php
Yii::$app->session->setFlash('multiple', [
    'items' => [
        [
            'icon' => Alert::TYPE_WARNING,
            'title' => 'Your title 1',
            'text' => 'Your message 1',
            'confirmButtonText' => 'Done 1!',
        ],
        [
            'icon' => Alert::TYPE_SUCCESS,
            'title' => 'Your title 2',
            'text' => 'Your message 2',
            'confirmButtonText' => 'Done 2!',
        ]
    ]
]);
```
or
```php
Yii::$app->session->setFlash('multiple2', [
    'mixinOptions' => [
        'toast' => true,
        'position' => 'top-right',
        'showConfirmButton' => false,
        'timer' => 1500,
        'timerProgressBar' => true,
    ],
    'items' => [
        [

            'icon' => Alert::TYPE_INFO,
            'title' => 'Your title 1',
            'text' => 'Your message 1',
            'callback' => new \yii\web\JsExpression("
                (result) => {console.log('Close Your title 1')}
            "),
        ],
        [

            'icon' => Alert::TYPE_SUCCESS,
            'title' => 'Your title 2',
            'text' => 'Your message 2',
            'callback' => new \yii\web\JsExpression("
                (result) => {console.log('Close Your title 2')}
            "),
        ],
        [

            'icon' => Alert::TYPE_SUCCESS,
            'title' => 'Your title 3',
            'text' => 'Your message 3',
            'callback' => new \yii\web\JsExpression("
                (result) => {console.log('Close Your title 3')}
            "),
        ]
    ]
]);
```

## Render Widget
View:
```php
<?php
use dominus77\sweetalert2\Alert;
```

A basic message
```php
<?php Alert::widget([
    'options' => [
        'Any fool can use a computer'
    ],
]); ?>
```

A title with a text under
```php
<?php Alert::widget([
    'options' => [
        'The Internet?',
        'That thing is still around?',
        Alert::TYPE_QUESTION
    ]
]); ?>
```

A success message!
```php
<?php Alert::widget([
    'options' => [
        'Good job!',
        'You clicked the button!',
        Alert::TYPE_SUCCESS
    ]
]); ?>
```

A message with auto close timer
```php
<?php Alert::widget([
    'options' => [
        'title' => 'Auto close alert!',
        'text' => 'I will close in 2 seconds.',
        'timer' => 2000,
    ],
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if (result.dismiss === 'timer') {
                console.log('I was closed by the timer')
            }
        }
    "),
]); ?>
```

Custom HTML description and buttons
```php
<?php Alert::widget([
    'options' => [
        'title' => '<i>HTML</i> <u>example</u>',
        'icon' => Alert::TYPE_INFO,
        'html' => 'You can use <b>bold text</b>,'
            . '<a href="//github.com">links</a> '
            . 'and other HTML tags',
        'showCloseButton' => true,
        'showCancelButton' => true,
        'confirmButtonText' => '<i class="fa fa-thumbs-up"></i> Great!',
        'cancelButtonText' => '<i class="fa fa-thumbs-down"></i>',
    ]
]); ?>
```

Custom animation with [Animate.css](https://animate.style/)

Example:
```php
<?php Alert::widget([
    'customAnimate' => true,
    'options' => [
        'title' => 'Custom animation with Animate.css',
        'showClass' => [
            'popup' => 'animate__animated animate__fadeInDown'
        ],
        'hideClass' => [
            'popup' => 'animate__animated animate__fadeOutUp'
        ]
    ]
]); ?>
```

A warning message, with a function attached to the "Confirm"-button...
```php
<?php Alert::widget([
    'options' => [
        'title' => 'Are you sure?',
        'text' => "You won't be able to revert this!",
        'icon' => Alert::TYPE_WARNING,
        'showCancelButton' => true,
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
        'confirmButtonText' => 'Yes, delete it!',
    ],
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if(result.value === true){
                Swal.fire('Deleted!','Your file has been deleted.','success');
            }
        }
    "),
]); ?>
```

... and by passing a parameter, you can execute something else for "Cancel".
```php
<?php Alert::widget([
    'mixinOptions' => [
        'customClass' => [
            'confirmButton' => 'btn btn-success',
            'cancelButton' => 'btn btn-danger',
        ],
        'buttonsStyling' => false
    ],
    'options' => [
        'title' => 'Are you sure?',
        'text' => "You won't be able to revert this!",
        'icon' => Alert::TYPE_WARNING,
        'showCancelButton' => true,
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor' => '#d33',
        'confirmButtonText' => 'Yes, delete it!',
        'cancelButtonText' => 'No, cancel!',
    ],
    'callback' => new \yii\web\JsExpression("
        (result) => {
            if(result.value) {
                Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            }            
            if (result.dismiss === 'cancel') {
                Swal.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                );
            }
        }
    "),
]); ?>
```

## Theme
View:
```php
use dominus77\sweetalert2\assets\ThemeAsset;

/** @var yii\web\View $this */

ThemeAsset::register($this, ThemeAsset::THEME_DARK);
```

## Testing
```
$ ./vendor/bin/phpunit
```

## More Information
Please, check the [SweetAlert2](https://sweetalert2.github.io/)

## License
The MIT License (MIT). Please see [License File](https://github.com/Dominus77/yii2-sweetalert2-widget/blob/master/LICENSE.md) for more information.
