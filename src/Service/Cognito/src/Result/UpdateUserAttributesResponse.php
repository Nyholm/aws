<?php

namespace AsyncAws\Cognito\Result;

use AsyncAws\Cognito\ValueObject\CodeDeliveryDetailsType;
use AsyncAws\Core\Response;
use AsyncAws\Core\Result;

class UpdateUserAttributesResponse extends Result
{
    /**
     * The code delivery details list from the server for the request to update user attributes.
     */
    private $CodeDeliveryDetailsList = [];

    /**
     * @return CodeDeliveryDetailsType[]
     */
    public function getCodeDeliveryDetailsList(): array
    {
        $this->initialize();

        return $this->CodeDeliveryDetailsList;
    }

    protected function populateResult(Response $response): void
    {
        $data = $response->toArray();

        $this->CodeDeliveryDetailsList = empty($data['CodeDeliveryDetailsList']) ? [] : (function (array $json): array {
            $items = [];
            foreach ($json as $item) {
                $items[] = new CodeDeliveryDetailsType([
                    'Destination' => isset($item['Destination']) ? (string) $item['Destination'] : null,
                    'DeliveryMedium' => isset($item['DeliveryMedium']) ? (string) $item['DeliveryMedium'] : null,
                    'AttributeName' => isset($item['AttributeName']) ? (string) $item['AttributeName'] : null,
                ]);
            }

            return $items;
        })($data['CodeDeliveryDetailsList']);
    }
}
