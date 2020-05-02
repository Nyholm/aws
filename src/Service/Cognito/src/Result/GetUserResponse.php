<?php

namespace AsyncAws\Cognito\Result;

use AsyncAws\Cognito\ValueObject\AttributeType;
use AsyncAws\Cognito\ValueObject\MFAOptionType;
use AsyncAws\Core\Response;
use AsyncAws\Core\Result;

class GetUserResponse extends Result
{
    /**
     * The user name of the user you wish to retrieve from the get user request.
     */
    private $Username;

    /**
     * An array of name-value pairs representing user attributes.
     */
    private $UserAttributes = [];

    /**
     * *This response parameter is no longer supported.* It provides information only about SMS MFA configurations. It
     * doesn't provide information about TOTP software token MFA configurations. To look up information about either type of
     * MFA configuration, use the use the GetUserResponse$UserMFASettingList response instead.
     */
    private $MFAOptions = [];

    /**
     * The user's preferred MFA setting.
     */
    private $PreferredMfaSetting;

    /**
     * The MFA options that are enabled for the user. The possible values in this list are `SMS_MFA` and
     * `SOFTWARE_TOKEN_MFA`.
     */
    private $UserMFASettingList = [];

    /**
     * @return MFAOptionType[]
     */
    public function getMFAOptions(): array
    {
        $this->initialize();

        return $this->MFAOptions;
    }

    public function getPreferredMfaSetting(): ?string
    {
        $this->initialize();

        return $this->PreferredMfaSetting;
    }

    /**
     * @return AttributeType[]
     */
    public function getUserAttributes(): array
    {
        $this->initialize();

        return $this->UserAttributes;
    }

    /**
     * @return string[]
     */
    public function getUserMFASettingList(): array
    {
        $this->initialize();

        return $this->UserMFASettingList;
    }

    public function getUsername(): string
    {
        $this->initialize();

        return $this->Username;
    }

    protected function populateResult(Response $response): void
    {
        $data = $response->toArray();

        $this->Username = (string) $data['Username'];
        $this->UserAttributes = (function (array $json): array {
            $items = [];
            foreach ($json as $item) {
                $items[] = new AttributeType([
                    'Name' => (string) $item['Name'],
                    'Value' => isset($item['Value']) ? (string) $item['Value'] : null,
                ]);
            }

            return $items;
        })($data['UserAttributes']);
        $this->MFAOptions = empty($data['MFAOptions']) ? [] : (function (array $json): array {
            $items = [];
            foreach ($json as $item) {
                $items[] = new MFAOptionType([
                    'DeliveryMedium' => isset($item['DeliveryMedium']) ? (string) $item['DeliveryMedium'] : null,
                    'AttributeName' => isset($item['AttributeName']) ? (string) $item['AttributeName'] : null,
                ]);
            }

            return $items;
        })($data['MFAOptions']);
        $this->PreferredMfaSetting = isset($data['PreferredMfaSetting']) ? (string) $data['PreferredMfaSetting'] : null;
        $this->UserMFASettingList = empty($data['UserMFASettingList']) ? [] : (function (array $json): array {
            $items = [];
            foreach ($json as $item) {
                $a = isset($item) ? (string) $item : null;
                if (null !== $a) {
                    $items[] = $a;
                }
            }

            return $items;
        })($data['UserMFASettingList']);
    }
}
