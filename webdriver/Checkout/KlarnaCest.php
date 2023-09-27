<?php

/**
 * @group klarna
 */
class KlarnaCest
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
        \Step\Webdriver\ProductElements $addToCart
    ) {
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $productPage->viewProductWithSize();
        $addToCart->addToCart();

        $productPage->viewProductWithSizeAndColor();
        $addToCart->addToCart();

        $productPage->viewBundledProduct();
        $addToCart->addBundleProductToCart();

        $I->saveSessionSnapshot('stripe_cart');
    }

    public function checkoutWithNoDetails(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart
    ){
        $I->loadSessionSnapshot('stripe_cart');
        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickKlarna();
        $cart->fillEmptyContactDetails();
        $cart->fillEmptyShippingDetails();
        $I->wait(1);
        $cart->clickContinueToPayment();
        $I->wait(5);
        $I->dontSee('Processing payment. Please do not refresh');
    }

    public function checkoutWithNonSupportedStates(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickKlarna();
        $I->dontSeeInField('stripe_address_state', 'Alaska');
        $I->dontSeeInField('stripe_address_state', 'Hawaii');
        $I->dontSeeInField('stripe_address_state', 'Guam');
    }

    /**
     * @param WebDriverTester $I
     * @param \Step\Webdriver\Cart $cart
     */
    public function checkShippingAddressUpdateWithTax(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickKlarna();
        $cart->fillContactDetails();

        $cart->fillShippingDetailsTX(
            'Test test',
            '400 S Record street',
            'Dallas',
            'TX',
            75202
        );
        $I->click('//*[@id="country"]');
        $I->wait(4);
        //$I->see('$35.57', '.tax-total');

        $cart->fillShippingDetailsNJ(
            'Test test',
            '3 Tower Center Bl',
            'East Brunswick',
            'New Jersey',
            '08816'
        );
        $I->click('//*[@id="country"]');
        $I->wait(4);
        //$I->see('$21.46', '.tax-total');

        $cart->fillShippingDetailsNY(
            'Test test',
            '1 United Nations Plaza',
            'New York City',
            'New York',
            '10017'
        );
        $I->wait(4);
        $I->click('//*[@id="country"]');
        $I->wait(4);
        //$I->see('$28.76', '.tax-total');

    }

    /**
     * @skip
     * @todo Unblock purchases above a certain amount on Klarna sandbox
     */
    public function checkout(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Klarna $klarna,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->applyGiftCard();
        $cart->removeGiftCard();
        $I->wait(2);
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
        $I->click('//*[@id="country"]');
        $I->wait(1);
        $I->switchToNextTab();
        $I->wait(10);
        $cart->clickContinueToPayment();
        $I->wait(20);
        $klarna->klarnaCheckout();
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkKlarnaBillingDetails('Test Test', $phoneNumber, $klarnaEmail);
        $confirmation->checkOrderTotals('$463.85');
    }

    public function checkoutWithGiftOptionsFromCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Klarna $klarna,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->addGiftOptionsFromCart();
        $cart->clickKlarna();
        $klarnaEmail = 'test' . strval(random_int(1000, 10000)) . '@test.com';
        /**
         * Fill Contact Information
         */
        $I->fillField('//input[@id=\'name\']', 'Test Test');
        $I->fillField('//input[@id=\'email\']', $klarnaEmail);
        $phoneNumber = strval(random_int(8182000000, 8189999999));
        $I->fillField('//input[@id=\'phone\']', $phoneNumber);
        $cart->fillShippingDetailsCA();
        $I->switchToNextTab();
        $I->wait(2);
        $cart->clickContinueToPayment();
        $I->wait(2);
        $cart->clickContinueToPayment();
        $I->wait(2);
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
        //$confirmation->checkOrderTotals('$32.64');
        $confirmation->checkGiftWrapFee('$5.00');
    }
}