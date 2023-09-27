<?php

/**
 * @group homepage
 */
class FooterCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    /**
     * @dataProvider helpAndInformationLinks
     */
    public function helpAndInformation(
        WebDriverTester $I,
        \Codeception\Example $example
    ) {
        $I->amOnPage('/');
        $I->wait(5);
        $I->scrollTo('//*[@id="navMenu0"]/a['.($example['link']).']');
        $I->moveMouseOver('//*[@id="navMenu0"]/a['.($example['link']).']');
        $I->click('//*[@id="navMenu0"]/a['.($example['link']).']');
        $I->canSeeCurrentUrlEquals($example['url']);
        $I->wait(2);
        $I->seeInTitle($example['title']);

    }

    /**
     * @return array
     */
    protected function helpAndInformationLinks()
    {
        return [
            ['link' => '1', 'url' => "/privacy-policy/", 'title' => "Privacy Policy"],
            ['link' => '2', 'url' => "/shipping-returns-policy/", 'title' => "Shipping, Returns & Sales tax policy - TheTot"],
            ['link' => '3', 'url' => "/international-orders/", 'title' => "International Orders"],
            ['link' => '4', 'url' => "/terms-of-use/", 'title' => "Terms of Use"]
        ];
    }

    /**
     * @dataProvider theTotServicesLinks
     */
    public function theTotServices(
        WebDriverTester $I,
        \Codeception\Example $example
    ) {
        $I->amOnPage('/');
        $I->wait(3);
        $I->scrollTo('//*[@id="navMenu5"]/a['.($example['link']).']');
        $I->moveMouseOver('//*[@id="navMenu5"]/a['.($example['link']).']');
        $I->click('//*[@id="navMenu5"]/a['.($example['link']).']');
        $I->canSeeCurrentUrlEquals($example['url']);
        $I->wait(2);
        $I->seeInTitle($example['title']);

    }

    /**
     * @return array
     */
    protected function theTotServicesLinks()
    {
        return [
            ['link' => '1', 'url' => "/baby-registry/", 'title' => "The Tot Baby Gift Registry - Our Non Toxic Baby Registry"],
            ['link' => '2', 'url' => "/product/the-tot-gift-card/", 'title' => "The Tot Gift Card"],
            ['link' => '3', 'url' => "/personal-gift-shopper/", 'title' => "Personal Gift Shopper"],
            ['link' => '4', 'url' => "/refer-a-friend/", 'title' => "Refer a friend - TheTot"],
            ['link' => '5', 'url' => "/klarna-info/", 'title' => "klarna info - TheTot"],
            ['link' => '6', 'url' => "/rewards/", 'title' => "Rewards - TheTot"]
        ];
    }

    /**
     * @dataProvider aboutTheTotLinks
     */
    public function aboutTheTot(
        WebDriverTester $I,
        \Codeception\Example $example
    ) {
        $I->amOnPage('/');
        $I->wait(3);
        $I->scrollTo('//*[@id="navMenu12"]/a['.($example['link']).']');
        $I->moveMouseOver('//*[@id="navMenu12"]/a['.($example['link']).']');
        $I->click('//*[@id="navMenu12"]/a['.($example['link']).']');
        $I->canSeeCurrentUrlEquals($example['url']);
        $I->wait(2);
        $I->seeInTitle($example['title']);

    }

    /**
     * @return array
     */
    protected function aboutTheTotLinks()
    {
        return [
            ['link' => '1', 'url' => "/our-story/", 'title' => "Our Mission - TheTot"],
            ['link' => '2', 'url' => "/contact-us/", 'title' => "Contact Us"],
            ['link' => '3', 'url' => "/our-experts/", 'title' => "Our Experts"]
            //['link' => '4', 'url' => "#", 'title' => "The Tot Shop"] //no link
        ];
    }

    /**
     * @dataProvider followUsLinks
     */
    public function followUs(
        WebDriverTester $I,
        \Codeception\Example $example
    ) {
        $I->amOnPage('/');
        $I->wait(3);
        $I->scrollTo('//*[@id="navMenu17"]/a['.($example['link']).']');
        $I->moveMouseOver('//*[@id="navMenu17"]/a['.($example['link']).']');
        $I->click('//*[@id="navMenu17"]/a['.($example['link']).']');
        $I->wait(2);
        $I->seeInTitle($example['title']);

    }

    /**
     * @return array
     */
    protected function followUsLinks()
    {
        return [
            ['link' => '1', 'url' => "https://www.facebook.com/thetot/", 'title' => "Facebook"],
            ['link' => '2', 'url' => "https://www.twitter.com/TheTotBaby/", 'title' => "Twitter"],
            ['link' => '3', 'url' => "https://www.instagram.com/thetot", 'title' => "Instagram"],
            ['link' => '4', 'url' => "https://www.pinterest.com/thetottot", 'title' => "Pinterest"]
        ];
    }

        public function footerSignUp(
        WebDriverTester $I
    ) {
        $I->amOnPage('/');
        $time = time();
        $emailID = strftime($time);
        $I->fillField('//*[@id="newsletter-email"]', 'footer_registration'.$emailID.'@test.com');
        $I->click('Sign up');
        $I->see('Thank you for subscribing!');
    }
}