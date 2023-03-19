<?php

namespace App\Controller;

use App\Form\CompanyInformationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyInformationController extends AbstractController
{
    #[Route('', name: 'app_company_information')]
    public function index(): Response
    {
        $form = $this->createForm(CompanyInformationFormType::class);

        return $this->render(
            'index.html.twig',
            [
                'form' => $form
            ]
        );
    }
}
