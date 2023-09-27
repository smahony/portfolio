<?php

/**
 * @group articles
 */
class FeaturedArticlesCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    /**
     * @dataProvider articlesPageOne
     */
    public function articlePagesOne(
        \WebDriverTester $I,
        \Codeception\Example $example)
    {
        $I->amOnPage('/featured');
        $I->wait(5);
        $I->scrollTo('/html/body/main/div/div/article['.($example['article']).']/div[2]/div[2]/h3/a');
        $I->moveMouseOver('/html/body/main/div/div/article['.($example['article']).']/div[2]/div[2]/h3/a');
        $I->click('/html/body/main/div/div/article['.($example['article']).']/div[2]/div[2]/h3/a');
        $I->canSeeCurrentUrlEquals($example['url']);
        $I->wait(3);
        $I->seeInTitle($example['title']);
    }

    /**
     * @return array
     */
    protected function articlesPageOne()
    {
        return [
            ['article' => '1', 'url'=>"/featured/the-wonder-of-small-world-play/", 'title'=>"The Wonder of Small World Play - TheTot"],
            ['article' => '2', 'url'=>"/pregnancy-and-fertility/how-to-keep-intimacy-in-marriage/", 'title'=>"How To Keep Intimacy In Marriage - TheTot"],
            // div outlier ['article' => '3', 'url'=>"/product/hart-land-womens-pima-cotton-pj-set-bunnies-and-carrots/?attribute_pa_size=s", 'title'=>"10 of The Best Toys For Gross Motor Skills - TheTot"],
            ['article' => '4', 'url'=>"/baby/10-of-the-best-toys-for-gross-motor-skills-test/", 'title'=>"10 of The Best Toys For Gross Motor Skills - TheTot"],
            // div outlier ['article' => '5', 'url'=>"/featured/see-our-best-outdoor-toys/", 'title'=>"See our Best Outdoor Toys "],
            // div outlier ['article' => '6', 'url'=>"/featured/can-birth-order-influence-your-personality-test/", 'title'=>"Being Mama: Amy Webb"],
            // div outlier ['article' => '7', 'url'=>" ", 'title'=>" "],
            // div outlier ['article' => '8', 'url'=>" ", 'title'=>" "],
            // div outlier ['article' => '9', 'url'=>" ", 'title'=>" "],
            ['article' => '10', 'url'=>"/mama/being-mama-amy-webb/", 'title'=>"Being Mama: Amy Webb"]
        ];
    }
}