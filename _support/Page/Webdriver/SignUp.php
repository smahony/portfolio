<?php


namespace Page\Webdriver;


class SignUp
{
    public static $URL = '/my-account';

    public $firstNameField = '//div[@class=\'checkout-user__registered create-user-div\']//input[@name=\'first_name\']';
    public $lastNameField = '//div[@class=\'checkout-user__registered create-user-div\']//input[@name=\'last_name\']';
    public $emailAddressField = '//div[@class=\'checkout-user__registered create-user-div\']//input[@name=\'username\']';
    public $passwordField = '//div[@class=\'checkout-user__registered create-user-div\']//input[@name=\'password\']';
    public $confirmPasswordField = '//div[@class=\'checkout-user__registered create-user-div\']//input[@name=\'password_2\']';

    public $expectingCheckbox = '//input[@id=\'preparing-expecting-checkbox\']';

    public $shopForBirthdayField = '/html/body/main/div/article/div/div/div/div/div/div[2]/div[2]/div/form/div[1]/div[6]/div[3]/div[1]/div/div[1]/input';

    public $createAccountButton = '//div[@class=\'checkout-user__registered create-user-div\']//input[@name=\'login\']';


    /**
     * @var WebDriverTester
     */
    protected $tester;

    // we inject WebDriverTester into our class
    public function __construct(\WebDriverTester $I)
    {
        $this->tester = $I;
    }

    public function signUp($firstName, $lastName, $emailAddress, $password, $confirmPassword)
    {
        $I = $this->tester;

        $I->amOnPage(self::$URL);
        $I->scrollTo('.login-page-div', 0, 20);
        $I->fillField($this->firstNameField, $firstName);
        $I->fillField($this->lastNameField, $lastName);
        $I->fillField($this->emailAddressField, $emailAddress);
        $I->fillField($this->passwordField, $password);
        $I->fillField($this->confirmPasswordField, $confirmPassword);

        $I->click($this->expectingCheckbox);
        $I->fillField('//input[@id=\'due_date_mobile\']', '03/20/21');

        $I->fillField($this->shopForBirthdayField, '09/20/20');
        $I->click('//*[@id="tots-fields-0"]/div[2]/div/div[2]/label[4]/input');

        $I->click($this->createAccountButton);
    }

    public function signUpWithoutIAm($firstName, $lastName, $emailAddress, $password, $confirmPassword)
    {
        $I = $this->tester;

        $I->amOnPage(self::$URL);
        $I->scrollTo('.login-page-div', 0, 20);
        $I->fillField($this->firstNameField, $firstName);
        $I->fillField($this->lastNameField, $lastName);
        $I->fillField($this->emailAddressField, $emailAddress);
        $I->fillField($this->passwordField, $password);
        $I->fillField($this->confirmPasswordField, $confirmPassword);

        $I->scrollTo($this->emailAddressField);
        $I->fillField($this->shopForBirthdayField, '09/20/20');
        $I->click('//*[@id="tots-fields-0"]/div[2]/div/div[2]/label[4]/input');

        $I->click($this->createAccountButton);
    }

    public function signUpWithoutDueDate($firstName, $lastName, $emailAddress, $password, $confirmPassword)
    {
        $I = $this->tester;

        $I->amOnPage(self::$URL);
        $I->scrollTo('.login-page-div', 0, 20);
        $I->fillField($this->firstNameField, $firstName);
        $I->fillField($this->lastNameField, $lastName);
        $I->fillField($this->emailAddressField, $emailAddress);
        $I->fillField($this->passwordField, $password);
        $I->fillField($this->confirmPasswordField, $confirmPassword);

        $I->scrollTo($this->emailAddressField);
        $I->fillField($this->shopForBirthdayField, '09/20/20');
        $I->click('//*[@id="tots-fields-0"]/div[2]/div/div[2]/label[4]/input');

        $I->click($this->expectingCheckbox);

        $I->click($this->createAccountButton);
    }
}