<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\ArgumentResolver;

use Eobuwie\Recruitment\Ui\Api\Exception\ArgumentResolver\RequestResolverException;
use Eobuwie\Recruitment\Ui\Api\Exception\ArgumentResolver\ValidationException;
use Eobuwie\Recruitment\Ui\Api\Request\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

final class RequestDtoResolver implements ArgumentValueResolverInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $type = $argument->getType();
        Assert::string($type);

        return is_subclass_of($type, RequestInterface::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $class = $argument->getType();

        try {
            $dto = new $class($request);
        } catch (\TypeError $e) {
            throw new RequestResolverException(Response::HTTP_BAD_REQUEST);
        }

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        yield $dto;
    }
}
