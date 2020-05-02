<?php

namespace AsyncAws\Cognito\Tests\Unit\Input;

use AsyncAws\Cognito\Input\UpdateUserAttributesRequest;
use AsyncAws\Cognito\ValueObject\AttributeType;
use AsyncAws\Core\Test\TestCase;

class UpdateUserAttributesRequestTest extends TestCase
{
    public function testRequest(): void
    {
        self::fail('Not implemented');

        $input = new UpdateUserAttributesRequest([
            'UserAttributes' => [new AttributeType([
                'Name' => 'change me',
                'Value' => 'change me',
            ])],
            'AccessToken' => 'change me',
            'ClientMetadata' => ['change me' => 'change me'],
        ]);

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_UpdateUserAttributes.html
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
