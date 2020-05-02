<?php

namespace AsyncAws\Cognito\Tests\Unit\Result;

use AsyncAws\Cognito\Result\AdminUpdateUserAttributesResponse;
use AsyncAws\Core\Response;
use AsyncAws\Core\Test\Http\SimpleMockedResponse;
use AsyncAws\Core\Test\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\MockHttpClient;

class AdminUpdateUserAttributesResponseTest extends TestCase
{
    public function testAdminUpdateUserAttributesResponse(): void
    {
        self::fail('Not implemented');

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_AdminUpdateUserAttributes.html
        $response = new SimpleMockedResponse('{
            "change": "it"
        }');

        $client = new MockHttpClient($response);
        $result = new AdminUpdateUserAttributesResponse(new Response($client->request('POST', 'http://localhost'), $client, new NullLogger()));
    }
}
