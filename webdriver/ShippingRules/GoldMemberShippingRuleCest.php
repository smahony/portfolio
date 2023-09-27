<?php

/**
 * @group rewardsShipping
 */
class GoldMemberShippingRuleCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public $standardShippingRate = '//form//div//div//div//div//div//span[contains(text(),\'9.95\')]//span[contains(text(),\'$\')]';
    public $freeShipping = '//form//div//div//div//div//div//span[contains(text(),\'0.00\')]//span[contains(text(),\'$\')]';

    public function shippingGoldUserUnder50USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Page\Webdriver\Login $login
    ) {
        $login->login('mahony.s.tutoring+gold@gmail.com', 'gold5000');
        $I->saveSessionSnapshot('login_gold');
        $productPage->view49DollarProduct();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->standardShippingRate, 10);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }

    public function shippingGoldUserOver50USD(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart
    )
    {
        $I->loadSessionSnapshot('login_gold');
        $productPage->view50DollarProduct();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $I->waitForElementVisible($this->freeShipping, 10);
        //@todo Fix false positive where gold user is charged for $50 USD
        //$I->dontSeeElement($this->standardShippingRate);
        $I->wait(3);
        $I->click('Remove');
        $I->waitForElementVisible('//p[contains(text(),\'Your cart is currently empty.\')]', 10);
    }
}