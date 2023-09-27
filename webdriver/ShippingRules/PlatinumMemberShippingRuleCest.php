<?php

/**
 * @group rewardsShipping
 */
class PlatinumMemberShippingRuleCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public $standardShippingRate = '//form//div//div//div//div//div//span[contains(text(),\'9.95\')]//span[contains(text(),\'$\')]';
    public $freeShipping = '//form//div//div//div//div//div//span[contains(text(),\'0.00\')]//span[contains(text(),\'$\')]';

    public function shippingPlatinumUserUnder50USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Page\Webdriver\Login $login
    ) {
        $login->login('mahony.s.tutoring+ghy@gmail.com', 'password5000');
        $I->saveSessionSnapshot('login_platinum');
        $productPage->view49DollarProduct();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->freeShipping, 10);
        $I->dontSeeElement($this->standardShippingRate);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }

    public function shippingPlatinumUserOver50USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart
    )
    {
        $I->loadSessionSnapshot('login_platinum');
        $productPage->view50DollarProduct();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->freeShipping, 10);
        $I->dontSeeElement($this->standardShippingRate);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }
}