<?php

namespace Step\Webdriver\Checkout;

class Klarna extends \WebDriverTester
{
    public function klarnaCheckout()
    {
        $I = $this;
        $I->switchToNextTab();
        $I->wait(15);
        $I->switchToIFrame('#klarna-apf-iframe');
        $I->wait(4);
        $I->click('//*[@id="onContinue"]/div/div[1]');
        $I->wait(4);
        $I->fillField('//*[@id="otp_field"]', '123456');
        $I->wait(4);
        $I->click('//*[@id="onContinue"]/div/div[1]');
        $I->wait(4);
        $I->fillField('//*[@id="addressCollector-date_of_birth"]', '01011980');
        $I->click('//*[@id="terms_checkbox__box"]');
        $I->wait(4);
        $I->click('//*[@id="lb_brand_name"]/div/div/div/div[3]/div/div[2]/div[2]/div[1]/button/div/div[1]');
        $I->wait(4);
        $I->click('//*[@id="btn_not_now"]/div/div[1]');
        $I->wait(4);
        $I->click('//*[@id="dialog"]/div/div/div/div[3]/div/div[2]/div[2]/div[1]/button/div/div[1]');
        $I->wait(4);
        $I->click('//*[@id="dialog"]/div/div/div/div[3]/div/div[2]/div[2]/div[1]/button/div/div[1]');
        $I->wait(4);

        $I->switchToIFrame('#payment-gateway-frame');
        $I->wait(2);
        for ($i = 0; $i < 8; $i++) {
            $I->appendField('cardNumber', '42');
            $I->wait(0.4);
        }
        $I->fillField('#expire', '0123');
        $I->wait(0.5);
        $I->fillField('#securityCode', '123');
        $I->wait(4);
        $I->switchToNextTab();
        $I->switchToIFrame('#klarna-apf-iframe'); //
        $I->moveMouseOver('//*[@id="payinparts_kp.7587c835-97ed-4bef-8035-c7739a9ac15f_4_slice_it_by_card-card-collection-continue-button"]/div/div[1]');
        $I->click('//*[@id="payinparts_kp.7587c835-97ed-4bef-8035-c7739a9ac15f_4_slice_it_by_card-card-collection-continue-button"]/div/div[1]');
        $I->wait(4);
        $I->click('//*[@id="root"]/div[2]/div[3]/div/div[2]/button/div/div[1]');
        $I->wait(4);
        $I->click('//*[@id="dialog"]/div/div/div/div[3]/div/div[2]/div[2]/div[2]/button/div/div[1]');
    }
}