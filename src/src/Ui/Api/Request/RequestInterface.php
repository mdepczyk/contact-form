<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\Request;

use Eobuwie\Recruitment\Application\Command\CommandInterface;
use Symfony\Component\HttpFoundation\Request;

interface RequestInterface
{
    public function __construct(Request $request);

    public function getCommand(): CommandInterface;
}
