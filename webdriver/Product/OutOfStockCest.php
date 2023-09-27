<?php

/**
 * @group addToCart
 */
class OutOfStockCest
{
    public $simpleProductOutOfStock = '/product/q-toys-tree-blocks/';
    public $variableProductWithSizeOutOfStock = '/product/little-moon-society-toddlerbig-kid-jess-dress-hot-pink-lightning/';
    public $variableProductWithSizeAndColorOutOfStock = '/product/marie-chantal-baby-pointelle-angel-wing/';
    public $bundleProductOutOfStock = '/product/stokke-tripp-trapp-complete-high-chair-flower-garden/';
    public $giftCardOutOfStock = '/product/the-tot-gift-card/';

    function simpleProductOutOfStock(WebDriverTester $I, \Step\Webdriver\ProductElements $notifyMe)
    {
        $I->amOnPageWithoutStickyHeader($this->simpleProductOutOfStock);

        $notifyMe->notifyMe();
    }

    function variableProductWithSizeOutOfStock(WebDriverTester $I, \Step\Webdriver\ProductElements $notifyMe, \Step\Webdriver\ProductElements $addToCart)
    {
        $I->amOnPageWithoutStickyHeader($this->variableProductWithSizeOutOfStock);

        $I->click('li[data-value="4-y"] a');
        $notifyMe->notifyMe();
        // Add size variety to cart that is in stock: "2-y"
        $I->scrollTo('.product-summary', 0, 20);
        $I->click('li[data-value="2-y"] a');
        $addToCart->addToCart();
    }

    function variableProductWithSizeAndColorOutOfStock(WebDriverTester $I, \Step\Webdriver\ProductElements $notifyMe, \Step\Webdriver\ProductElements $addToCart)
    {
        $I->amOnPageWithoutStickyHeader($this->variableProductWithSizeAndColorOutOfStock);

        $I->click('li[data-value="white"] a');
        $I->click('li[data-value="18-m"] a');
        $notifyMe->notifyMe();
        $I->click('li[data-value="6-m"] a');
        $addToCart->addToCart();
    }

    /**
     * @skip
     * @todo Add bundle product with one variety out of stock
     */
    function bundleProductOutOfStock(WebDriverTester $I, \Step\Webdriver\ProductElements $notifyMe)
    {
        $I->amOnPageWithoutStickyHeader($this->bundleProductOutOfStock);

        $I->click('li[data-original-index="1"][data-value="white"] a');
        $I->click('li[data-original-index="0"][data-value="storm-grey"] a');
        $notifyMe->notifyMe();
    }
}