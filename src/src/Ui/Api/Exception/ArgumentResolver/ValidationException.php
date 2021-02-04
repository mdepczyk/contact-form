<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\Exception\ArgumentResolver;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationException extends RequestResolverException
{
    private ConstraintViolationListInterface $violations;

    public function __construct(ConstraintViolationListInterface $violations)
    {
        parent::__construct(Response::HTTP_BAD_REQUEST);
        $this->violations = $violations;
    }

    public function toArray(): array
    {
        return ['errors' => [
            'message' => 'Request is not valid.',
            'violations' => $this->violationsToArray($this->violations),
        ]];
    }

    private function violationsToArray(ConstraintViolationListInterface $violations): array
    {
        $errors = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            if (!isset($errors[$violation->getPropertyPath()])) {
                $errors[$violation->getPropertyPath()] = [];
            }

            $errors[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return $errors;
    }
}
