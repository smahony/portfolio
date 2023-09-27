<?php

namespace Step\Webdriver;

class ProductQuickView extends \WebDriverTester
{
    public function viewSimpleProduct()
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader('/product-category/toys/blocks-stackers-sorters/?orderby=price');
        $I->executeJS("jQuery('.emarsys-widget').remove()");
        $I->scrollTo('.products div[data-product-id="273331"] img');
        $I->wait(3);
        $I->moveMouseOver('.products div[data-product-id="273331"] img');
        $I->see('Quick View');
        $I->click( 'div[data-product-id="273331"] .product-quickview__button .btn-default');
        $I->waitForElement('#product-quickview-modal #product-273331');
        $I->wait(3);
        $I->canSeeElement('//*[@id="product-273331"]/div/div/div[2]/div/form/div[2]/div[1]/div[3]/p');
    }

    public function viewProductWithSize()
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader('/product-category/apparel/?perPage=48&page=1&sortBy=RELEVANCE&category%5B%5D=Apparel&age_group%5B%5D=kids');
        $I->executeJS("jQuery('.emarsys-widget').remove()");
        $I->scrollTo('.products div[data-product-id="359300"] img');
        $I->wait(5);
        $I->moveMouseOver('.products div[data-product-id="359300"] img');
        $I->see( 'Quick view' );
        $I->click( '//*[@id="category-page-root"]/div/div/div[2]/div[3]/section/div[1]/div[1]/div/div[3]/button');
        $I->waitForElement('//h1[@class=\'product_title entry-title\']');
        $I->cantSeeElement('//*[@id="product-359300"]/div/div/div[2]/div/form/div[2]/div[2]/div[1]/div[3]/p');
        $I->wait(3);
        $I->click('li[data-original-index="3"][data-value="3-y"] a');
        $I->wait(8);
        $I->canSeeElement('//*[@id="product-359291"]/div/div/div[2]/div/form/div[2]/div[2]/div[3]/div[1]/div/span');
    }

    public function viewProductWithSizeAndColor()
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader('/product-category/apparel/?perPage=48&page=1&sortBy=RELEVANCE');
        $I->executeJS("jQuery('.emarsys-widget').remove()");
        $I->scrollTo('.products div[data-product-id="228677"] img');
        $I->wait(5);
        $I->moveMouseOver('.products div[data-product-id="228677"] img');
        $I->see( 'Quick view' );
        $I->click( '//*[@id="category-page-root"]/div/div/div[2]/div[3]/section/div[1]/div[1]/div/div[3]/button');
        $I->wait(8);
        $I->waitForElement('//h1[@class=\'product_title entry-title\']');
        $I->see('Baby Pointelle Angel Wing');
        $I->cantSeeElement('//*[@id="product-228686"]/div/div/div[2]/div/form/div[2]/div[2]/div[1]/div[3]/p');
        $I->click('li[data-value="pink"] a');
        $I->click('li[data-value="3-m"] a');
        //canSeeElement skipped so adding 10 of sku to quantity will work with registry suite
    }

    public function viewBundleProduct()
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader('/product-category/toys/?price[]=200');
        $I->executeJS("jQuery('.emarsys-widget').remove()");
        $I->scrollTo('div[data-product-id="385543"] img');
        $I->wait(3);
        $I->moveMouseOver('div[data-product-id="385543"] img');
        $I->see( 'Quick view' );
        $I->click( '//*[@id="category-page-root"]/div/div/div[2]/div[3]/section/div[1]/div[2]/div/div[3]/button');
        $I->waitForElement('//h1[@class=\'product_title entry-title\']', 10);
        $I->see('Balu Organics');
        $I->cantSeeElement('//*[@id="product-385543"]/div/div/div[2]/div/form/div[5]/div[1]/div[3]/div[3]/p');
        $I->click('.bundled_item_600 li[data-original-index="1"][data-value="white"] a');
        $I->click('.bundled_item_601 li[data-original-index="1"][data-value="white"] a');
        $I->click('.bundled_item_602 li[data-original-index="1"][data-value="white"] a');
        $I->wait(6);
        $I->canSeeElement('//*[@id="product-385543"]/div/div/div[2]/div/form/div[5]/div[1]/div[3]/div[3]/p');
    }

    public function viewGiftCardOptions(\Codeception\Example $giftCardType)
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader('/product-category/gifts/gift-cards/');
        $I->executeJS("jQuery('.emarsys-widget').remove()");
        $I->moveMouseOver('div[data-product-id="54240"] img');
        $I->see( 'Quick view' );
        $I->wait(3);
        $I->click( 'div[data-product-id="54240"] .product-quickview__button .btn-default');
        $I->wait(5);
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