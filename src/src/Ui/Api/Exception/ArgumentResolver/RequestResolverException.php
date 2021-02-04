<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\Exception\ArgumentResolver;

class RequestResolverException extends \UnexpectedValueException
{
    private int $httpStatusCode;

    public function __construct(int $httpStatusCode)
    {
        parent::__construct();
        $this->httpStatusCode = $httpStatusCode;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function toArray(): array
    {
        return [];
    }
}
