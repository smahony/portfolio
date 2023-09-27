<?php

namespace Step\Webdriver;

class ProductPage extends \WebDriverTester
{
    public $simpleProduct = '/product/mushie-stacking-cups-retro/'; // /product/mushie-stacking-cups-retro/ same price on prod: land-dough-planet-earth-luxe-cup || penguin-random-house-change-sings
    public $variableProductWithSize = '/product/petite-plume-babytoddlerbig-kid-la-mer-short-set/';
    public $variableProductWithSizeAndColor = '/product/marie-chantal-baby-pointelle-angel-wing/';
    public $variableProductWithSizeAndColorFromSearchResult = '/?perPage=48&page=1&sortBy=RELEVANCE&s=pointelle angel wing';
    public $variableProductWithPersonalization = '/product/babytaylor-babytoddlerbig-kid-personalized-cashmere-sweater-speckled/';
    public $bundleProduct = '/product/balu-organics-medium-velvet-ball-pit-300-balls-white/';
    public $fortyNineDollarProduct = '/product/tender-leaf-toys-stables/';
    public $fiftyDollarProduct = '/product/the-tot-dinosaur-birthday-gift-set-3-5-y/';
    public $seventyFourDollarProduct = '/product/habbi-habbi-book-careers-volume-1-reading-wand-spanish/';
    public $seventyFiveDollarProduct = '/product/moulin-roty-latelier-de-patisserie-baking-set/';
    public $cribProduct = '/product/oeuf-sparrow-crib-conversion-kit/';
    public $giftCard = '/product/the-tot-gift-card/';

    public function viewSimpleProduct()
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader($this->simpleProduct);
        $I->canSeeElement('//*[@id="product-273331"]/div[3]/form/div[2]/div[1]/div[3]'); //comment out when running against different product
    }

    public function viewProductWithSize()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->variableProductWithSize);
        $I->cantSeeElement('//*[@id="product-359291"]/div[3]/form/div[2]/div[2]/div[1]/div[3]');
        $I->click('li[data-value="3-y"] a');
        $I->wait(8);
        $I->canSeeElement('//*[@id="product-359291"]/div[3]/form/div[2]/div[2]/div[1]/div[3]');
    }

    public function viewProductWithSizeAndColor()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->variableProductWithSizeAndColor);
        $I->wait(3);
        $I->cantSeeElement('//*[@id="product-228677"]/div[3]/form/div[2]/div[2]/div[1]/div[2]');
        $I->click('li[data-value="pink"] a');
        $I->click('li[data-value="3-m"] a');
        $I->wait(8);
        $I->canSeeElement('//*[@id="product-228675"]/div[3]/form/div[2]/div[2]/div[1]/div[2]');
    }

    public function viewProductWithSizeAndColorFromSearchResult()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->variableProductWithSizeAndColorFromSearchResult);
        $I->wait(10);
        $I->click('/html/body/main/div/div/div[2]/div[1]/div/div/div[2]/div[2]/section/div/div[1]');
        $I->amOnPageWithoutStickyHeader($this->variableProductWithSizeAndColor);
        $I->click('li[data-value="pink"] a');
        $I->click('li[data-value="3-m"] a');
        $I->wait(6);
        $I->canSeeElement('//*[@id="product-228675"]/div[3]/form/div[2]/div[2]/div[1]/div[2]');
    }

    public function viewProductWithPersonalization()
    {
        $I = $this;;
        $I->amOnPageWithoutStickyHeader($this->variableProductWithPersonalization);
        $I->click('li[data-value="speckled-milk"] a');
        $I->click('li[data-value="12-y"] a');
        $I->selectOption('custom-variations-thread_color', 'Red');
        $I->fillField('personalize-name-field-case-sensitive-name-and-initials', 'Test');
    }

    public function viewProductWithPersonalizationAndAddMonogram()
    {
        $I = $this;;
        $I->amOnPageWithoutStickyHeader($this->variableProductWithPersonalization);
        $I->click('li[data-value="speckled-milk"] a');
        $I->click('li[data-value="12-y"] a');
        $I->selectOption('custom-variations-thread_color', 'Red');
        $I->fillField('personalize-name-field-case-sensitive-name-and-initials', 'Test');
        //$I->click('//body/div/div[@id=\'primary\']/main[@id=\'main\']/div[@id=\'product-171561\']/div/form/div/div/div[@id=\'thetot-woocommerce-quantity-input\']/div[2]/div[1]/div[1]');
        //$I->fillField('monogram-text-171561', 'Test This');
        //$I->selectOption('monogram-font-option-171561', 'Hemstitch');
        //$I->selectOption('monogram-color-option-171561', 'Bellaire Grey');
    }

    public function viewBundledProduct()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->bundleProduct);
        $I->wait(5);
        $I->cantSeeElement('//*[@id="product-385543"]/div[3]/form/div[5]/div[1]/div[3]/div[3]');
        $I->click('.bundled_item_600 li[data-original-index="1"][data-value="white"] a'); // in stock on prod: [data-original-index="2"][data-value="clear"]
        $I->click('.bundled_item_601 li[data-original-index="1"][data-value="white"] a');
        $I->click('.bundled_item_602 li[data-original-index="1"][data-value="white"] a');
        $I->wait(8);
        $I->canSeeElement('//*[@id="product-385543"]/div[3]/form/div[5]/div[1]/div[3]/div[3]');
    }

    public function view49DollarProduct()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->fortyNineDollarProduct);
    }

    public function view50DollarProduct()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->fiftyDollarProduct);
    }

    public function view74DollarProduct()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->seventyFourDollarProduct);
    }

    public function view75DollarProduct()
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->seventyFiveDollarProduct);
    }

    public function viewCribProduct()
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader($this->cribProduct);
        $I->click('li[data-value="walnut"] a');
        $I->wait(3);
    }

    public function viewGiftCardOptions(\Codeception\Example $giftCardType)
    {
        $I = $this;;

        $I->amOnPageWithoutStickyHeader($this->giftCard);
        $I->click('[data-value="' . $giftCardType['link'] . '"]');
        $I->wait(5);
        $I->waitForElement($giftCardType['selector']);
        $I->click('//div[@class=\'variations-container\']//div[2]//div[1]//div[1]//div[1]//div[1]//div[1]//ul[1]//li[2]//a[1]');

        if($giftCardType['link'] == 'electronic-gift-card'){
            $I->fillField('//input[@name=\'email_recipient_name\']', 'Tester');
            $I->fillField('//input[@name=\'email_email\']', 'test@test.com');
            $I->fillField('//input[@name=\'email_confirm-email\']', 'test@test.com');
            $I->fillField('//input[@name=\'email_from\']', 'test@sender.com');
            $I->fillField('//textarea[@name=\'email_gift-message\']', 'Hello');
        } else {
            $I->fillField('//input[@name=\'mailed_recipient_name\']', 'Test');
            $I->fillField('//input[@name=\'mailed_from\']', 'Tester');
            $I->fillField('//input[@name=\'mailed_firstname\']', 'Firstname');
            $I->fillField('//input[@name=\'mailed_lastname\']', 'Lastname');
            $I->fillField('//input[@name=\'mailed_address_1\']', '7107 Northaven Road');
            $I->fillField('//input[@name=\'mailed_city\']', 'Dallas');
            $I->selectOption('//select[@name=\'mailed_state\']', 'Texas');
            $I->fillField('//input[@name=\'mailed_postcode\']', '75230');
            $I->fillField('//textarea[@name=\'mailed_gift-message\']', 'Hello');
        }
    }
}
