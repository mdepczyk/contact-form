<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Api\Request\ContactForm;

use Eobuwie\Recruitment\Application\Command\CommandInterface;
use Eobuwie\Recruitment\Application\Command\ContactForm\SendCommand;
use Eobuwie\Recruitment\Ui\Api\Request\RequestInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

final class SendRequest implements RequestInterface
{
    /**
     * @Assert\NotBlank
     */
    private string $name;
    /**
     * @Assert\NotBlank
     * @Assert\Email
     */
    private string $email;
    /**
     * @Assert\NotBlank
     */
    private string $message;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name', '');
        $this->email = $request->request->get('email', '');
        $this->message = $request->request->get('message', '');
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

    public function getCommand(): CommandInterface
    {
        return new SendCommand($this->getName(), $this->getEmail(), $this->getMessage());
    }
}
