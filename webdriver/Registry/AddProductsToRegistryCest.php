<?php

/**
 * @group registryCheckout
 */
class AddProductsToRegistryCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public function addSimpleProduct(
        WebDriverTester $I,
        \Step\Webdriver\ProductQuickView $productQuickView,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $productElements,
        \Page\Webdriver\Login $login
    ) {
        $login->login('registry5000@signup.com', 'registry5000'); // registry162264@signup.com on dev | registry5000@signup.com on staging
        $I->saveSessionSnapshot('login');

        $productQuickView->viewSimpleProduct();
        $I->wait(3);
        $I->see('Added to Registry');

        $productPage->viewSimpleProduct();
        $I->wait(3);
        $I->see('Added to Registry');
    }

    public function addProductWithSize(
        WebDriverTester $I,
        \Step\Webdriver\ProductQuickView $productQuickView,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $productElements
    ) {
        $I->loadSessionSnapshot('login');
        $productQuickView->viewProductWithSize();
        $I->wait(3);
        $I->see('Added to Registry');

        $productPage->viewProductWithSize();
        $I->wait(3);
        $I->see('Added to Registry');
    }

    public function addProductWithSizeAndColor(
        WebDriverTester $I,
        \Step\Webdriver\ProductQuickView $productQuickView,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $productElements
    ) {
        $I->loadSessionSnapshot('login');
        $productQuickView->viewProductWithSizeAndColor();
        // Adding 10 of this sku to registry so that sku does not run out in test registry
        $I->selectOption('quantity', '10');
        $productElements->addToRegistry_loggedIn_OneRegistry();
        // Note: canSeeElement test for shipping estimate had to be skipped so that this sequence would work

        $productPage->viewProductWithSizeAndColor();
        $I->wait(3);
        $I->see('Added to Registry');
    }

    /**
     * @param WebDriverTester $I
     * @param \Step\Webdriver\ProductQuickView $productQuickView
     * @param \Step\Webdriver\ProductPage $productPage
     * @param \Step\Webdriver\ProductElements $productElements
     */
    public function addBundleProduct(
        WebDriverTester $I,
        \Step\Webdriver\ProductQuickView $productQuickView,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $productElements
    ) {
        $I->loadSessionSnapshot('login');
        $productQuickView->viewBundleProduct();
        $I->wait(3);
        $I->see('Added to Registry');

        $productPage->viewBundledProduct();
        $I->wait(3);
        $I->see('Added to Registry');
    }

    /**
     * @example(link="electronic-gift-card", selector=".email-type")
     * @example(link="mailed-gift-card", selector=".mailed-type")
     * @param WebDriverTester $I
     * @param \Step\Webdriver\ProductQuickView $productQuickView
     * @param \Step\Webdriver\ProductElements $productElements
     * @param \Step\Webdriver\ProductPage $productPage
     * @param \Codeception\Example $giftCardType
     */
    function checkoutGiftCardOptions(
        WebDriverTester $I,
        \Step\Webdriver\ProductQuickView $productQuickView,
        \Step\Webdriver\ProductElements $productElements,
        \Step\Webdriver\ProductPage $productPage,
        \Codeception\Example $giftCardType
    ) {
        $I->loadSessionSnapshot('login');
        $productQuickView->viewGiftCardOptions($giftCardType);
        $I->wait(5);
        $I->see('Added to Registry');

        $productPage->viewGiftCardOptions($giftCardType);
        $I->wait(5);
        $I->see('Added to Registry');
    }

    public function logOut(
        WebDriverTester $I,
        \Step\Webdriver\ProductQuickView $productQuickView,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $productElements,
        \Page\Webdriver\Login $login
    ) {
        $I->amOnPageWithoutStickyHeader('/');
        $I->wait(5);
        $I->click('/html/body/header/div[2]/div[1]/div[3]/div[2]/div/div[1]/div[2]/a');
    }

    /**
     * @skip
     * @todo Reconfigure cross-sell item
     */
    public function addCrossSellProducts(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToRegistry
    ) {
        $I->loadSessionSnapshot('login');
        $productPage->viewSimpleProduct();
        $addToRegistry->addCrossSellProductToRegistry();

        $productPage->viewProductWithSize();
        $addToRegistry->addCrossSellProductToRegistry();

        $productPage->viewProductWithSizeAndColor();
        $addToRegistry->addCrossSellProductToRegistry();

        $productPage->viewBundledProduct();
        $addToRegistry->addCrossSellProductToRegistry();

        $I->saveSessionSnapshot('stripe_cart');
    }
}