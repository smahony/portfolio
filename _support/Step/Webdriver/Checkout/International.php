<?php

namespace Step\Webdriver\Checkout;

use Codeception\Util\Locator;

class International extends \WebDriverTester
{
    public function fillGuestCheckout($email)
    {
        $I = $this;
        $I->fillField('register_email', $email);
    }

    public function clickToShipping()
    {
        $I = $this;
        $I->wait(1);
        $I->click('.checkout-goto-shipping');
    }

    public function fillShippingDetailsSE()
    {
        $I = $this;

        $I->fillField("//input[@name='shipping_first_name']", "Hugh");
        $I->fillField("//input[@name='shipping_last_name']", "Jackman");
        $I->seeInField("//input[@name='shipping_country']", "SE");
        $I->fillField("//input[@name='shipping_address_1']", "Nils Ericssons Plan 4");
        $I->fillField("//input[@name='shipping_city']", "Stockholm");
        //$I->selectOption("//select[@name='shipping_state']", "Norrmalm");
        $I->fillField("//input[@name='shipping_postcode']", "111 64");
        $I->fillField("//input[@name='shipping_phone']", "12345567");
        $I->wait(4);
    }

    public function fillShippingDetailsUK()
    {
        $I = $this;

        $I->fillField("//input[@name='shipping_first_name']", "Hugh");
        $I->fillField("//input[@name='shipping_last_name']", "Jackman");
        $I->seeInField("//input[@name='shipping_country']", "GB");
        $I->fillField("//input[@name='shipping_address_1']", "20 Middlesex Street");
        $I->fillField("//input[@name='shipping_city']", "London");
        //$I->selectOption("//select[@name='shipping_state']", "Norrmalm");
        $I->fillField("//input[@name='shipping_postcode']", "E1 7EX");
        $I->fillField("//input[@name='shipping_phone']", "12345567");
        $I->wait(4);
    }

    public function fillShippingDetailsCA()
    {
        $I = $this;

        $I->fillField("//input[@name='shipping_first_name']", "Hugh");
        $I->fillField("//input[@name='shipping_last_name']", "Jackman");
        $I->seeInField("//input[@name='shipping_country']", "CA");
        $I->fillField("//input[@name='shipping_address_1']", "4 Avenue Rd, Toronto");
        $I->fillField("//input[@name='shipping_city']", "Toronto");
        $I->click('//*[@id="select2-shipping_state-container"]');
        $I->wait(8);
        $I->selectOption("//select[@name='shipping_state']", "Ontario"); // //*[@id="select2-shipping_state-container"]
        $I->fillField("//input[@name='shipping_postcode']", "ON M5R 2E8");
        $I->fillField("//input[@name='shipping_phone']", "12345567");
        $I->wait(4);
    }

    public function chooseSameBilling()
    {
        $I = $this;
        $I->wait(1);
        $I->fillField("billing-and-shipping", "same");
        $I->wait(1);
    }

    public function clickToPayment()
    {
        $I = $this;
        $I->click(".checkout-goto-payment");
        $I->wait(1);
    }

    public function fillBillingDetailsSE()
    {
        $I = $this;
        $I->fillField("//input[@name='billing_first_name']", "Hello");
        $I->fillField("//input[@name='billing_last_name']", "World!");
        $I->selectOption("//select[@name='billing_country']", "SE");
        $I->fillField("//input[@name='billing_address_1']", "Nils Ericssons Plan 4");
        $I->fillField("//input[@name='billing_city']", "Stockholm");
        //$I->selectOption("//select[@name='billing_state']", "Norrmalm");
        $I->fillField("//input[@name='billing_postcode']", "111 64");
        $I->fillField("//input[@name='billing_phone']", "12345567");
    }

    public function fillBillingDetailsUK()
    {
        $I = $this;
        $I->fillField("//input[@name='billing_first_name']", "Hello");
        $I->fillField("//input[@name='billing_last_name']", "World!");
        $I->selectOption("//select[@name='billing_country']", "GB");
        $I->fillField("//input[@name='billing_address_1']", "20 Middlesex Street");
        $I->fillField("//input[@name='billing_city']", "Stockholm");
        //$I->selectOption("//select[@name='billing_state']", "Norrmalm");
        $I->fillField("//input[@name='billing_postcode']", "E1 7EX");
        $I->fillField("//input[@name='billing_phone']", "12345567");
    }

