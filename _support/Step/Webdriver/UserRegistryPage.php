<?php

namespace Step\Webdriver;

class UserRegistryPage extends \WebDriverTester
{
    const TIMEOUT = 30;

    public $userRegistryUrl = '/user-baby-registry/registry-signup-7/'; //signup-5 on dev signup-7 on staging

    public $addRegistryProductToCartButton = '/html/body/div[1]/div/div[1]/div[4]/div[1]/div[3]/div[4]/div/form/div/div[2]/div/button';
    public $viewCartButton = 'a.button.wc-forward';

    public function addRegistryProductToCart($context = null)
    {
        $I = $this;

        $I->amOnPageWithoutStickyHeader($this->userRegistryUrl);
        $I->scrollTo($this->addRegistryProductToCartButton);
        $I->click($this->addRegistryProductToCartButton);
        $I->waitForElement($this->viewCartButton, self::TIMEOUT);
    }
}
