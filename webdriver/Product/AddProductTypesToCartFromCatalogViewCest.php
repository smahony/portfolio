<?php

/**
 * @group addToCart
 */
class AddProductTypesFromCatalogViewCest
{
    public function _before(WebDriverTester $I)
    {
        $I->wait(1);
    }
    public function _after(WebDriverTester $I)
    {
    }

    public function addSimpleProductFromQuickView(WebDriverTester $I, \Step\Webdriver\ProductQuickView $productQuickView)
    {
        $productQuickView->viewSimpleProduct();
        $I->see('Ships by October 1, 2020', '.ships-by');
        $I->click('Add to cart', '#product-quickview-modal #product-263471');
        $I->seeElement('a.button.wc-forward');
    }

    public function addProductWithSizeFromQuickView(WebDriverTester $I, \Step\Webdriver\ProductQuickView $productQuickView)
    {
        $productQuickView->viewProductWithSize();
        $I->click('Add to cart', '#product-quickview-modal #product-228639');
        $I->seeElement('a.button.wc-forward');
    }

    public function addProductWithSizeAndColorFromQuickView(WebDriverTester $I, \Step\Webdriver\ProductQuickView $productQuickView)
    {
        $productQuickView->viewProductWithSizeAndColor();
        $I->click('Add to cart', '#product-quickview-modal #product-228675');
        $I->seeElement('a.button.wc-forward');
    }

    public function addBundleProductFromQuickView(WebDriverTester $I, \Step\Webdriver\ProductQuickView $productQuickView)
    {
        $productQuickView->viewBundleProduct();
        $I->click('Add to cart', '#product-quickview-modal #product-214080');
        $I->seeElement('a.button.wc-forward');
    }

    /**
     * @example(link="Electronic Gift Card", selector=".email-type")
     * @example(link="Mailed Gift Card", selector=".mailed-type")
     */
    public function checkoutGiftCardOptions(WebDriverTester $I, \Step\Webdriver\ProductQuickView $productQuickView,  \Codeception\Example $giftCardType)
    {
        $productQuickView->viewGiftCardOptions($giftCardType);
        $I->click('Add to cart', '#product-quickview-modal #product-54240');
        $I->seeElement('a.button.wc-forward');
    }
}