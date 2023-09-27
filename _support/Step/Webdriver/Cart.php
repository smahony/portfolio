<?php

namespace Step\Webdriver;

use function GuzzleHttp\Psr7\str;

class Cart extends \WebDriverTester
{
    const TIMEOUT = 60;

    public $checkoutButton = '/html/body/main/div/article/div/div/form/div[3]/section[2]/div[2]/div[2]/div/div[5]/a[1]';
    public $internationalCheckoutButton = '/html/body/main/div/article/div/div/form/div[3]/section[2]/div[2]/div[2]/div/div[4]/a';
    public $registryCheckoutButton = '/html/body/main/div/article/div/div/form/div[2]/section[2]/div[2]/div[2]/div/div[4]/a[1]';
    public $url = '/cart';
    public $stripeForm = '//div[@id=\'stripe-checkout-modal-body\']';
    public $couponCodeField = '//input[@id=\'coupon_code\']';
    public $applyCouponButton = '//button[@name=\'apply_coupon\']';
    public $removeCouponLink = '//a[contains(text(),\'[Remove]\')]';

    public $cartGiftMessageCheckbox = '/html/body/main/div/article/div/div/div[4]/div/div/div/div[2]/form/div[1]/label/span';
    public $cartGiftBoxCheckbox = '/html/body/main/div/article/div/div/div[4]/div/div/div/div[2]/form/div[3]/label/span';
    public $checkoutGiftBoxCheckbox = '//form[@id=\'payment-form\']//input[@id=\'gift_message_box\']';
    public $giftWrapUnavailableMessage = '//p[contains(text(),\'*Gift wrapping not available\')]';

    public $payPalCheckoutButton = '//div[@id=\'paypal-button-container\']';

    public $amazonPayCheckoutButton = '//*[@id="OffAmazonPaymentsWidgets0"]';
    public $amazonPaySignInForm = '//form[@id=\'ap_signin_form\']';

    public $klarnaCheckoutButton = '//*[@id="klarna-cart-button"]';

    public function clickInternationalCheckout()
    {
        $I = $this;
        $I->click($this->internationalCheckoutButton);
        $I->waitForElementVisible('.checkout-page__title');
    }

    public function clickStripe()
    {
        $I = $this;
        $I->waitForElementVisible($this->checkoutButton);
        $I->click($this->checkoutButton);
        $I->waitForElementVisible($this->stripeForm, self::TIMEOUT);
        $I->wait(1);
    }

    public function clickRegistryStripe()
    {
        $I = $this;
        $I->waitForElementVisible($this->registryCheckoutButton);
        $I->click($this->registryCheckoutButton);
        $I->waitForElementVisible($this->stripeForm, self::TIMEOUT);
        $I->wait(1);
    }

    public function clickPaypalButton()
    {
        $I = $this;
        $I->waitForElementVisible($this->payPalCheckoutButton);
        $I->wait(5);
        $I->click($this->payPalCheckoutButton);
        $I->wait(10);
        $I->click($this->payPalCheckoutButton);
        $I->wait(10);
        $I->switchToNextTab();
    }

    public function clickAmazonPay()
    {
        $I = $this;
        //$I->wait(10);
        $I->waitForElementVisible($this->amazonPayCheckoutButton);
        $I->click($this->amazonPayCheckoutButton);
        $I->wait(5);
    }

    public function clickKlarna()
    {
        $I = $this;
        $I->waitForElementVisible($this->klarnaCheckoutButton);
        $I->click($this->klarnaCheckoutButton);
        $I->waitForElementVisible($this->stripeForm, self::TIMEOUT);
        $I->wait(1);
    }

    public function giftWrapUnavailableMessageInCart()
    {
        $I = $this;
        $I->wait(5);
        $I->moveMouseOver($this->giftWrapUnavailableMessage);
        $I->seeElement($this->giftWrapUnavailableMessage);
    }

    public function addGiftMessageOnly()
    {
        $I = $this;
        $I->fillField('gift_message_text', 'This crib cannot be gift wrapped');
        $I->wait(3);
        $I->dontSeeElement($this->cartGiftBoxCheckbox);
        $I->wait(3);
        $I->click('.update-cart');
        $I->wait(3);
    }

    public function noGiftWrapCheckboxAtCribCheckout()
    {
        $I = $this;
        $I->click('//form[@id=\'payment-form\']//a[contains(text(),\'Add Gift options\')]');
        $I->wait(3);
        $I->dontSeeElement($this->checkoutGiftBoxCheckbox);
    }

    public function addGiftOptionsFromCart()
    {
        $I = $this;
        $I->click('/html/body/main/div/article/div/div/form/div[3]/section[2]/div[2]/div[2]/div/div[4]/a');
        $I->wait(3);
        $I->click($this->cartGiftMessageCheckbox);
        $I->wait(3);
        $I->fillField('//*[@id="gift-message-text"]', 'This is a test gift message from cart');
        $I->wait(3);
        $I->click($this->cartGiftBoxCheckbox);
        $I->wait(3);
        $I->click('SAVE');
        $I->waitForText('$5.00', null, '.fee .value');
        $I->wait(5);
    }

