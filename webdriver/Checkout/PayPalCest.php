<?php

/**
 * @group payPal
 */
class PayPalCest
{
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

    public function addProductsToCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Paypal $payPal
    )
    {
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $productPage->viewProductWithSize();
        $addToCart->addToCart();

        $productPage->viewProductWithSizeAndColor();
        $addToCart->addToCart();

        $productPage->viewBundledProduct();
        $addToCart->addBundleProductToCart();

        $I->saveSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickPaypalButton();
        $payPal->paypalLogin();
        $I->saveSessionSnapshot('login');
        $I->closeTab();
    }

    public function paypalCheckoutUnsupportedDestinations(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Paypal $payPal
    )
    {
        $I->loadSessionSnapshot('stripe_cart');
        $I->saveSessionSnapshot('login');

        $I->amOnPageWithoutStickyHeader($cart->url);

        $I->wait(10);
        $I->waitForElementVisible('//div[@id=\'paypal-button-container\']');
        $I->wait(5);
        $I->click('//div[@id=\'paypal-button-container\']');
        $I->wait(10);
        $I->switchToIFrame();
        $I->click('/html/body/div[2]/div/div/div/header/div[2]/div[4]/div/span');
        $I->wait(5);
        $payPal->selectAlaska();
        $payPal->selectAustralia();
        $payPal->selectGuam();
        $payPal->selectHawaii();
        $payPal->selectPuertoRico();
        $I->closeTab();
    }

    public function paypalCheckout(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ) {
        $I->loadSessionSnapshot('stripe_cart');
        $I->saveSessionSnapshot('login');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->wait(10);
        $I->waitForElementVisible('//div[@id=\'paypal-button-container\']');
        $I->wait(5);
        $I->click('//div[@id=\'paypal-button-container\']');
        $I->wait(10);
        //$I->waitForElementVisible('//h2[contains(text(),\'Ship to\')]', 5);
//        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
//        $I->wait(5);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(5);
        $I->switchToWindow();
        $I->waitForElementVisible('//div[@id=\'stripe-checkout-modal-body\']');
        $I->wait(3);
        $I->switchToWindow();
        $I->wait(3);
        $phoneNumber = strval(random_int(8182000000, 8189999999));
        $I->fillField('//input[@id=\'phone\']', $phoneNumber);
        $I->switchToWindow();
        $I->wait(3);
        /**
         * Tax Rates
         */
        $cart->fillShippingDetailsTX(
            'Test test',
            '400 S Record street',
            'Dallas',
            'TX',
            75202
        );
        $I->click('//*[@id="country"]');
        $I->wait(4);
        //$I->see('$36.70', '.tax-total'); // staging = 36.20 dev = 36.06

        $cart->fillShippingDetailsNJ(
            'Test test',
            '3 Tower Center Bl',
            'East Brunswick',
            'New Jersey',
            '08816'
        );
        $I->click('//*[@id="country"]');
        $I->wait(1);
        // $I->see('$20.50', '.tax-total');

        $cart->fillShippingDetailsNY(
            'Test test',
            '1 United Nations Plaza',
            'New York City',
            'New York',
            '10017'
        );
        $I->saveSessionSnapshot('login');
        $I->wait(4);
        $I->click('//*[@id="country"]');
        $I->wait(4);
        $I->see('$28.76', '.tax-total');
        $I->wait(2);
        $I->waitForElementVisible('//button[contains(text(),\'Pay\')]');
        /**
         * Pay
         */
        $I->click('//button[contains(text(),\'Pay\')]');

        $I->wait(30);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test test', '1 United Nations Plaza New York City, NY 10017');
        $confirmation->checkAmazonBillingDetails('John Doe', $phoneNumber, 'sb-tneug1933680@personal.example.com');
        $confirmation->checkOrderTotals('$467.37');
    }

    public function paypalCheckoutWithGiftOptionsFromCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ) {
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->addGiftOptionsFromCart();
        $I->waitForElementVisible('//div[@id=\'paypal-button-container\']');
        $I->wait(5);
        $I->click('//div[@id=\'paypal-button-container\']');
        $I->wait(10);
        //$I->waitForElementVisible('//h2[contains(text(),\'Ship to\')]', 5);
//        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
//        $I->wait(5);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(5);
        $I->switchToWindow();
        $I->waitForElementVisible('//div[@id=\'stripe-checkout-modal-body\']');
        $I->wait(3);
        $I->switchToWindow();
        $I->wait(3);
        $phoneNumber = strval(random_int(8182000000, 8189999999));
        $I->fillField('//input[@id=\'phone\']', $phoneNumber);
        $I->switchToWindow();
        $I->wait(3);
        /**
         * Ship to No Tax Destination
         */
        $cart->fillShippingDetailsNY(
            'Test test',
            '1 United Nations Plaza',
            'New York City',
            'New York',
            '10017'
        );
        $I->saveSessionSnapshot('login');
        $I->wait(4);
        $I->click('//*[@id="country"]');
        $I->wait(4);
        $I->see('$2.65', '.tax-total');
        $I->wait(2);
        $I->waitForElementVisible('//button[contains(text(),\'Pay\')]');
        /**
         * Pay
         */
        $I->click('//button[contains(text(),\'Pay\')]');

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test test', '1 United Nations Plaza New York City, NY 10017');
        $confirmation->checkAmazonBillingDetails('John Doe', $phoneNumber, 'sb-tneug1933680@personal.example.com');
        $confirmation->checkOrderTotals('$33.57');
    }

    /**
     * @todo Add gift options to electronic gift card only
     * @example(link="electronic-gift-card", selector=".email-type")
     * @example(link="mailed-gift-card", selector=".mailed-type")
     * @param \Codeception\Example $giftCardType
     */
    public function paypalCheckoutWithGiftCard(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Codeception\Example $giftCardType,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Paypal $paypal,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ) {
        $I->loadSessionSnapshot('login');

        $productPage->viewGiftCardOptions($giftCardType);
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible('//div[@id=\'paypal-button-container\']');
        $I->wait(5);
        $I->click('//div[@id=\'paypal-button-container\']');
        $I->wait(10);
//        $I->scrollTo('//button[@id=\'payment-submit-btn\']');
//        $I->wait(2);
        $I->click('//button[@id=\'payment-submit-btn\']');
        $I->wait(2);
        $I->switchToWindow();
        $I->waitForElementVisible('//div[@id=\'stripe-checkout-modal-body\']');
        $I->wait(3);
        $I->switchToWindow();
        $I->wait(3);
        $phoneNumber = strval(random_int(8182000000, 8189999999));
        $I->fillField('//input[@id=\'phone\']', $phoneNumber);
        $I->switchToWindow();
        $I->wait(3);
        /**
         * Pay
         */
        $I->click('//button[contains(text(),\'Pay\')]');

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkAmazonGiftCardBillingDetails('John Doe', $phoneNumber, 'sb-tneug1933680@personal.example.com');
        $confirmation->checkOrderTotals('$25.00');
    }
}