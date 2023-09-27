<?php

/**
 * @group amazonPay
 */
class AmazonPayCest
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
        \Step\Webdriver\Checkout\AmazonPay $amazonPay
    ) {
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $productPage->viewProductWithSize();
        $addToCart->addToCart();

        $productPage->viewProductWithSizeAndColor();
        $addToCart->addToCart();

        $productPage->viewBundledProduct();
        $addToCart->addBundleProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickAmazonPay();
        $amazonPay->amazonLogin();
        $I->saveSessionSnapshot('stripe_cart');
    }

    /**
     * @param WebDriverTester $I
     * @param \Step\Webdriver\Cart $cart
     * @param \Step\Webdriver\Checkout\AmazonPay $amazonPay
     */
    public function checkoutWithInvalidCreditCard(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickAmazonPay();
        $amazonPay->selectInvalidCreditCard();
        $amazonPay->completeStripeForm();
        $I->wait(15);
        $I->waitForElementVisible('//li[contains(text(),\'Your payment was declined. Please try another card\')]');
    }

    /**
     * @param WebDriverTester $I
     * @param \Step\Webdriver\Cart $cart
     * @param \Step\Webdriver\Checkout\AmazonPay $amazonPay
     */
    public function amazonPayCheckoutUnsupportedDestinations(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay
    )
    {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickAmazonPay();
        $I->wait(2);
        $amazonPay->selectAlaska();
        $I->waitForElementVisible('//div[contains(text(),\'Unfortunately we cannot ship to the selected address. To ship outside of the United States, please change your Ship To settings at the top of the page.\')]');
        $amazonPay->selectFrance();
        $I->waitForElement('//div[contains(text(),\'Unfortunately we cannot ship to the selected address. To ship outside of the United States, please change your Ship To settings at the top of the page.\')]', 5);
        $amazonPay->selectGuam();
        $I->waitForElement('//div[contains(text(),\'Unfortunately we cannot ship to the selected address. To ship outside of the United States, please change your Ship To settings at the top of the page.\')]', 5);
        $amazonPay->selectHawaii();
        $I->waitForElement('//div[contains(text(),\'Unfortunately we cannot ship to the selected address. To ship outside of the United States, please change your Ship To settings at the top of the page.\')]', 5);
        $amazonPay->selectPuertoRico();
        $I->waitForElement('//div[contains(text(),\'Unfortunately we cannot ship to the selected address. To ship outside of the United States, please change your Ship To settings at the top of the page.\')]', 5);
    }

    public function checkShippingAddressUpdateWithTax(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickAmazonPay();
        $I->wait(2);
        $amazonPay->selectCalifornia();
        $I->wait(5);

        $cart->fillShippingDetailsTX(
            'Test test',
            '400 S Record street',
            'Dallas',
            'TX',
            75202
        );
        $I->click('//*[@id="country"]');
        $I->wait(3);
        //$I->see('$36.70', '.tax-total'); // staging = 36.20 dev = 36.06 // $35.57

        $cart->fillShippingDetailsNJ(
            'Test test',
            '3 Tower Center Bl',
            'East Brunswick',
            'New Jersey',
            '08816'
        );
        $I->click('//*[@id="country"]');
        $I->wait(3);
        $I->see('$21.46', '.tax-total');

        $cart->fillShippingDetailsNY(
            'Test test',
            '1 United Nations Plaza',
            'New York City',
            'New York',
            '10017'
        );
        $I->wait(3);
        $I->click('//*[@id="country"]');
        $I->wait(6);
        $I->see('$28.76', '.tax-total');
    }

    /**
     * @param WebDriverTester $I
     * @param \Step\Webdriver\Cart $cart
     * @param \Step\Webdriver\Checkout\AmazonPay $amazonPay
     * @param \Step\Webdriver\Checkout\Confirmation $confirmation
     * @throws Exception
     */
    public function amazonPayCheckout(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickAmazonPay();
        $I->wait(3);
        $amazonPay->selectCalifornia();
        $I->wait(5);
        $amazonPay->completeStripeForm();

        $I->wait(30);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Samantha Mahony', '3615 VETERAN AVE APT 10
LOS ANGELES, CA 90034');
        $confirmation->checkAmazonBillingDetails('Samantha Test', '5555555555', 'mahony.s.tutoring+amazonpaytest@gmail.com');
        $confirmation->checkOrderTotals('$474.81');
    }

    public function amazonPayCheckoutWithGiftOptionsFromCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $I->loadSessionSnapshot('stripe_cart');

        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);

        $cart->addGiftOptionsFromCart();
        $cart->clickAmazonPay();
        $amazonPay->selectCalifornia();
        $I->wait(5);
        $amazonPay->completeStripeForm();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Samantha Mahony', '3615 VETERAN AVE APT 10
LOS ANGELES, CA 90034');
        $confirmation->checkAmazonBillingDetails('Samantha Test', '5555555555', 'mahony.s.tutoring+amazonpaytest@gmail.com');
        $confirmation->checkOrderTotals('$32.82');
    }

    /**
     * @todo Add gift options to electronic gift card only
     * @example(link="electronic-gift-card", selector=".email-type")
     * @example(link="mailed-gift-card", selector=".mailed-type")
     * @param \Codeception\Example $giftCardType
     */
    public function amazonPayCheckoutWithGiftCard(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Codeception\Example $giftCardType,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\AmazonPay $amazonPay,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ) {
        $productPage->viewGiftCardOptions($giftCardType);
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickAmazonPay();
        $I->wait(8);
        $amazonPay->completeStripeForm();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkAmazonGiftCardBillingDetails('Samantha Test', '5555555555', 'mahony.s.tutoring+amazonpaytest@gmail.com');
        $confirmation->checkOrderTotals('$25.00');
    }
}