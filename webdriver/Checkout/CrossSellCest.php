<?php

/**
 * @group crossSell
 */
class CrossSellCest
{
    public function _before(WebDriverTester $I)
    {
        // Only needed if testing on IP address outside United States
        $I->amOnPageWithoutStickyHeader("/choose-your-country/");
        $I->click("United States");
        $I->waitForElementVisible('img[alt="Ship to United States"]');
    }

    public function addCrossSellProductsToCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart
    ) {
        $productPage->viewSimpleProduct();
        $addToCart->addCrossSellProductToCart();

        $productPage->viewProductWithSize();
        $addToCart->addCrossSellProductToCart();

        $productPage->viewProductWithSizeAndColor();
        $addToCart->addCrossSellProductToCart();

        $productPage->viewBundledProduct();
        $addToCart->addCrossSellProductToCart();

        $I->saveSessionSnapshot('stripe_cart');
    }
}