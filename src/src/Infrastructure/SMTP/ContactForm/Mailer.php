<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Infrastructure\SMTP\ContactForm;

use Eobuwie\Recruitment\Domain\ContactForm\ContactFormData;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

final class Mailer
{
    private const SUBJECT = 'Message from contact from';

    private MailerInterface $mailer;
    private string $receiver;

    public function __construct(MailerInterface $mailer, string $receiver)
    {
        $this->mailer = $mailer;
        $this->receiver = $receiver;
    }

    public function send(ContactFormData $contactFormData): void
    {
        $addressFrom = (new Address($contactFormData->getEmail(), $contactFormData->getName()));
        $addressTo = (new Address($this->receiver));

        $email = (new Email())
            ->addFrom($addressFrom)
            ->addTo($addressTo)
            ->subject(self::SUBJECT)
            ->text($contactFormData->getMessage());

        $this->mailer->send($email);
    }
}
