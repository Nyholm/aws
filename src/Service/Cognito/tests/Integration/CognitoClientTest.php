<?php

namespace AsyncAws\Cognito\Tests\Integration;

use AsyncAws\Cognito\CognitoClient;
use AsyncAws\Cognito\Input\AdminGetUserRequest;
use AsyncAws\Cognito\Input\AdminUpdateUserAttributesRequest;
use AsyncAws\Cognito\Input\GetUserRequest;
use AsyncAws\Cognito\Input\UpdateUserAttributesRequest;
use AsyncAws\Cognito\ValueObject\AttributeType;
use AsyncAws\Core\Credentials\NullProvider;
use AsyncAws\Core\Test\TestCase;

class CognitoClientTest extends TestCase
{
    public function testAdminGetUser(): void
    {
        $client = $this->getClient();

        $input = new AdminGetUserRequest([
            'UserPoolId' => 'change me',
            'Username' => 'change me',
        ]);
        $result = $client->AdminGetUser($input);

        $result->resolve();

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

    public function testAdminUpdateUserAttributes(): void
    {
        $client = $this->getClient();

        $input = new AdminUpdateUserAttributesRequest([
            'UserPoolId' => 'change me',
            'Username' => 'change me',
            'UserAttributes' => [new AttributeType([
                'Name' => 'change me',
                'Value' => 'change me',
            ])],
            'ClientMetadata' => ['change me' => 'change me'],
        ]);
        $result = $client->AdminUpdateUserAttributes($input);

        $result->resolve();
    }

    public function testGetUser(): void
    {
        $client = $this->getClient();

        $input = new GetUserRequest([
            'AccessToken' => 'change me',
        ]);
        $result = $client->GetUser($input);

        $result->resolve();

        self::assertSame('changeIt', $result->getUsername());
        // self::assertTODO(expected, $result->getUserAttributes());
        // self::assertTODO(expected, $result->getMFAOptions());
        self::assertSame('changeIt', $result->getPreferredMfaSetting());
        // self::assertTODO(expected, $result->getUserMFASettingList());
    }

    public function testUpdateUserAttributes(): void
    {
        $client = $this->getClient();

        $input = new UpdateUserAttributesRequest([
            'UserAttributes' => [new AttributeType([
                'Name' => 'change me',
                'Value' => 'change me',
            ])],
            'AccessToken' => 'change me',
            'ClientMetadata' => ['change me' => 'change me'],
        ]);
        $result = $client->UpdateUserAttributes($input);

        $result->resolve();

        // self::assertTODO(expected, $result->getCodeDeliveryDetailsList());
    }

    private function getClient(): CognitoClient
    {
        self::fail('Not implemented');

        return new CognitoClient([
            'endpoint' => 'http://localhost',
        ], new NullProvider());
    }
}
