<?php

/**
 * @group articles
 */
class BabyCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    /**
     * @dataProvider babyArticles
     */
    public function baby(
        \WebDriverTester $I,
        \Codeception\Example $example)
    {
        $I->amOnPage('/baby');
        $I->wait(5);
        $I->moveMouseOver('/html/body/main/div/div/article['.($example['article']).']');
        $I->click('/html/body/main/div/div/article['.($example['article']).']');
        $I->canSeeCurrentUrlEquals($example['url']);
        $I->wait(3);
        $I->seeInTitle($example['title']);
    }

    /**
     * @return array
     */
    protected function babyArticles()
    {
        return [
            ['article' => '1', 'url'=>"/baby/10-of-the-best-toys-for-gross-motor-skills-test/", 'title'=>"10 of The Best Toys For Gross Motor Skills - TheTot"],
            ['article' => '2', 'url'=>"/mama/4th-of-july-in-lockdown-heres-how-were-celebrating-with-our-kids/", 'title'=>"4th of July in Lockdown: Here's How We're Celebrating With Our Kids - TheTot"],
            ['article' => '3', 'url'=>"/baby/indoor-active-play-with-the-pikler-triangle-by-sprout/", 'title'=>"Indoor Active Play With The Pikler Triangle by Sprout"],
            ['article' => '4', 'url'=>"/baby/want-to-send-your-grandkids-something-extra-special-discover-these-must-have-heirloom-wooden-toys/", 'title'=>"Want To Send Your Grandkids Something Extra Special? Discover these must-have heirloom wooden toys."],
            ['article' => '5', 'url'=>"/baby/what-you-need-to-know-before-starting-cloth-diaper/", 'title'=>"What You Need to Know Before Starting Cloth Diapering"],
            ['article' => '6', 'url'=>"/baby/5-questions-to-avoid-asking-a-new-mom/", 'title'=>"5 Questions to Avoid Asking A New Mom"],
            ['article' => '7', 'url'=>"/baby/10-toys-that-encourage-imaginary-play/", 'title'=>"The Best Toys For Imaginary Play - TheTot"],
            ['article' => '8', 'url'=>"/baby/diy-baby-product-recipes/", 'title'=>"Homemade Diaper Rash Cream & Cleaning Product Recipes - TheTot"],
            ['article' => '9', 'url'=>"/baby/how-to-choose-a-highchair/", 'title'=>"How To Choose A Highchair - TheTot"],
            ['article' => '10', 'url'=>"/baby/how-to-transition-your-infant-to-a-crib/", 'title'=>"How To Transition Your Infant To A Crib - TheTot"]
        ];
    }
}