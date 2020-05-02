<?php

namespace AsyncAws\Cognito;

use AsyncAws\Cognito\Input\AdminGetUserRequest;
use AsyncAws\Cognito\Input\AdminUpdateUserAttributesRequest;
use AsyncAws\Cognito\Input\GetUserRequest;
use AsyncAws\Cognito\Input\UpdateUserAttributesRequest;
use AsyncAws\Cognito\Result\AdminGetUserResponse;
use AsyncAws\Cognito\Result\AdminUpdateUserAttributesResponse;
use AsyncAws\Cognito\Result\GetUserResponse;
use AsyncAws\Cognito\Result\UpdateUserAttributesResponse;
use AsyncAws\Core\AbstractApi;
use AsyncAws\Core\RequestContext;

class CognitoClient extends AbstractApi
{
    /**
     * Gets the specified user by user name in a user pool as an administrator. Works on any user.
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cognito-idp-2016-04-18.html#admingetuser
     *
     * @param array{
     *   UserPoolId: string,
     *   Username: string,
     *   @region?: string,
     * }|AdminGetUserRequest $input
     */
    public function adminGetUser($input): AdminGetUserResponse
    {
        $input = AdminGetUserRequest::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'AdminGetUser', 'region' => $input->getRegion()]));

        return new AdminGetUserResponse($response);
    }

    /**
     * Updates the specified user's attributes, including developer attributes, as an administrator. Works on any user.
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cognito-idp-2016-04-18.html#adminupdateuserattributes
     *
     * @param array{
     *   UserPoolId: string,
     *   Username: string,
     *   UserAttributes: \AsyncAws\Cognito\ValueObject\AttributeType[],
     *   ClientMetadata?: string[],
     *   @region?: string,
     * }|AdminUpdateUserAttributesRequest $input
     */
    public function adminUpdateUserAttributes($input): AdminUpdateUserAttributesResponse
    {
        $input = AdminUpdateUserAttributesRequest::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'AdminUpdateUserAttributes', 'region' => $input->getRegion()]));

        return new AdminUpdateUserAttributesResponse($response);
    }

    /**
     * Gets the user attributes and metadata for a user.
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cognito-idp-2016-04-18.html#getuser
     *
     * @param array{
     *   AccessToken: string,
     *   @region?: string,
     * }|GetUserRequest $input
     */
    public function getUser($input): GetUserResponse
    {
        $input = GetUserRequest::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'GetUser', 'region' => $input->getRegion()]));

        return new GetUserResponse($response);
    }

    /**
     * Allows a user to update a specific attribute (one at a time).
     *
     * @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-cognito-idp-2016-04-18.html#updateuserattributes
     *
     * @param array{
     *   UserAttributes: \AsyncAws\Cognito\ValueObject\AttributeType[],
     *   AccessToken: string,
     *   ClientMetadata?: string[],
     *   @region?: string,
     * }|UpdateUserAttributesRequest $input
     */
    public function updateUserAttributes($input): UpdateUserAttributesResponse
    {
        $input = UpdateUserAttributesRequest::create($input);
        $response = $this->getResponse($input->request(), new RequestContext(['operation' => 'UpdateUserAttributes', 'region' => $input->getRegion()]));

        return new UpdateUserAttributesResponse($response);
    }

    protected function getServiceCode(): string
    {
        return 'cognito-idp';
    }

    protected function getSignatureScopeName(): string
    {
        return 'cognito-idp';
    }

    protected function getSignatureVersion(): string
    {
        return 'v4';
    }
}
