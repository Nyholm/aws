<?php

namespace AsyncAws\Cognito\Tests\Unit\Result;

use AsyncAws\Cognito\Result\AdminGetUserResponse;
use AsyncAws\Core\Response;
use AsyncAws\Core\Test\Http\SimpleMockedResponse;
use AsyncAws\Core\Test\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\MockHttpClient;

class AdminGetUserResponseTest extends TestCase
{
    public function testAdminGetUserResponse(): void
    {
        self::fail('Not implemented');

        // see https://docs.aws.amazon.com/cognito/latest/APIReference/API_AdminGetUser.html
        $response = new SimpleMockedResponse('{
            "change": "it"
        }');

        $client = new MockHttpClient($response);
        $result = new AdminGetUserResponse(new Response($client->request('POST', 'http://localhost'), $client, new NullLogger()));

        self::assertSame('changeIt', $result->getUsername());
        // self::assertTODO(expected, $result->getUserAttributes());
        // self::assertTODO(expected, $result->getUserCreateDate());
        // self::assertTODO(expected, $result->getUserLastModifiedDate());
        self::assertFalse($result->getEnabled());
        self::assertSame('changeIt', $result->getUserStatus());
        // self::assertTODO(expected, $result->getMFAOptions());
        self::assertSame('changeIt', $result->getPreferredMfaSetting());
        // self::assertTODO(expected, $result->getUserMFASettingList());
    }
}
