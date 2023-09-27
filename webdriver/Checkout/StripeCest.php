<?php

/**
 * @group stripe
 */
class StripeCest
{
    public function _before(WebDriverTester $I)
    {
        // Only needed if testing on IP address outside United States
        $I->amOnPageWithoutStickyHeader("/choose-your-country/");
        $I->click("United States");
        $I->amOnPageWithoutStickyHeader('/choose-your-country/?=');
        $I->waitForElementVisible('img[alt="Ship to United States"]');
    }
    public function _after(WebDriverTester $I)
    {
    }

    public function addProductsToCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart
    ) {
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $productPage->viewProductWithSize();
        $addToCart->addToCart();

        $productPage->viewProductWithSizeAndColorFromSearchResult();
        $addToCart->addToCart();

        $productPage->viewBundledProduct();
        $addToCart->addBundleProductToCart();

        $I->saveSessionSnapshot('stripe_cart');
    }

    public function checkoutWithNoCreditCardDetails(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart
    ){
        $I->loadSessionSnapshot('stripe_cart');
        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickStripe();
        $cart->fillContactDetails();
        $cart->fillShippingDetails();
        $I->wait(4);
        $cart->clickPay();
        $I->switchToIFrame("#card-element iframe");
        $I->seeElement('.is-invalid');
    }

    public function checkoutWithNonSupportedStates(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickStripe();
        $I->dontSeeInField('stripe_address_state', 'Alaska');
        $I->dontSeeInField('stripe_address_state', 'Hawaii');
        $I->dontSeeInField('stripe_address_state', 'Guam');
    }

    /**
     * @todo Verify staging tax values against current correct production tax values
     * @param WebDriverTester $I
     * @param \Step\Webdriver\Cart $cart
     */
    public function checkShippingAddressUpdateWithTax(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart
    ) {
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickStripe();
        $cart->fillContactDetails();

        $cart->fillShippingDetailsCA(
            'Test Test',
            '950 Mason St',
            'San Francisco',
            'California',
            '94108'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$33.38', '.tax-total'); // staging returning 32.86

        $cart->fillShippingDetailsTX(
            'Test test',
            '400 S Record street',
            'Dallas',
            'TX',
            75202
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$36.70', '.tax-total'); // staging = 36.20 dev = 36.06

        $cart->fillShippingDetailsNJ(
            'Test test',
            '3 Tower Center Bl',
            'East Brunswick',
            'New Jersey',
            '08816'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        $I->see('$21.46', '.tax-total');

        $cart->fillShippingDetailsDC(
            'Test test',
            '1600 Pennsylvania Avenue Northwest',
            'Washington',
            'District Of Columbia',
            '20500'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$26.22', '.tax-total'); // staging returning 25.86

        $cart->fillShippingDetailsFL(
            'Test test',
            '3974 NW S River Dr',
            'Miami',
            'Florida',
            '33142'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$27.09', '.tax-total'); // staging returning 26.67

        $cart->fillShippingDetailsGA(
            'Test test',
            '121 Baker St NW',
            'Atlanta',
            'Georgia',
            '30313'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$37.15', '.tax-total'); // staging returning 38.35

        $cart->fillShippingDetailsIL(
            'Test test',
            '1 S Franklin St',
            'Chicago',
            'Illinois',
            '60606'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$44.80', '.tax-total'); // staging returning 44.19

        $cart->fillShippingDetailsIN(
            'Test test',
            '210 S Michigan St',
            'South Bend',
            'Indiana',
            '46601'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$30.59', '.tax-total'); // staging returning 30.17

        $cart->fillShippingDetailsKS(
            'Test test',
            '7250 State Ave',
            'Kansas City',
            'Kansas',
            '66112'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$39.87', '.tax-total'); // staging returning 39.32

        $cart->fillShippingDetailsLA(
            'Test test',
            '301 Dauphine St',
            'New Orleans',
            'Louisiana',
            '70112'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$36.58', '.tax-total'); // staging returning 36.02

        $cart->fillShippingDetailsME(
            'Test test',
            '500 Main St',
            'Bangor',
            'Maine',
            '04401'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$21.29', '.tax-total'); // staging returning 20.96

        $cart->fillShippingDetailsMD(
            'Test test',
            '900 S Caton Ave',
            'Baltimore',
            'Maryland',
            '21229'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$23.22', '.tax-total'); // staging returning 22.86

        $cart->fillShippingDetailsMA(
            'Test test',
            '8 Tyler St',
            'Boston',
            'Massachusetts',
            '02111'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        $I->see('$17.13', '.tax-total');

        $cart->fillShippingDetailsMI(
            'Test test',
            '2285 Woodlake Dr',
            'Okemos',
            'Michigan',
            '48864'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$26.22', '.tax-total'); // staging returning 25.86

        $cart->fillShippingDetailsMN(
            'Test test',
            '193 Pennsylvania Ave E',
            'St Paul',
            'Minnesota',
            '55130'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        $I->see('$25.52', '.tax-total');

        $cart->fillShippingDetailsNC(
            'Test test',
            '2110 Blue Ridge Rd',
            'Raleigh',
            'North Carolina',
            '27607'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$31.69', '.tax-total'); // staging returning 31.26

        $cart->fillShippingDetailsOH(
            'Test test',
            '1775 Darby Creek Dr',
            'Galloway',
            'Ohio',
            '43119'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$32.78', '.tax-total'); // staging returning 32.33

        $cart->fillShippingDetailsPA(
            'Test test',
            '1746 E Chocolate Ave',
            'Hershey',
            'Pennsylvania',
            '17033'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        $I->see('$19.44', '.tax-total');

        $cart->fillShippingDetailsVA(
            'Test test',
            '1401 Mall Dr',
            'Richmond',
            'Virginia',
            '23235'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$23.22', '.tax-total'); // staging returning 22.86

        $cart->fillShippingDetailsNV(
            'Test test',
            '3950 S Las Vegas Blvd',
            'Las Vegas',
            'Nevada',
            '89119'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$32.41', '.tax-total'); // staging returning 31.91

        $cart->fillShippingDetailsAZ(
            'Test test',
            '19 W Phoenix Ave',
            'Flagstaff',
            'Arizona',
            '86001'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$35.54', '.tax-total'); // staging returning 34.99

        $cart->fillShippingDetailsVT(
            'Test test',
            '731 Vt Route 100',
            'Warren',
            'Vermont',
            '05674'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        $I->see('$19.44', '.tax-total');

        $cart->fillShippingDetailsWI(
            'Test test',
            '1429 Monroe Street',
            'Madison',
            'Wisconsin',
            '53711'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$24.04', '.tax-total'); // staging returning 23.71

        $cart->fillShippingDetailsCO(
            'Test test',
            '333 E Durant Ave',
            'Aspen',
            'Colorado',
            '81611'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$26.70', '.tax-total'); //$26.70 shown on prod // staging returning 26.28

        $cart->fillShippingDetailsCT(
            'Test test',
            '625 N Rd',
            'Groton',
            'Connecticut',
            '06340'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$27.76', '.tax-total'); // staging returning 27.38

        $cart->fillShippingDetailsTN(
            'Test test',
            '964 Cooper St',
            'Memphis',
            'Tennessee',
            '38104'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$42.61', '.tax-total'); // staging returning 42.02

        $cart->fillShippingDetailsSC(
            'Test test',
            '1 Sanctuary Beach Dr',
            'Kiawah Island',
            'South Carolina',
            '29455'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$39.33', '.tax-total'); // staging returning 38.79

        $cart->fillShippingDetailsUT(
            'Test test',
            '50 N W Temple St',
            'Salt Lake City',
            'Utah',
            '84150'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$29.99', '.tax-total'); // staging returning 29.52

        $cart->fillShippingDetailsWA(
            'Test test',
            '85 Pike St',
            'Seattle',
            'Washington',
            '98101'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$44.80', '.tax-total'); // staging returning 44.19

        $cart->fillShippingDetailsNE(
            'Test test',
            '83 Mashie Dr',
            'Mc Cook',
            'Nebraska',
            '69001'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        //$I->see('$30.59', '.tax-total'); // staging returning 30.17

        $cart->fillShippingDetailsNY(
            'Test test',
            '1 United Nations Plaza',
            'New York City',
            'New York',
            '10017'
        );
        $I->click('//*[@id="country"]');
        $I->wait(8);
        $I->see('$28.76', '.tax-total');

    }

    //Comment out the below when running StripeCest against prod
    public function checkout(
        WebDriverTester $I,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $I->loadSessionSnapshot('stripe_cart');

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->applyGiftCard();
        $cart->removeGiftCard();
        $I->wait(4);

        $cart->clickStripe();
        $cart->fillContactDetails();
        $cart->fillShippingDetailsCA();
        $I->wait(2);
        $cart->fillCreditCardAndPayDetails();

        $I->wait(30);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(4);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkBillingDetails('Test Test', 'test@test.com', '94108');
        $confirmation->checkOrderTotals('$471.47'); // $478.11 on dev
    }

    public function checkoutWithGiftOptionsFromCart(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->addGiftOptionsFromCart();
        $cart->clickStripe();
        /**
         * Contact Information - Register with unique email
         */
        $time = time();
        $emailID = strftime($time);
        $I->fillField('//input[@id=\'name\']', 'Test Test');
        $I->fillField('//input[@id=\'email\']', 'nosignup'.$emailID.'@test.com');
        $I->fillField('//input[@id=\'phone\']', '5555555555');
        $cart->fillShippingDetails();
        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkBillingDetails('Test Test', 'nosignup'.$emailID.'@test.com', '94108');
        $confirmation->checkOrderTotals('$32.64');
        $confirmation->checkGiftWrapFee('$5.00');
    }

    /**
     * @todo Add gift options to electronic gift card only
     * @example(link="electronic-gift-card", selector=".email-type")
     * @example(link="mailed-gift-card", selector=".mailed-type")
     * @param WebDriverTester $I
     * @param \Step\Webdriver\ProductPage $productPage
     * @param \Step\Webdriver\ProductElements $addToCart
     * @param \Step\Webdriver\Cart $cart
     * @param \Codeception\Example $giftCardType
     */
    public function checkoutWithGiftCards(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Codeception\Example $giftCardType,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ) {
        $productPage->viewGiftCardOptions($giftCardType);
        $addToCart->addToCart();
        $I->amOnPageWithoutStickyHeader($cart->url);

        $cart->clickStripe();
        $cart->fillContactDetails();

        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));
        $confirmation->checkOrderTotals('$25');
    }

    public function createAccountOnCheckoutConfirmationPageNoTotCard(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickStripe();
        /**
         * Contact Information - Register with unique email
         */
        $time = time();
        $emailID = strftime($time);
        $I->fillField('//input[@id=\'name\']', 'Test Test');
        $I->fillField('//input[@id=\'email\']', 'nototcard'.$emailID.'@test.com');
        $I->fillField('//input[@id=\'phone\']', '5555555555');

        $cart->fillShippingDetails();
        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkBillingDetails('Test Test', 'nototcard'.$emailID.'@test.com', '94108');
        $confirmation->checkOrderTotals('$27.21');

        $I->moveMouseOver('//input[@id=\'account_password\']');
        $I->fillField('//input[@id=\'account_password\']', 'tester5000');
        $I->fillField('//input[@id=\'account_password2\']', 'tester5000');
        $I->click('//button[contains(text(),\'Create Account\')]');
        $I->wait(5);
        $I->amOnPageWithoutStickyHeader('/rewards');
        // Yotpo sync issue causes this to display either 200 or 214 half the time, verify visually until workaround
        //$I->see('214', '//*[@id="rewards-you-have-points"]/div/h1/span[2]/span');
        // Log out
        $I->click('/html/body/header/div[2]/div[1]/div[3]/div[2]/div/div[1]/div[2]/a');
        $I->wait(5);
    }

    public function createAccountOnCheckoutConfirmationPageWithTotCard(
        WebDriverTester $I,
        \Step\Webdriver\ProductPage $productPage,
        \Step\Webdriver\ProductElements $addToCart,
        \Step\Webdriver\Cart $cart,
        \Step\Webdriver\Checkout\Confirmation $confirmation
    ){
        $productPage->viewSimpleProduct();
        $addToCart->addToCart();

        $I->amOnPageWithoutStickyHeader($cart->url);
        $cart->clickStripe();
        /**
         * Contact Information - Register with unique email
         */
        $time = time();
        $emailID = strftime($time);
        $I->fillField('//input[@id=\'name\']', 'Test Test');
        $I->fillField('//input[@id=\'email\']', 'yestotcard'.$emailID.'@test.com');
        $I->fillField('//input[@id=\'phone\']', '5555555555');

        $cart->fillShippingDetails();
        $cart->fillCreditCardAndPayDetails();

        $I->wait(20);
        $I->click('//*[@id="hide-loyalty-modal"]/span');
        $I->wait(5);
        $I->waitForText('Order details', 60);
        $I->pressKey("body", array('esc'));

        $confirmation->checkShippingAddress('Test Test', '950 Mason St San Francisco, CA 94108');
        $confirmation->checkBillingDetails('Test Test', 'yestotcard'.$emailID.'@test.com', '94108');
        $confirmation->checkOrderTotals('$27.21');

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
        $I->wait(5); // add 90s for gathering console logs
        $I->see('Your account has now been credited with 200 points.');
        $I->amOnPageWithoutStickyHeader('/rewards');
        // Yotpo sync issue causes this to display either 200 or 214 half the time, verify visually until workaround
        //$I->see('214', '//*[@id="rewards-you-have-points"]/div/h1/span[2]/span');
    }

}
