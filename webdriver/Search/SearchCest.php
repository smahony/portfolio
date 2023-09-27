<?php

/**
 * @group search
 */
class SearchCest
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

    public function search(
        WebDriverTester $I
    ) {
        $searchTerm = 'hart+land'; // define search term here
        $pagesResult = '//*[@id="klevuCmsContentArea"]/ul/li';
        $productsResult = '//*[@id="productList"]/div[3]/ul/li';

        $I->click('//*[@id="search"]');
        $I->wait(5);
        $I->canSeeElement('//*[@id="klevuSearchingArea"]');
        $I->see("POPULAR SEARCHES");
        $I->fillField('//*[@id="search"]', $searchTerm);
        $I->wait(10);
        $I->see('SUGGESTIONS'); // note that not all search results will return SUGGESTIONS e.g. "safety"
        $I->see($searchTerm);
        $I->see('PAGES'); // note that not all search results will return matching Pages results
        $I->canSeeElement($pagesResult.'[1]'); // 1st 3 results
        $I->canSeeElement($pagesResult.'[2]');
        $I->canSeeElement($pagesResult.'[3]');
        $I->see('PRODUCTS');
        $I->canSeeElement($productsResult.'[1]'); // 1st 3 results
        $I->canSeeElement($productsResult.'[2]');
        $I->canSeeElement($productsResult.'[3]');
        $I->see('View All');
        $I->moveMouseOver('//*[@id="klevuSearchingArea"]/div/div/section[2]/div[1]/div/div[2]/a');
        $I->click('//*[@id="klevuSearchingArea"]/div/div/section[2]/div[1]/div/div[2]/a'); // //*[@id="klevuSearchingArea"]/div/div/section[2]/div[1]/div/div[2]/a
        $I->wait(10);
        $I->seeInCurrentUrl('/?perPage=48&page=1&sortBy=RELEVANCE&s='.$searchTerm.''); // need a workaround for multiple-word search terms with space e.g. %20 in url
        $I->canSeeElement('/html/body/main/div/div/div[2]/div[1]/div/div/div[1]');
        $I->see('Category');
        $I->see('Color');
        $I->see('Age');
        $I->see('CATEGORY');
        $I->see('Brand');
        $I->see('Gender');
        $I->see('Price Range');
        $I->canSeeElement('/html/body/main/div/div/div[2]/div[1]/div/div/div[2]/div[2]/section/div'); // Products list
    }
}