    public function addGiftMessageFromCheckout()
    {
        $I = $this;
        $I->click('//form[@id=\'payment-form\']/section[3]/h2/a[contains(text(),\'Add Gift options\')]');
        $I->wait(5);
        $I->fillField('//form[@id=\'payment-form\']//section//fieldset//div//div//textarea[@id=\'gift_message_text\']', 'This is a test gift message from checkout');
        $I->wait(3);
    }

    public function addGiftBoxFromCheckout()
    {
        $I = $this;
        $I->switchToFrame();
        $I->click($this->checkoutGiftBoxCheckbox);
        $I->waitForText('$5.00', null, '.fee .value');
        $I->wait(3);
    }

    public function selectShipToRegistrantAddress()
    {
        $I = $this;
        $I->click($this->checkoutButton);
    }

    public function fillContactDetails()
    {
        $I = $this;

        /**
         * Contact Information
         */
        $I->fillField('//input[@id=\'name\']', 'Test Test');
        $I->fillField('//input[@id=\'email\']', 'test@test.com');
        $phoneNumber = strval(random_int(8182000000, 8189999999));
        $I->fillField('//input[@id=\'phone\']', $phoneNumber);

    }

    public function fillEmptyContactDetails()
    {
        $I = $this;

        /**
         * Contact Information
         */
        $I->fillField('//input[@id=\'name\']', '');
        $I->fillField('//input[@id=\'email\']', '');
        $I->fillField('//input[@id=\'phone\']', '');

    }

    public function fillShippingDetails(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    ) {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->click('//*[@id="country"]');
    }

    public function fillEmptyShippingDetails(
        $shippingName = '',
        $shippingAddress1 = '',
        $shippingAddressCity = '',
        $shippingAddressState = '',
        $shippingAddressPostcode = ''
    ) {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->click('//*[@id="country"]');
    }

    public function fillShippingDetailsTX(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }


    public function fillShippingDetailsNJ(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsDC(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsFL(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsGA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsIL(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsIN(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsKS(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsLA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsME(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsMD(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsMA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsMI(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsMN(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsNC(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsOH(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsPA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsVA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(3);
    }

    public function fillShippingDetailsNV(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
    }

    public function fillShippingDetailsAZ(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
    }

    public function fillShippingDetailsVT(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
    }

    public function fillShippingDetailsWI(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
    }

    public function fillShippingDetailsCA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsCO(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsCT(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsTN(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsSC(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsUT(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsWA(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsNE(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
        $I->wait(10);
    }

    public function fillShippingDetailsNY(
        $shippingName = 'Test Test',
        $shippingAddress1 = '950 Mason St',
        $shippingAddressCity = 'San Francisco',
        $shippingAddressState = 'CA',
        $shippingAddressPostcode = '94108'
    )
    {
        $I = $this;

        /**
         * Shipping Information
         */
        $I->fillField('//input[@id=\'stripe_name\']', $shippingName);
        $I->fillField('//input[@id=\'stripe_address_address_1\']', $shippingAddress1);
        $I->fillField('//input[@id=\'stripe_address_city\']', $shippingAddressCity);
        $I->wait(3);
        $I->selectOption('stripe_address_state', $shippingAddressState);
        $I->wait(3);
        $I->fillField('//input[@id=\'stripe_address_postcode\']', $shippingAddressPostcode);
    }

    public function fillCreditCardAndPayDetails()
    {
        $I = $this;

        /**
         * Payment Information
         */
        $I->switchToIFrame("#card-element iframe");
        $I->wait(2);
        // slowing down the filling of credit fields so stripe js can format it correctly
        for ($i = 0; $i < 8; $i++) {
            $I->appendField('cardnumber', '42');
            $I->wait(0.4);
        }

        $I->fillField('exp-date', '1025');
        $I->wait(0.5);
        $I->fillField('cvc', '123');
        $I->fillField('postal', '94108');
        $I->switchToNextTab();
        $I->click('//button[contains(text(),\'Pay\')]');
    }

    public function clickPay()
    {
        $I = $this;

        $I->click('//button[contains(text(),\'Pay\')]');
    }

    public function clickContinueToPayment()
    {
        $I = $this;

        $I->click('//button[contains(text(),\'Continue to payment\')]');
    }

    public function applyGiftCard()
    {
        $I = $this;

        //$I->click('/html/body/main/div/article/div/div/form/div[2]/section[2]/div[2]/div[2]/div/div[3]/a');
        $I->fillField($this->couponCodeField, 'thetot10'); // gc-376054-60a40ad38bd83
        $I->click($this->applyCouponButton);
        $I->waitForElementVisible('li.cart-discount ', self::TIMEOUT);
    }

    public function removeGiftCard()
    {
        $I = $this;
        $I->click($this->removeCouponLink);
        $I->wait(3);
        $I->reloadPage(); // Workaround for issue: selecting Remove link doesn't always reload page
        $I->wait(5);
        $I->dontSeeElement('li.cart-discount ');
        //$I->see('467.37', 'li.order-total');
    }
}
