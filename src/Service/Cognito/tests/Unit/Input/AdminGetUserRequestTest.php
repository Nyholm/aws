<?php

namespace AsyncAws\Cognito\Tests\Unit\Input;

use AsyncAws\Cognito\Input\AdminGetUserRequest;
use AsyncAws\Core\Test\TestCase;

class AdminGetUserRequestTest extends TestCase
{
    public function testRequest(): void
    {
        self::fail('Not implemented');

        $input = new AdminGetUserRequest([
            'UserPoolId' => 'change me',
            'Username' => 'change me',
        ]);

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_AdminGetUser.html
        $expected = '
                    POST / HTTP/1.0
                    Content-Type: application/x-amz-json-1.1

                    {
            "change": "it"
        }
                ';

        self::assertRequestEqualsHttpRequest($expected, $input->request());
    }
}
