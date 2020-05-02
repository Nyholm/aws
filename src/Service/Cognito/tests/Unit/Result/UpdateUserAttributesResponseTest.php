<?php

namespace AsyncAws\Cognito\Tests\Unit\Result;

use AsyncAws\Cognito\Result\UpdateUserAttributesResponse;
use AsyncAws\Core\Response;
use AsyncAws\Core\Test\Http\SimpleMockedResponse;
use AsyncAws\Core\Test\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\MockHttpClient;

class UpdateUserAttributesResponseTest extends TestCase
{
    public function testUpdateUserAttributesResponse(): void
    {
        self::fail('Not implemented');

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_UpdateUserAttributes.html
        $response = new SimpleMockedResponse('{
            "change": "it"
        }');

        $client = new MockHttpClient($response);
        $result = new UpdateUserAttributesResponse(new Response($client->request('POST', 'http://localhost'), $client, new NullLogger()));

        // self::assertTODO(expected, $result->getCodeDeliveryDetailsList());
    }
}
