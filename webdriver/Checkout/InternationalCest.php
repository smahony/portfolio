<?php

/**
 * @group internationalCheckout
 */
class InternationalCest
{
    public function _before(WebDriverTester $I)
    {
        $I->amOnPageWithoutStickyHeader("/choose-your-country/");
        $I->click("United Kingdom");
        $I->waitForElementVisible('img[alt="Ship to United Kingdom"]');
    }

    public function internationalCheckoutGuest(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\International $international,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $productPage->viewProductWithSize();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickInternationalCheckout();
        $I->executeJS("jQuery('body').addClass('no-sticky')");
        $I->wait(5);
        // Guest email checkout
        $time = time();
        $emailID = strftime($time);
        $international->fillGuestCheckout('nosignup'.$emailID.'@test.com'); // 'shaunak.desh@thetot.com'
        $international->clickToShipping();
        $international->fillShippingDetailsUK();
        $international->fillBillingDetailsUK();
        $international->clickToPayment();
        $international->fillCreditCardDetailsUK();
        $international->clickPayNow();
        $I->wait(30);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));
    }

    public function internationalCheckoutNoTotCard(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\International $international,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $productPage->viewProductWithSize();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickInternationalCheckout();
        $I->executeJS("jQuery('body').addClass('no-sticky')");
        $I->wait(5);
        // Guest email checkout
        $time = time();
        $emailID = strftime($time);
        $international->fillGuestCheckout('nototcard'.$emailID.'@test.com'); // 'shaunak.desh@thetot.com'
        $international->clickToShipping();
        $international->fillShippingDetailsUK();
        $international->fillBillingDetailsUK();
        $international->clickToPayment();
        $international->fillCreditCardDetailsUK();
        $international->clickPayNow();
        $I->wait(30);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $I->moveMouseOver('//input[@id=\'account_password\']');
        $I->fillField('//input[@id=\'account_password\']', 'tester5000');
        $I->fillField('//input[@id=\'account_password2\']', 'tester5000');
        $I->click('//button[contains(text(),\'Create Account\')]');
        $I->wait(5);
        $I->amOnPageWithoutStickyHeader('/rewards');
        $I->wait(5);
        // Yotpo sync issue causes this to display either 200 or 214 half the time, verify visually until workaround
        //$I->see('269', '//*[@id="rewards-you-have-points"]/div/h1/span[2]/span');
        // Log out
        $I->click('/html/body/header/div[2]/div[1]/div[3]/div[2]/div/div[1]/div[2]/a');
        $I->wait(5);
    }

    public function internationalCheckoutWithTotCard(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\International $international,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    )
    {
        $productPage->viewProductWithSize();
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickInternationalCheckout();
        $I->executeJS("jQuery('body').addClass('no-sticky')");
        $I->wait(5);
        // Guest email checkout
        $time = time();
        $emailID = strftime($time);
        $international->fillGuestCheckout('yestotcard'.$emailID.'@test.com'); // 'shaunak.desh@thetot.com'
        $international->clickToShipping();
        $international->fillShippingDetailsUK();
        $international->fillBillingDetailsUK();
        $international->clickToPayment();
        $international->fillCreditCardDetailsUK();
        $international->clickPayNow();
        $I->wait(30);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $I->moveMouseOver('//input[@id=\'account_password\']');
        $I->fillField('//input[@id=\'account_password\']', 'tester5000');
        $I->fillField('//input[@id=\'account_password2\']', 'tester5000');
        $I->click('//button[contains(text(),\'Create Account\')]');
        $I->wait(5);
        // Fill out and submit Tot Card
        $I->click('/html/body/main/div/article/div[2]/div/div[2]/div[3]/div/div/div[2]/div/div/form/div[1]/div[1]/div/div[2]/label[1]/span');
        $I->fillField('//*[@id="due_date_mobile"]', '121222');
        $I->fillField('/html/body/main/div/article/div[2]/div/div[2]/div[3]/div/div/div[2]/div/div/form/div[1]/div[3]/div/div/div[1]/div/div[1]/input', '121222');
        $I->click('/html/body/main/div/article/div[2]/div/div[2]/div[3]/div/div/div[2]/div/div/form/div[1]/div[3]/div/div/div[1]/div/div[2]/div/div[2]/label[1]/input');
        $I->click('//*[@id="tot-information-button"]');
        $I->wait(5);
        $I->amOnPageWithoutStickyHeader('/rewards');
        $I->wait(5);
        // Yotpo sync issue causes this to display either 200 or 214 half the time, verify visually until workaround
        //$I->see('269', '//*[@id="rewards-you-have-points"]/div/h1/span[2]/span');
        // Log out
        $I->click('/html/body/header/div[2]/div[1]/div[3]/div[2]/div/div[1]/div[2]/a');
        $I->wait(5);
    }

}