    public function fillBillingDetailsCA()
    {
        $I = $this;

        $I->fillField("//input[@name='shipping_first_name']", "Hugh");
        $I->fillField("//input[@name='shipping_last_name']", "Jackman");
        $I->seeInField("//input[@name='shipping_country']", "CA");
        $I->fillField("//input[@name='shipping_address_1']", "4 Avenue Rd, Toronto");
        $I->fillField("//input[@name='shipping_city']", "Toronto");
        $I->selectOption("//select[@name='shipping_state']", "Ontario");
        $I->fillField("//input[@name='shipping_postcode']", "ON M5R 2E8");
        $I->fillField("//input[@name='shipping_phone']", "12345567");
        $I->wait(4);
    }

    public function fillBillingDetailsXX()
    {
        $I = $this;
        $I->fillField("//input[@name='billing_first_name']", "Hello");
        $I->fillField("//input[@name='billing_last_name']", "World!");
        $I->selectOption("//select[@name='billing_country']", "XX");
        $I->fillField("//input[@name='billing_address_1']", "Nils Ericssons Plan 4");
        $I->fillField("//input[@name='billing_city']", "Stockholm");
        //$I->selectOption("//select[@name='billing_state']", "Norrmalm");
        $I->fillField("//input[@name='billing_postcode']", "111 64");
        $I->fillField("//input[@name='billing_phone']", "12345567");
    }

    public function fillCreditCardDetailsSE()
    {
        $I = $this;

        // slowing down the filling of credit fields so stripe js can format it correctly // 40 00 00 75 20 00 00 08
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "40");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "75");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "20");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "08");
        $I->wait(0.5);

        for ($i = 0; $i < 2; $i++) {
            if ($i == 0) {
                $I->appendField("//input[@id='border_free_credit_card-card-expiry']", "10");
            } else {
                $I->appendField("//input[@id='border_free_credit_card-card-expiry']", "25");
            }

            $I->wait(0.5);
        }

        $I->wait(0.5);
        $I->fillField('border_free_credit_card-card-cvc', '123');
    }

    public function fillCreditCardDetailsUK()
    {
        $I = $this;

        // slowing down the filling of credit fields so stripe js can format it correctly // 40 00 00 82 60 00 00 00
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "40");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "82");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "60");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "00");
        $I->wait(0.5);

        for ($i = 0; $i < 2; $i++) {
            if ($i == 0) {
                $I->appendField("//input[@id='border_free_credit_card-card-expiry']", "10");
            } else {
                $I->appendField("//input[@id='border_free_credit_card-card-expiry']", "25");
            }

            $I->wait(0.5);
        }

        $I->wait(0.5);
        $I->fillField('border_free_credit_card-card-cvc', '123');
    }

    public function fillCreditCardDetailsCA()
    {
        $I = $this;

        // slowing down the filling of credit fields so stripe js can format it correctly // 40 00 00 12 40 00 00 00 371449635398431
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "37");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "14");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "49");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "63");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "53");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "98");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "43");
        $I->wait(0.5);
        $I->appendField("//input[@id='border_free_credit_card-card-number']", "1");
        $I->wait(0.5);

        for ($i = 0; $i < 2; $i++) {
            if ($i == 0) {
                $I->appendField("//input[@id='border_free_credit_card-card-expiry']", "10");
            } else {
                $I->appendField("//input[@id='border_free_credit_card-card-expiry']", "25");
            }

            $I->wait(0.5);
        }

        $I->wait(0.5);
        $I->fillField('border_free_credit_card-card-cvc', '123');
    }

    public function fillShippingDetailsXX()
    {
        $I = $this;

        $I->fillField("//input[@name='shipping_first_name']", "Hugh");
        $I->fillField("//input[@name='shipping_last_name']", "Jackman");
        $I->seeInField("//input[@name='shipping_country']", "XX");
        $I->fillField("//input[@name='shipping_address_1']", "Nils Ericssons Plan 4");
        $I->fillField("//input[@name='shipping_city']", "Stockholm");
        //$I->selectOption("//select[@name='shipping_state']", "Norrmalm");
        $I->fillField("//input[@name='shipping_postcode']", "111 64");
        $I->fillField("//input[@name='shipping_phone']", "12345567");
        $I->wait(4);
    }

    public function clickPayNow()
    {
        $I = $this;
        $I->click(".checkout-goto-confirmation");
        $I->waitForText('PAYMENT DETAILS');
    }
}
