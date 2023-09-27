<?php


/**
 * @group signUp
 */

class SignUpCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public function signUpPasswordsDontMatch(
        WebDriverTester $I,
        \Page\Webdriver\SignUp $signUp
    )
    {
        $time = time();
        $emailID = strftime($time);
        $signUp->signUp('Registration', 'Tester', 'registration'.$emailID.'@test.com', 'registration5000', 'mismatch5000');
        $I->seeElement('//div[contains(text(),\'Password does not match confirmation!\')]');
    }

    public function signUpWithoutIAm(
        WebDriverTester $I,
        \Page\Webdriver\SignUp $signUp
    )
    {
        $time = time();
        $emailID = strftime($time);
        $signUp->signUpWithoutIAm('Registration', 'Tester', 'registration'.$emailID.'@test.com', 'registration5000', 'registration5000');
        $I->seeElement('//div[contains(text(),\'This field is required\')]');
        $I->seeElement('//div[contains(text(),"Some required fields haven\'t been completed or have validation errors. These fields have been highlighted in red for you.")]');
    }

    public function signUpWithoutDueDate(
        WebDriverTester $I,
        \Page\Webdriver\SignUp $signUp
    )
    {
        $time = time();
        $emailID = strftime($time);
        $signUp->signUpWithoutDueDate('Registration', 'Tester', 'registration'.$emailID.'@test.com', 'registration5000', 'registration5000');
        $I->seeElement('//div[contains(text(),\'Please select due date\')]');
        $I->seeElement('//div[contains(text(),"Some required fields haven\'t been completed or have validation errors. These fields have been highlighted in red for you.")]');
    }

    public function signUp(
        WebDriverTester $I,
        \Page\Webdriver\SignUp $signUp
    )
    {
        $time = time();
        $emailID = strftime($time);
        $signUp->signUp('Registration', 'Tester', 'registration'.$emailID.'@test.com', 'registration5000', 'registration5000');
        $I->seeElement('//h1[contains(@class,\'hidden-xs my-account-title\')]');
    }

    public function registrySignUp(
        WebDriverTester $I,
        \Page\Webdriver\SignUp $signUp
    )
    {
        $I->amOnPage('/baby-registry');
        $I->click('//a[contains(text(),\'create registry\')]');
        $time = time();
        $emailID = strftime($time);
        $signUp->signUp('Registry', 'Signup', 'registry'.$emailID.'@signup.com', 'registry5000', 'registry5000');
    }
}