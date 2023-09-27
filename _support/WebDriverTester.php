<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class WebDriverTester extends \Codeception\Actor
{
    use _generated\WebDriverTesterActions;
    use \Codeception\Lib\Actor\Shared\Retry;

    /**
     * Define custom actions here
     */

    public function amOnPageWithoutStickyHeader($url)
    {
        $this->amOnPage($url);
        $this->executeJS("jQuery('body').addClass('no-sticky')");
    }
}
