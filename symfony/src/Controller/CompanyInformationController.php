<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CompanyInformationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyInformationController extends AbstractController
{
    #[Route('', name: 'app_company_information')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CompanyInformationFormType::class);
        $form->handleRequest($request);

        return $this->render(
            'index.html.twig',
            [
                'form' => $form
            ]
        );
    }
}
