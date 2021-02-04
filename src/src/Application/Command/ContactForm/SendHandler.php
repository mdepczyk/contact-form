<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Application\Command\ContactForm;

use Eobuwie\Recruitment\Domain\ContactForm\ContactFormData;
use Eobuwie\Recruitment\Infrastructure\SMTP\ContactForm\Mailer;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendHandler implements MessageHandlerInterface
{
    private const SUBJECT = 'Message from contact from';

    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(SendCommand $command): void
    {
        $contactFormData = new ContactFormData($command->getName(), $command->getEmail(), $command->getMessage());

        $this->mailer->send($contactFormData);
    }
}
