<?php


namespace Page\Webdriver;


class Login
{
    public static $URL = '/my-account';

    public $usernameField = '//div[@class=\'checkout-user__registered login-user-div\']//input[@name=\'username\']';
    public $passwordField = '//div[@class=\'checkout-user__registered login-user-div\']//input[@name=\'password\']';
    public $loginButton = '//div[@class=\'checkout-user__registered login-user-div\']//input[@name=\'login\']';

    /**
     * @var WebDriverTester
     */
    protected $tester;

    // we inject WebDriverTester into our class
    public function __construct(\WebDriverTester $I)
    {
        $this->tester = $I;
    }

    public function login($name, $password)
    {
        $I = $this->tester;

        $I->amOnPage(self::$URL);
        $I->scrollTo('.login-page-div', 0, 20);
        $I->fillField($this->usernameField, $name);
        $I->fillField($this->passwordField, $password);
        $I->wait(3);
        $I->moveMouseOver($this->loginButton);
        $I->click($this->loginButton);
        $I->seeElement('/html/body/main/div/article/div[2]/div/div[2]/div[2]/div[1]/h1');
    }
}
