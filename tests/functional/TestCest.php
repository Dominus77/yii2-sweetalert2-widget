<?php

/**
 * Class TestCest
 */
class TestCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function BaseTest(FunctionalTester $I)
    {
        $I->amOnRoute('/site/index');
        $I->see('swal.queue([{"type":"success","text":"Congratulations!"}]);');
    }

    public function BasicTest(FunctionalTester $I)
    {
        $I->amOnRoute('/site/basic');
        $I->see('Any fool can use a computer');
    }

    public function AnimateTest(FunctionalTester $I)
    {
        $I->amOnRoute('/site/animate');
        $I->see('jQuery HTML example');
    }
}
