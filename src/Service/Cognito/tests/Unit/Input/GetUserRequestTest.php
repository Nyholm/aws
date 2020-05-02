<?php

namespace AsyncAws\Cognito\Tests\Unit\Input;

use AsyncAws\Cognito\Input\GetUserRequest;
use AsyncAws\Core\Test\TestCase;

class GetUserRequestTest extends TestCase
{
    public function testRequest(): void
    {
        self::fail('Not implemented');

        $input = new GetUserRequest([
            'AccessToken' => 'change me',
        ]);

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_GetUser.html
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
