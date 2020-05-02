<?php

namespace AsyncAws\Cognito\Tests\Unit\Result;

use AsyncAws\Cognito\Result\GetUserResponse;
use AsyncAws\Core\Response;
use AsyncAws\Core\Test\Http\SimpleMockedResponse;
use AsyncAws\Core\Test\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\MockHttpClient;

class GetUserResponseTest extends TestCase
{
    public function testGetUserResponse(): void
    {
        self::fail('Not implemented');

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_GetUser.html
        $response = new SimpleMockedResponse('{
            "change": "it"
        }');

        $client = new MockHttpClient($response);
        $result = new GetUserResponse(new Response($client->request('POST', 'http://localhost'), $client, new NullLogger()));

        self::assertSame('changeIt', $result->getUsername());
        // self::assertTODO(expected, $result->getUserAttributes());
        // self::assertTODO(expected, $result->getMFAOptions());
        self::assertSame('changeIt', $result->getPreferredMfaSetting());
        // self::assertTODO(expected, $result->getUserMFASettingList());
    }
}
