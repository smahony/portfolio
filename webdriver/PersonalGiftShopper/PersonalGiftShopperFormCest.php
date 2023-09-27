<?php

/**
 * @group personalGiftShopperForm
 */
class PersonalGiftShopperFormCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    public function submitPersonalGiftShopperForm(
        WebDriverTester $I
    )
    {
        $I->amOnPage('/personal-gift-shopper/');
        $I->fillField('personal_gift_shopper_name', ' Test Test');
        $I->fillField('personal_gift_shopper_email', 'test@test.com');
        $I->fillField('personal_gift_shopper_phone_number', '5555555555');
        $I->click('//input[@id=\'personal_gift_shopper_option_text\']');
        $I->click('//input[@id=\'personal_gift_shopper_gift_for_tot\']');
        $I->click('//input[@id=\'personal_gift_shopper_gender_female\']');
        $I->fillField('personal_gift_shopper_gender_age', '2 mo');
        $I->click('//input[@id=\'personal_gift_shopper_budget_100_250\']');
        $I->fillField('personal_gift_shopper_info', 'Test ~!@#$%^&*()1234567890');
        $I->click('//div[9]//div[1]//input[1]');
        $I->wait(3);
        $I->amOnPage('/personal-gift-shopper/thank-you');
    }
}