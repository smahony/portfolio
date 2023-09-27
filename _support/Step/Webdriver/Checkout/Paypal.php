<?php

namespace Step\Webdriver\Checkout;

class Paypal extends \WebDriverTester
{
    public $changeAddress = '//*[@id="change-shipping"]';

    public $alaskaAddress = 'Test Test - 600 E Benson Blvd, Anchorage, AK 99503';
    public $australiaAddress = 'John Doe Test - 123 Nerang Street, Southport QLD 4215';
    public $guamAddress = 'Test Test - 1227 Pale San Vitores Rd, Tamuning, GU 96913';
    public $hawaiiAddress = 'Test Test - 175 Paoakalani Avenue, Honolulu, HI 96815';
    public $puertoRicoAddress = 'SJ Airport - Av. Aeropuerto, Carolina, PR 00979';

    public $errorMessageCannotShipToDestination = '//*[@id="hermione-container"]/div/main/div[1]/div/div/span[2]/p';

    public function paypalLogin()
    {
        $I = $this;
        $I->wait(15);
        //$I->waitForText('PayPal Guest Checkout', 60);
//        $I->click('.baslLoginButtonContainer');
//        $I->waitForElementVisible('//*[@id="loginSection"]');
//        $I->wait(5);
        $I->fillField('login_email', 'sb-tneug1933680@personal.example.com');
        $I->click('//button[@id=\'btnNext\']');
        $I->waitForElementVisible('//input[@id=\'password\']');
        $I->fillField('login_password', 'Sw0)p}$s');
        $I->click('//button[@id=\'btnLogin\']');
        $I->wait(10);
    }

    // @todo Consolidate select invalid shipping destinations into array

    public function selectAlaska()
    {
        $I = $this;
        $I->click($this->changeAddress);
        $I->wait(5);
        $I->selectOption('//*[@id="shippingDropdown"]', $this->alaskaAddress);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination, 5);
        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination);
    }

    public function selectAustralia()
    {
        $I = $this;
        $I->scrollTo($this->changeAddress);
        $I->wait(5);
        $I->click($this->changeAddress);
        $I->selectOption('//*[@id="shippingDropdown"]', $this->australiaAddress);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination, 5);
        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination);
    }

    public function selectGuam()
    {
        $I = $this;
        $I->scrollTo($this->changeAddress);
        $I->wait(5);
        $I->click($this->changeAddress);
        $I->selectOption('//*[@id="shippingDropdown"]', $this->guamAddress);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination, 5);
        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination);
    }

    public function selectHawaii()
    {
        $I = $this;
        $I->scrollTo($this->changeAddress);
        $I->wait(5);
        $I->click($this->changeAddress);
        $I->selectOption('//*[@id="shippingDropdown"]', $this->hawaiiAddress);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination, 5);
        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(5);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination);
    }

    public function selectPuertoRico()
    {
        $I = $this;
        $I->scrollTo($this->changeAddress);
        $I->wait(5);
        $I->click($this->changeAddress);
        $I->selectOption('//*[@id="shippingDropdown"]', $this->puertoRicoAddress);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination, 5);
        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(5);
        $I->waitForElementVisible($this->errorMessageCannotShipToDestination);
    }
}
