<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\EventSubscriber;

use Eobuwie\Recruitment\Ui\Api\Exception\ArgumentResolver\RequestResolverException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ValidationExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @return string[][]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['sendProperResponse'],
        ];
    }

    public function sendProperResponse(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if (!$exception instanceof RequestResolverException) {
            return;
        }

        $event->setResponse(new JsonResponse(
            $exception->toArray(),
            $exception->getHttpStatusCode()
        ));
    }
}
