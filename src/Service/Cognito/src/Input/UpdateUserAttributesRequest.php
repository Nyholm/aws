<?php

namespace AsyncAws\Cognito\Input;

use AsyncAws\Cognito\ValueObject\AttributeType;
use AsyncAws\Core\Exception\InvalidArgument;
use AsyncAws\Core\Input;
use AsyncAws\Core\Request;
use AsyncAws\Core\Stream\StreamFactory;

final class UpdateUserAttributesRequest extends Input
{
    /**
     * An array of name-value pairs representing user attributes.
     *
     * @required
     *
     * @var AttributeType[]
     */
    private $UserAttributes;

    /**
     * The access token for the request to update user attributes.
     *
     * @required
     *
     * @var string|null
     */
    private $AccessToken;

    /**
     * A map of custom key-value pairs that you can provide as input for any custom workflows that this action triggers.
     *
     * @var string[]
     */
    private $ClientMetadata;

    /**
     * @param array{
     *   UserAttributes?: \AsyncAws\Cognito\ValueObject\AttributeType[],
     *   AccessToken?: string,
     *   ClientMetadata?: string[],
     *   @region?: string,
     * } $input
     */
    public function __construct(array $input = [])
    {
        $this->UserAttributes = array_map([AttributeType::class, 'create'], $input['UserAttributes'] ?? []);
        $this->AccessToken = $input['AccessToken'] ?? null;
        $this->ClientMetadata = $input['ClientMetadata'] ?? [];
        parent::__construct($input);
    }

    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getAccessToken(): ?string
    {
        return $this->AccessToken;
    }

    /**
     * @return string[]
     */
    public function getClientMetadata(): array
    {
        return $this->ClientMetadata;
    }

    /**
     * @return AttributeType[]
     */
    public function getUserAttributes(): array
    {
        return $this->UserAttributes;
    }

    /**
     * @internal
     */
    public function request(): Request
    {
        // Prepare headers
        $headers = [
            'Content-Type' => 'application/x-amz-json-1.1',
            'X-Amz-Target' => 'AWSCognitoIdentityProviderService.UpdateUserAttributes',
        ];

        // Prepare query
        $query = [];

        // Prepare URI
        $uriString = '/';

        // Prepare Body
        $bodyPayload = $this->requestBody();
        $body = empty($bodyPayload) ? '{}' : json_encode($bodyPayload);

        // Return the Request
        return new Request('POST', $uriString, $query, $headers, StreamFactory::create($body));
    }

    public function setAccessToken(?string $value): self
    {
        $this->AccessToken = $value;

        return $this;
    }

    /**
     * @param string[] $value
     */
    public function setClientMetadata(array $value): self
    {
        $this->ClientMetadata = $value;

        return $this;
    }

    /**
     * @param AttributeType[] $value
     */
    public function setUserAttributes(array $value): self
    {
        $this->UserAttributes = $value;

        return $this;
    }

    private function requestBody(): array
    {
        $payload = [];

        $index = -1;
        foreach ($this->UserAttributes as $listValue) {
            ++$index;
            $payload['UserAttributes'][$index] = $listValue->requestBody();
        }

        if (null === $v = $this->AccessToken) {
            throw new InvalidArgument(sprintf('Missing parameter "AccessToken" for "%s". The value cannot be null.', __CLASS__));
        }
        $payload['AccessToken'] = $v;

        foreach ($this->ClientMetadata as $name => $v) {
            $payload['ClientMetadata'][$name] = $v;
        }

        return $payload;
    }
}
