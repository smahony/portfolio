<?php

/**
 * @group rewardsShipping
 */
class SilverMemberShippingRuleCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public $standardShippingRate = '//form//div//div//div//div//div//span[contains(text(),\'9.95\')]//span[contains(text(),\'$\')]';
    public $freeShipping = '//form//div//div//div//div//div//span[contains(text(),\'0.00\')]//span[contains(text(),\'$\')]';

    public function shippingSilverUserUnder75USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Page\Webdriver\Login $login
    ) {
        $login->login('mahony.s.tutoring+silver@gmail.com', 'silver5000');
        $I->saveSessionSnapshot('login_silver');
        $productPage->view74DollarProduct();
        $addToCart->addBundleProductToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->standardShippingRate, 10);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }

    public function shippingSilverUserOver75USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart
    )
    {
        $I->loadSessionSnapshot('login_silver');
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