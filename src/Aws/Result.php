<?php

declare(strict_types=1);

namespace AsyncAws\Aws;

use AsyncAws\Aws\Exception\ClientException;
use AsyncAws\Aws\Exception\Exception;
use AsyncAws\Aws\Exception\NetworkException;
use AsyncAws\Aws\Exception\RedirectionException;
use AsyncAws\Aws\Exception\ServerException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * The result promise is always returned from every API call. Remember to call `resolve()` to
 * make sure the request is actually sent.
 */
class Result
{
    /**
     * @var ResponseInterface
     */
    private $response;

    private $initialized = false;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    final protected function initialize(): void
    {
        if ($this->initialized) {
            return;
        }
        $this->resolve();
        $this->populateFromResponse($this->response);
        $this->initialized = true;
    }

    protected function populateFromResponse(ResponseInterface $response): void
    {
    }

    /**
     * Make sure the actual request is executed.
     *
     * @throws Exception
     */
    public function resolve()
    {
        try {
            $statusCode = $this->response->getStatusCode();
        } catch (TransportExceptionInterface $e) {
            // When a network error occurs
            throw new NetworkException('Could not contact remote server.', 0, $e);
        }

        if (500 <= $statusCode) {
            throw new ServerException($this->response);
        }

        if (400 <= $statusCode) {
            throw new ClientException($this->response);
        }

        if (300 <= $statusCode) {
            throw new RedirectionException($this->response);
        }
    }

    public function cancel(): void
    {
        $this->response->cancel();
    }
}
