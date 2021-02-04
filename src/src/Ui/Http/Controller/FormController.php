<?php

declare(strict_types=1);

namespace Eobuwie\Recruitment\Ui\Http\Controller;

use Eobuwie\Recruitment\Ui\Http\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class FormController extends AbstractController
{
    public function __invoke(): Response
    {
        $options = [
            'action' => $this->generateUrl('v1_contact_form_send'),
            'attr' => ['target' => '_blank'],
        ];

        return $this->render('form/new.twig', [
            'form' => $this->createForm(ContactType::class, null, $options)->createView(),
        ]);
    }
}
