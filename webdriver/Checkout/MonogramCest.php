<?php

/**
 * @group monogram
 */
class MonogramCest
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

    public function addProductToCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart
    ) {
        $productPage->viewProductWithPersonalizationAndAddMonogram();
        $addToCart->addToCart();

        $I->saveSessionSnapshot('stripe_cart');
    }


    public function checkoutWithPersonalizedProduct(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->see('Name / Initial(s): Test', '//body//dl[3]');
        $I->see('Thread Color: Red', '//body//dl[4]');
        $cart->clickStripe();
        $cart->fillContactDetails();
        $cart->fillShippingDetails();

        $cart->fillCreditCardAndPayDetails();

        $I->waitForText('Order details', 30);

        $confirmation->checkShippingAddress('Test Test', '123 Test Ave San Francisco, CA 12345');
        $confirmation->checkBillingDetails('Test Test', 'test@test.com', '12345');
        $confirmation->checkOrderTotals('$83.95');
    }
}