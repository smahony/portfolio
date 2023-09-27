<?php

/**
 * @group registryCheckout
 */
class RegistryCheckoutCest
{
    public $selectRegistryAddress = '/html/body/main/div/article/div/div/form/div[3]/section[2]/div[2]/div[2]/div/div[4]/label[1]/input';

    public function _before(WebDriverTester $I)
    {
        // Only needed if testing on IP address outside United States
        $I->amOnPageWithoutStickyHeader("/choose-your-country/");
        $I->click("United States");
        $I->waitForElementVisible('img[alt="Ship to United States"]');
    }
    public function _after(WebDriverTester $I)
    {
    }

    public function registryCheckoutStripe(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickStripe();
        $cart->fillContactDetails();
        $cart->fillShippingDetails();
        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(10);
        $I->waitForText('Order details', 60);

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkBillingDetails('Test Test', 'test@test.com', '94108');
        $confirmation->checkOrderTotals('$75.02');
    }

    public function registryCheckoutStripeShipToRegistrant(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->moveMouseOver($this->selectRegistryAddress);
        $I->wait(3);
        $I->click($this->selectRegistryAddress);
        $I->wait(8);
        $cart->clickStripe();
        $cart->fillContactDetails();

        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(10);
        $I->waitForText('Order details', 60);

        $confirmation->checkShippingAddress('Registry Signup', 'Registrant address on file');
        $confirmation->checkBillingDetails('Test Test', 'test@test.com', '94108');
        $confirmation->checkOrderTotals('$75.54');
    }

    public function registryCheckoutAmazon(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->wait(10);
        $cart->clickAmazonPay();
        $amazonPay->amazonLogin();
        $I->wait(5);
        $amazonPay->selectCalifornia();
        $I->wait(5);
        $amazonPay->completeStripeForm();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(10);
        $I->waitForText('Order details', 60);

        $confirmation->checkShippingAddress('Samantha Mahony', '3615 VETERAN AVE APT 10 LOS ANGELES, CA 90034');
        $confirmation->checkAmazonBillingDetails('Samantha Test', '5555555555', 'mahony.s.tutoring+amazonpaytest@gmail.com');
        $confirmation->checkOrderTotals('$75.54');
    }

    public function registryCheckoutAmazonShipToRegistrant(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->moveMouseOver($this->selectRegistryAddress);
        $I->wait(3);
        $I->click($this->selectRegistryAddress);
        $I->wait(10);
        $cart->clickAmazonPay();
        $I->wait(5);
        $amazonPay->selectCalifornia();
        $I->wait(5);
        $amazonPay->completeStripeForm();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(10);
        $I->waitForText('Order details', 60);

        $confirmation->checkShippingAddress('Registry Signup', 'Registrant address on file');
        $confirmation->checkAmazonBillingDetails('Samantha Test', '5555555555', 'mahony.s.tutoring+amazonpaytest@gmail.com');
        $confirmation->checkOrderTotals('$75.54');
    }

    public function registryCheckoutPaypal(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Paypal $payPal,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->wait(10);
        $cart->clickPaypalButton();
        $payPal->paypalLogin();
        $I->waitForElementVisible('//h2[contains(text(),\'Ship to\')]');
        $I->scrollTo('#payment-submit-btn');
        $I->wait(5);
        $I->click('//*[@id="payment-submit-btn"]');
        $I->wait(5);
        $I->switchToWindow();
        $I->waitForElementVisible('//div[@id=\'stripe-checkout-modal-body\']');
        $I->wait(3);
        $I->switchToWindow();
        $I->wait(3);
        $I->fillField('//input[@id=\'phone\']', '5555555555');
        $I->switchToWindow();
        $I->wait(3);
        /**
         * Pay
         */
        $I->click('//button[contains(text(),\'Pay\')]');

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(10);
        $I->waitForText('Order details', 60);

        $confirmation->checkShippingAddress('John Doe', '1 Main St San Jose, CA 95131');
        $confirmation->checkBillingDetails('John Doe', '5555555555', 'sb-tneug1933680@personal.example.com');
        $confirmation->checkOrderTotals('$75.46');
    }

    public function registryCheckoutPaypalShipToRegistrant(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Paypal $payPal,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->moveMouseOver($this->selectRegistryAddress);
        $I->wait(3);
        $I->click($this->selectRegistryAddress);
        $I->wait(10);
        $cart->clickPaypalButton();
        $I->wait(20);
        $I->scrollTo('#payment-submit-btn');
        $I->wait(5);
        $I->click('//*[@id="payment-submit-btn"]');
        $I->wait(5);
        $I->switchToWindow();
        $I->waitForElementVisible('//div[@id=\'stripe-checkout-modal-body\']');
        $I->wait(3);
        $I->switchToWindow();
        $I->wait(3);
        $I->fillField('//input[@id=\'phone\']', '5555555555');
        $I->switchToWindow();
        $I->wait(3);
        /**
         * Pay
         */
        $I->click('//button[contains(text(),\'Pay\')]');

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(10);
        $I->waitForText('Order details', 60);

        $confirmation->checkShippingAddress('Registry Signup', 'Registrant address on file');
        $confirmation->checkBillingDetails('John Doe', '5555555555', 'sb-tneug1933680@personal.example.com');
        $confirmation->checkOrderTotals('$75.54');
    }

    public function registryCheckoutKlarna(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Klarna $klarna,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->wait(10);
        $cart->clickKlarna();
        $klarnaEmail = 'test' . strval(random_int(100, 1000)) . '@test.com';
        /**
         * Fill Contact Information
         */
        $I->fillField('//input[@id=\'name\']', 'Test Test');
        $I->fillField('//input[@id=\'email\']', $klarnaEmail);
        $phoneNumber = strval(random_int(8182000000, 8189999999));
        $I->fillField('//input[@id=\'phone\']', $phoneNumber);
        $cart->fillShippingDetailsCA();
        $I->switchToNextTab();
        $I->wait(6);
        $cart->clickContinueToPayment();
        $I->wait(6);
        $cart->clickContinueToPayment();
        $I->wait(20);
        /**
         * Issue workaround: double-click payment button
         */
        $klarna->klarnaCheckout();
        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkKlarnaBillingDetails('Test Test', $phoneNumber, $klarnaEmail);
        $confirmation->checkOrderTotals('$75.02');
    }

    public function registryCheckoutKlarnaShipToRegistrant(
        WebDriverTester $I,
        \Step\Webdriver\UserRegistryPage $registryCheckout,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Klarna $klarna,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $registryCheckout->addRegistryProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->moveMouseOver($this->selectRegistryAddress);
        $I->wait(3);
        $I->click($this->selectRegistryAddress);
        $I->wait(8);
        $I->dontSeeElement('//*[@id="klarna-cart-button"]');
        $I->click('X Remove');
    }
}