<?php

/**
 * @group productView
 */
class ProductViewCest
{
    public function _before(WebDriverTester $I)
    {
        $I->wait(1);
    }
    public function _after(WebDriverTester $I)
    {
    }

    /**
     * Ship-By Dates on Product Page
     * @todo Convert to array or something neater
     */
    public function viewProductsShipByDate(WebDriverTester $I, \Step\Webdriver\ProductPage $productPage, \Step\Webdriver\ProductElements $shipByDate)
    {
        $productPage->viewSimpleProduct();
        $shipByDate->shipByDate();

        $productPage->viewProductWithSize();
        $shipByDate->estimatedShipDate();

        $productPage->viewProductWithSizeAndColor();
        $shipByDate->estimatedShipDate();

        $productPage->viewBundledProduct();
        $shipByDate->estimatedBundleShipDate();
    }

    /**
     * Ship-By Dates on Quick View
     * @todo Convert to array or something neater
     */
    public function viewProductsShipByDateFromCatalogView(WebDriverTester $I, \Step\Webdriver\ProductQuickView $productPage, \Step\Webdriver\ProductElements $shipByDate)
    {
        $productPage->viewSimpleProduct();
        $shipByDate->shipByDate();

        $productPage->viewProductWithSize();
        $shipByDate->estimatedShipDate();

        $productPage->viewProductWithSizeAndColor();
        $shipByDate->estimatedShipDate();

        $productPage->viewBundleProduct();
        $shipByDate->estimatedBundleShipDate();
    }
}
