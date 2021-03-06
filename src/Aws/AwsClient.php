<?php

declare(strict_types=1);

namespace AsyncAws\Aws;

use AsyncAws\Aws\Exception\MissingDependency;
use AsyncAws\Aws\Exception\RuntimeException;
use AsyncAws\S3\S3Client;
use AsyncAws\Ses\SesClient;
use AsyncAws\Sqs\SqsClient;

/**
 * Base API client that instantiate other API classes if needed.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class AwsClient extends AbstractApi
{
    /**
     * @var array
     */
    private $serviceCache;

    public function s3(): S3Client
    {
        if (!class_exists(S3Client::class)) {
            throw MissingDependency::create('async-aws/s3', 'S3');
        }

        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new S3Client($this->httpClient, $this->configuration);
        }

        return $this->serviceCache[__METHOD__];
    }

    public function ses(): SesClient
    {
        if (!class_exists(SesClient::class)) {
            throw MissingDependency::create('async-aws/ses', 'SES');
        }

        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new SesClient($this->httpClient, $this->configuration);
        }

        return $this->serviceCache[__METHOD__];
    }

    public function sns(): SnsClient
    {
        if (!class_exists(SnsClient::class)) {
            throw MissingDependency::create('async-aws/sns', 'SNS');
        }

        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new SnsClient($this->httpClient, $this->configuration);
        }

        return $this->serviceCache[__METHOD__];
    }

    public function sqs(): SqsClient
    {
        if (!class_exists(SqsClient::class)) {
            throw MissingDependency::create('async-aws/sqs', 'SQS');
        }

        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new SqsClient($this->httpClient, $this->configuration);
        }

        return $this->serviceCache[__METHOD__];
    }

    protected function getServiceCode(): string
    {
        // This will never work on the base API. .
        throw new RuntimeException(sprintf('The $endpoint parameter is required on "%s::request()".', __CLASS__));
    }
}
