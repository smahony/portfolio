<?php

/**
 * @group cribCheckout
 */
class CribCheckoutCest
{
    public function _before(WebDriverTester $I)
    {
        // Only needed if testing on IP address outside United States
        $I->amOnPageWithoutStickyHeader("/choose-your-country/");
        $I->click("United States");
        $I->waitForElementVisible('img[alt="Ship to United States"]');
    }

    public function cribCheckoutHasNoGiftWrapOption(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $productPage->viewCribProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->giftWrapUnavailableMessageInCart();
        $cart->addGiftMessageOnly();
        $cart->clickStripe();
        $cart->fillContactDetails();
        $cart->fillShippingDetails();
        $I->wait(5);
        $cart->noGiftWrapCheckboxAtCribCheckout();
        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-popup"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkBillingDetails('Test Test', 'test@test.com', '94108');
        $confirmation->checkOrderTotals('$301.43');
    }
}