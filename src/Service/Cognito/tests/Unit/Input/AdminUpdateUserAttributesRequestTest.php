<?php

namespace AsyncAws\Cognito\Tests\Unit\Input;

use AsyncAws\Cognito\Input\AdminUpdateUserAttributesRequest;
use AsyncAws\Cognito\ValueObject\AttributeType;
use AsyncAws\Core\Test\TestCase;

class AdminUpdateUserAttributesRequestTest extends TestCase
{
    public function testRequest(): void
    {
        self::fail('Not implemented');

        $input = new AdminUpdateUserAttributesRequest([
            'UserPoolId' => 'change me',
            'Username' => 'change me',
            'UserAttributes' => [new AttributeType([
                'Name' => 'change me',
                'Value' => 'change me',
            ])],
            'ClientMetadata' => ['change me' => 'change me'],
        ]);

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_AdminUpdateUserAttributes.html
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
