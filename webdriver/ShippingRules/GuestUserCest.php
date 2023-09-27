<?php

/**
 * @group rewardsShipping
 */
class GuestUserCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public $standardShippingRate = '//form//div//div//div//div//div//span[contains(text(),\'9.95\')]//span[contains(text(),\'$\')]';
    public $freeShipping = '//form//div//div//div//div//div//span[contains(text(),\'0.00\')]//span[contains(text(),\'$\')]';

    public function shippingStandardUserUnder75USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart
    ) {
        $productPage->view74DollarProduct();
        $addToCart->addBundleProductToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->standardShippingRate, 10);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }

    public function shippingStandardUserOver75USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart
    ){
        $productPage->view75DollarProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->freeShipping, 10);
        $I->dontSeeElement($this->standardShippingRate);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }
}