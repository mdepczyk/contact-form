<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\Controller\ContactForm;

use Eobuwie\Recruitment\Ui\Api\Request\ContactForm\SendRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

final class SendAction
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(SendRequest $sendFormRequest): JsonResponse
    {
        $this->bus->dispatch($sendFormRequest->getCommand());

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}
