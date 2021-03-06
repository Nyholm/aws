<?php

declare(strict_types=1);

namespace AsyncAws\Aws\Exception;

use Symfony\Component\HttpClient\Exception\HttpExceptionTrait;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;

/**
 * Represents a 5xx response.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
final class ServerException extends \RuntimeException implements HttpException, ServerExceptionInterface
{
    use HttpExceptionTrait;
}
