<?php

namespace AsyncAws\Cognito\Tests\Unit;

use AsyncAws\Cognito\CognitoClient;
use AsyncAws\Cognito\Result\AdminGetUserResponse;
use AsyncAws\Cognito\Result\AdminUpdateUserAttributesResponse;
use AsyncAws\Cognito\Result\GetUserResponse;
use AsyncAws\Cognito\Result\UpdateUserAttributesResponse;
use AsyncAws\Cognito\ValueObject\AdminGetUserRequest;
use AsyncAws\Cognito\ValueObject\AdminUpdateUserAttributesRequest;
use AsyncAws\Cognito\ValueObject\AttributeType;
use AsyncAws\Cognito\ValueObject\GetUserRequest;
use AsyncAws\Cognito\ValueObject\UpdateUserAttributesRequest;
use AsyncAws\Core\Credentials\NullProvider;
use AsyncAws\Core\Test\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;

class CognitoClientTest extends TestCase
{
    public function testAdminGetUser(): void
    {
        $client = new CognitoClient([], new NullProvider(), new MockHttpClient());

        $input = new AdminGetUserRequest([
            'UserPoolId' => 'change me',
            'Username' => 'change me',
        ]);
        $result = $client->AdminGetUser($input);

        self::assertInstanceOf(AdminGetUserResponse::class, $result);
        self::assertFalse($result->info()['resolved']);
    }

    public function testAdminUpdateUserAttributes(): void
    {
        $client = new CognitoClient([], new NullProvider(), new MockHttpClient());

        $input = new AdminUpdateUserAttributesRequest([
            'UserPoolId' => 'change me',
            'Username' => 'change me',
            'UserAttributes' => [new AttributeType([
                'Name' => 'change me',
                'Value' => 'change me',
            ])],

        ]);
        $result = $client->AdminUpdateUserAttributes($input);

        self::assertInstanceOf(AdminUpdateUserAttributesResponse::class, $result);
        self::assertFalse($result->info()['resolved']);
    }

    public function testGetUser(): void
    {
        $client = new CognitoClient([], new NullProvider(), new MockHttpClient());

        $input = new GetUserRequest([
            'AccessToken' => 'change me',
        ]);
        $result = $client->GetUser($input);

        self::assertInstanceOf(GetUserResponse::class, $result);
        self::assertFalse($result->info()['resolved']);
    }

    public function testUpdateUserAttributes(): void
    {
        $client = new CognitoClient([], new NullProvider(), new MockHttpClient());

        $input = new UpdateUserAttributesRequest([
            'UserAttributes' => [new AttributeType([
                'Name' => 'change me',
                'Value' => 'change me',
            ])],
            'AccessToken' => 'change me',

        ]);
        $result = $client->UpdateUserAttributes($input);

        self::assertInstanceOf(UpdateUserAttributesResponse::class, $result);
        self::assertFalse($result->info()['resolved']);
    }
}
