<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Application\Command\ContactForm;

use Eobuwie\Recruitment\Application\Command\CommandInterface;

final class SendCommand implements CommandInterface
{
    private string $name;
    private string $email;
    private string $message;

    public function __construct(string $name, string $email, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
