<?php

/**
 * @group orderApi
 */

class createOrderCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    public function createUserViaAPI(\ApiTester $I)
    {
        $I->amHttpAuthenticated('admin', 'password');
        $I->haveHttpHeader('Content-Type', 'application/json');
        echo dirname(__FILE__) . '/_data/orderData.json';
        $orderData=file_get_contents(dirname(__FILE__) . '/_data/orderData.json');
        $I->sendPost('/dev', trim($orderData));
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 200

        $I->seeResponseContains('Message added to S3');
    }
}
