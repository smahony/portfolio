<?php

/**
 * @group ourExperts
 */
class OurExpertsCest
{
    public function _before(WebDriverTester $I)
    {
    }
    public function _after(WebDriverTester $I)
    {
    }

    /**
     * @dataProvider ourExpertsList
     */
    public function OurExperts(
        \WebDriverTester $I,
        \Codeception\Example $example)
    {
        $I->amOnPage('/our-experts');
        $I->wait(2);
        $I->moveMouseOver('/html/body/main/div/div/article['.($example['article']).']/div[1]/div[1]/h1/a');
        $I->click('/html/body/main/div/div/article['.($example['article']).']/div[1]/div[1]/h1/a');
        $I->canSeeCurrentUrlEquals($example['url']);
        $I->wait(2);
        $I->seeInTitle($example['title']);
    }

    /**
     * @return array
     */
    protected function ourExpertsList()
    {
        return [
            ['article' => '1', 'url'=>"/about-us/our-experts/aida-garcia/", 'title'=>"Aida Garcia, Author at TheTot"],
            ['article' => '2', 'url'=>"/about-us/our-experts/ali-handley/", 'title'=>"Ali Handley"],
            ['article' => '3', 'url'=>"/about-us/our-experts/anastasia-moloney/", 'title'=>"Anastasia Moloney"],
            ['article' => '4', 'url'=>"/about-us/our-experts/andrea-baum/", 'title'=>"Andrea Baum"],
            ['article' => '5', 'url'=>"/about-us/our-experts/andrea-speir/", 'title'=>"Andrea Speir"],
            ['article' => '6', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"],
            ['article' => '7', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"],
            ['article' => '8', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"],
            ['article' => '9', 'url'=>"/about-us/our-experts/calgary-avansino/", 'title'=>"Calgary Avansino"],
            ['article' => '10', 'url'=>"/about-us/our-experts/carley-mendes/", 'title'=>"Carley Mendes"],
            ['article' => '11', 'url'=>"/about-us/our-experts/cathey-stoner/", 'title'=>"Cathey Stoner"],
            ['article' => '12', 'url'=>"/about-us/our-experts/christina-clemer/", 'title'=>"Christina Clemer"],
            ['article' => '13', 'url'=>"/about-us/our-experts/dr-abigail-gewirtz/", 'title'=>"Dr. Abigail Gewirtz"],
            ['article' => '14', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"],
            ['article' => '15', 'url'=>"/about-us/our-experts/dr-deepika-chopra/", 'title'=>"Dr. Deepika Chopra"],
            ['article' => '16', 'url'=>"/about-us/our-experts/dr-don-klumb/", 'title'=>"Dr. Don Klumb"],
            ['article' => '17', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"],
            ['article' => '18', 'url'=>"/about-us/our-experts/hannah-cassedy/", 'title'=>"Hannah Cassedy, Author at TheTot"],
            ['article' => '19', 'url'=>"/about-us/our-experts/dr-juli-fraga/", 'title'=>"Dr Juli Fraga, Author at TheTot"],
            ['article' => '20', 'url'=>"/about-us/our-experts/julie-linderman/", 'title'=>"Julie Linderman, Author at TheTot"],
            ['article' => '21', 'url'=>"/about-us/our-experts/dr-samantha-radford/", 'title'=>"Dr. Samantha Radford"],
            ['article' => '22', 'url'=>"/about-us/our-experts/dr-sheryl-ziegler/", 'title'=>"Dr. Sheryl Ziegler"],
            ['article' => '23', 'url'=>"/about-us/our-experts/erica-watson/", 'title'=>"Erica Watson"],
            ['article' => '24', 'url'=>"/about-us/our-experts/gavin-mccormack/", 'title'=>"Gavin McCormack"],
            ['article' => '25', 'url'=>"/about-us/our-experts/georgie-abay/", 'title'=>"Georgie Abay"],
            ['article' => '26', 'url'=>"/about-us/our-experts/heather-sundell/", 'title'=>"Heather Sundell"],
            ['article' => '27', 'url'=>"/about-us/our-experts/irina-webb/", 'title'=>"Irina Webb"],
            ['article' => '28', 'url'=>"/about-us/our-experts/jenny-ringland/", 'title'=>"Jenny Ringland"],
            ['article' => '29', 'url'=>"/about-us/our-experts/josie-bouchier/", 'title'=>"Josie Bouchier"],
            ['article' => '30', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"],
            ['article' => '31', 'url'=>"/about-us/our-experts/laura-mclaughlin/", 'title'=>"Laura McLaughlin"],
            ['article' => '32', 'url'=>"/about-us/our-experts/lauren-bingham/", 'title'=>"Lauren Bingham"],
            ['article' => '33', 'url'=>"/about-us/our-experts/lauren-olson/", 'title'=>"Lauren Olson"],
            ['article' => '34', 'url'=>"/about-us/our-experts/lindsay-haskell/", 'title'=>"Lindsay Haskell"],
            ['article' => '35', 'url'=>"/about-us/our-experts/lyndsey-harper/", 'title'=>"Lyndsey Harper, Author at TheTot"],
            ['article' => '36', 'url'=>"/about-us/our-experts/magdalene-liacopoulos/", 'title'=>"Magdalene Liacopoulos"],
            ['article' => '37', 'url'=>"/about-us/our-experts/mary-cantwell/", 'title'=>"Mary Cantwell"],
            ['article' => '38', 'url'=>"/about-us/our-experts/melanie-dimmitt/", 'title'=>"Melanie Dimmitt"],
            ['article' => '39', 'url'=>"/about-us/our-experts/niccola-drake/", 'title'=>"Niccola Drake"],
            ['article' => '40', 'url'=>"/about-us/our-experts/paavani-ayurveda/", 'title'=>"Paavani Ayurveda, Author at TheTot"],
            ['article' => '41', 'url'=>"/about-us/our-experts/rebecca-agi/", 'title'=>"Rebecca Agi"],
            ['article' => '42', 'url'=>"/about-us/our-experts/rebecca-fraser-thill/", 'title'=>"Rebecca Fraser-Thill"],
            ['article' => '43', 'url'=>"/about-us/our-experts/sabrina-rogers-anderson/", 'title'=>"Sabrina Rogers-Anderson"],
            ['article' => '44', 'url'=>"/about-us/our-experts/sarah-siebold/", 'title'=>"Sarah Siebold"],
            ['article' => '45', 'url'=>"/about-us/our-experts/shanicia-boswell/", 'title'=>"Shanicia Boswell, Author at TheTot"],
            ['article' => '46', 'url'=>"/about-us/our-experts/steph-gouin/", 'title'=>"Steph Gouin"],
            ['article' => '47', 'url'=>"/our-experts/", 'title'=>"Our Experts - TheTot"]
        ];
    }
}