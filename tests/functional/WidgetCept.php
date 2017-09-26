<?php

/**
 * @var $scenario Codeception\Scenario
 */

$I = new FunctionalTester($scenario);

$I->amOnRoute('/site/index');
$I->see('"type":"success","text":"Congratulations!"');

$I->amOnRoute('site/basic');
$I->see('Any fool can use a computer');

$I->amOnRoute('site/title');
$I->see('The Internet?');
$I->see('That thing is still around?');