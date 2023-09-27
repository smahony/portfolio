<?php

namespace Step\Webdriver\Checkout;

class AmazonPay extends \WebDriverTester
{
    public $amazonPaySignInForm = '//form[@name=\'signIn\']';

    public $stripePayButton = '//button[contains(text(),\'Pay\')]';

    /**
     * AmazonPay Address Book
     */
    public $continueToPaymentButton = '//button[contains(text(),\'Continue to payment\')]';
    public $backButton = '//*[@id="body"]/div/div/div[1]/div[5]/div/ul/li[1]/a';
    public $forwardButton = '//a[contains(text(),\'next\')]';

    public $alaskaAddress = '//*[@id="body"]/div/div/div[1]/div[3]/div[2]/ul/li[1]/a';
    public $californiaAddress = '//*[@id="body"]/div/div/div[1]/div[3]/div[2]/ul/li[3]/a';
    public $franceAddress =  '//*[@id="body"]/div/div/div[1]/div[3]/div[2]/ul/li[2]/a';
    public $guamAddress = '//*[@id="body"]/div/div/div[1]/div[3]/div[2]/ul/li[1]/a';
    public $hawaiiAddress = '//*[@id="body"]/div/div/div[1]/div[3]/div[2]/ul/li[3]/a';
    public $puertoRicoAddress = '//*[@id="body"]/div/div/div[1]/div[3]/div[2]/ul/li[2]/a';

    /**
     * AmazonPay Credit Card
     */
    public $invalidCreditCard = '//*[@id="body"]/div[1]/div/div[1]/div[3]/div[2]/ul/li[1]/a/span';

    public function amazonLogin()
    {
        $I = $this;
        $I->switchToWindow('amazonloginpopup');
        $I->waitForElementVisible($this->amazonPaySignInForm);
        $I->fillField('email', 'mahony.s.tutoring+amazonpaytest@gmail.com');
        $I->fillField('password', 'samtester5000');
        $I->click('//input[@id=\'signInSubmit\']');
        $I->wait(5);
        $I->switchToWindow();
    }

    public function selectInvalidCreditCard()
    {
        $I = $this;
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->click($this->californiaAddress);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
        $I->wait(5);
        $I->switchToNextTab();
        $I->switchToIFrame('#OffAmazonPaymentsWidgets2IFrame');
        $I->wait(3);
        $I->click($this->forwardButton);
        $I->wait(3);
        $I->click($this->invalidCreditCard);
        $I->wait(3);
        $I->switchToWindow();
    }

    // @todo Consolidate select invalid shipping destinations into array

    public function selectAlaska()
    {
        $I = $this;
        $I->switchToWindow();
        $I->wait(3);
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->click($this->forwardButton);
        $I->click($this->forwardButton);
        $I->wait(3);
        $I->click($this->alaskaAddress);
        $I->wait(2);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
    }

    public function selectCalifornia()
    {
        $I = $this;
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->switchToNextTab();
        $I->wait(3);
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->wait(3);
        $I->click($this->californiaAddress);
        $I->wait(3);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
        $I->wait(3);
    }

    public function selectFrance()
    {
        $I = $this;
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->switchToNextTab();
        $I->wait(3);
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->click($this->backButton);
        $I->wait(3);
        $I->click($this->franceAddress);
        $I->wait(3);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
        $I->wait(3);
    }

    public function selectGuam()
    {
        $I = $this;
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->switchToNextTab();
        $I->wait(3);
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->wait(3);
        $I->click($this->guamAddress);
        $I->wait(3);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
        $I->wait(3);
    }

    public function selectHawaii()
    {
        $I = $this;
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->switchToNextTab();
        $I->wait(3);
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->wait(3);
        $I->click($this->hawaiiAddress);
        $I->wait(3);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
        $I->wait(3);
    }

    public function selectPuertoRico()
    {
        $I = $this;
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->switchToNextTab();
        $I->wait(3);
        $I->switchToIFrame('#OffAmazonPaymentsWidgets1IFrame');
        $I->click($this->backButton);
        $I->wait(3);
        $I->click($this->puertoRicoAddress);
        $I->wait(3);
        $I->switchToFrame();
        $I->wait(3);
        $I->click($this->continueToPaymentButton);
        $I->wait(3);
    }

    public function completeStripeForm()
    {
        $I = $this;
        $I->switchToWindow();
        $I->waitForElementVisible('//div[@id=\'stripe-checkout-modal-body\']');
        $I->fillField('//input[@id=\'phone\']', '5555555555');
        $I->wait(2);
        $I->click($this->stripePayButton);
    }

}
