<?php

namespace Step\Webdriver\Checkout;

class Confirmation extends \WebDriverTester
{
    public function checkShippingAddress($shippingName, $address)
    {
        $I = $this;

        $I->see($shippingName, '.woocommerce-column--shipping-address');
        $I->see($address, '.woocommerce-column--shipping-address');
    }

    public function checkBillingDetails($billingName, $email, $zipcode = '')
    {
        $I = $this;
        $I->see($billingName, '.woocommerce-column--billing-address');
        $I->see($email, '.woocommerce-column--billing-address');
        $I->see($zipcode, '.woocommerce-column--billing-address');
    }

    public function checkKlarnaBillingDetails($billingName, $number, $email = '')
    {
        $I = $this;
        $I->see($billingName, '.woocommerce-column--billing-address');
        $I->see($number, '.woocommerce-column--billing-address');
        $I->see($email, '.woocommerce-column--billing-address');
    }

    public function checkAmazonBillingDetails($billingName, $number, $email = '')
    {
        $I = $this;
        $I->see($billingName, '.woocommerce-column--billing-address');
        $I->see($number, '.woocommerce-column--billing-address');
        $I->see($email, '.woocommerce-column--billing-address');
    }

    public function checkAmazonGiftCardBillingDetails($billingName, $number, $email = '')
    {
        $I = $this;
        $I->see($billingName, '.woocommerce-customer-details');
        $I->see($number, '.woocommerce-customer-details');
        $I->see($email, '.woocommerce-customer-details');
    }

    public function checkOrderTotals($orderTotal, $tax = '', $shippingText = '')
    {
        $I = $this;

        $I->see($orderTotal, '.order_details');
    }

    public function checkGiftWrapFee($giftWrapFee)
    {
        $I = $this;

        $I->see($giftWrapFee, '.order_details');
    }
}
