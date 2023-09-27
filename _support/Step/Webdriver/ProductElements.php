<?php
namespace Step\Webdriver;

class ProductElements extends \WebDriverTester
{
    const TIMEOUT = 30;
    public $addToCartButton = '//button[@class=\'single_add_to_cart_button add_to_cart_btn button alt btn-block\']';
    public $bundleAddToCartButton = '//button[@class=\'add_to_cart_bundled_product_with_variation add_to_cart_btn single_add_to_cart_button bundle_add_to_cart_button button alt btn-block\']';
    public $viewCartButton = 'a.button.wc-forward';

    public $addToRegistryButton = '//button[@class=\'single_add_to_cart_button button alt btn-block add_to_registry_button\']';
    public $registryURL = '/baby-registry/';
    public $itemAddedToRegistryPopUp = '//div[@id=\'added-to-registry-modal\']';

    public $ohNoOutOfStockMessage = '//span[@class=\'subscribe-product-title\']';
    public $notifyMeButton = '//button[@class=\'button alt btn-block subscribe-stock-alert-button\']';

    public $shipByDate = 'Ships by December 18, 2020';

    public $estimatedShipDate = 'Usually departs warehouse in 2 business days';
    public $estimatedBundleShipDate = 'Usually departs warehouse in 5 business days';

    public $crossSellItem = '//a[contains(text(),\'Stainless Steel Baby Spoon and Fork Set\')]';
    public $crossSellAddToCartButton = 'section.cross-sells .single_add_to_cart_button';
    public $crossSellAddToRegistryButton = '//section//form//div[3]//div[1]//button[1]';

    public function shipByDate($context = null)
    {
        $I = $this;
        $I->see($this->shipByDate, '.thetot-estimated-shipping-wrapper');

    }

    public function estimatedShipDate($context = null)
    {
        $I = $this;
        $I->see($this->estimatedShipDate, '.thetot-estimated-shipping-wrapper');

    }

    public function estimatedBundleShipDate($context = null)
    {
        $I = $this;
        $I->see($this->estimatedBundleShipDate, '.thetot-estimated-shipping-wrapper');

    }

    public function addToCart($context = null)
    {
        $I = $this;
        $I->click($this->addToCartButton, $context);
        $I->waitForElement($this->viewCartButton, self::TIMEOUT);
    }

    public function addBundleProductToCart($context = null)
    {
        $I = $this;
        $I->waitForElement($this->bundleAddToCartButton, self::TIMEOUT);
        $I->click($this->bundleAddToCartButton, $context);
        $I->waitForElement($this->viewCartButton, self::TIMEOUT);
    }

    public function addToRegistry_loggedIn_OneRegistry()
    {
        $I = $this;
        $I->waitForElementVisible($this->addToRegistryButton);
        $I->click($this->addToRegistryButton);
        $I->wait(8);
        //$I->waitForElement($this->itemAddedToRegistryPopUp, self::TIMEOUT); // popup currently missing from staging
    }

    public function notifyMe()
    {
        $I = $this;
        $I->waitForElementVisible($this->ohNoOutOfStockMessage);
        $I->fillField('.subscribe-product-alert-email', 'test@test.com');
        $I->click($this->notifyMeButton);
        $I->waitForElement('//p[@id=\'product-stock-alert-email-sent\']');
    }

    public function addCrossSellProductToCart()
    {
        $I = $this;
        $I->waitForElementVisible('section.cross-sells');
        $I->scrollTo($this->crossSellItem, 0, 20);
        $I->see('You may also need', 'h2');
        $I->click('section.cross-sells li[data-value="pink"] a');
        $I->click($this->crossSellAddToCartButton);
        $I->waitForElement($this->viewCartButton, self::TIMEOUT);
    }

    public function addCrossSellProductToRegistry()
    {
        $I = $this;
        $I->waitForElementVisible('section.cross-sells');
        $I->scrollTo($this->crossSellItem, 0, 20);
        $I->see('You may also need', 'h2');
        $I->click('section.cross-sells li[data-value="pink"] a');
        $I->click($this->crossSellAddToRegistryButton);
        $I->waitForElement($this->itemAddedToRegistryPopUp, self::TIMEOUT);
    }

    public function writeReview()
    {
        $I = $this;
        $I->click('//a[contains(text(),\'Write a review\')]');
        $I->wait(2);
        $I->click('write a review');
        $I->wait(2);
        $I->scrollTo('span.review-star:nth-child(5)', 0, -160);
        $I->wait(2);
        $I->click('span.review-star:nth-child(5)');
        $I->fillField('//input[@id=\'yotpo_input_review_title\']', '5-Star Review 1');
        $I->fillField('//textarea[@id=\'yotpo_input_review_content\']', '5-Star Review 1 content 0123456789~!@#$%^&*()');
        $I->click('//input[@id=\'yotpo_input_single_choice_How old is the child?_how_old_is_the_child_1\']');
        $I->click('//input[@id=\'yotpo_input_single_choice_I am:_i_am_1\']');
        $I->fillField('//input[@id=\'yotpo_input_review_username\']', '5Star Review1');
        $I->fillField('//input[@id=\'yotpo_input_review_email\']', '5starreview1@5starreview1.com');
        $I->click('Post');
        $I->wait(3);
    }

}