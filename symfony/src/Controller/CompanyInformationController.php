<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CompanyInformationFormType;
use App\Form\CompanyInformationModel;
use App\HistoricalData\HistoricalDataServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyInformationController extends AbstractController
{
    public function __construct(private HistoricalDataServiceInterface $historicalDataService)
    {
    }

    #[Route('', name: 'index_page_form')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(CompanyInformationFormType::class);
        $form->handleRequest($request);

        return $this->renderPage($form);
    }

    private function renderPage(FormInterface $form): Response
    {
        $renderPage = $this->renderIndexPage($form);

        if ($this->isNeedToRenderHistoricalDataPage($form)) {
            $renderPage = $this->renderHistoricalDataPage($form);
        }

        return $renderPage;
    }

    private function renderIndexPage(FormInterface $form): Response
    {
        return $this->render(
            'index.html.twig',
            [
                'form' => $form
            ]
        );
    }

    private function renderHistoricalDataPage(FormInterface $form): Response
    {
        $historicalData = $this->historicalDataService->getHistoricalData($form->getData());

        return $this->render(
            'historical-data.html.twig',
            [
                'historical_data' => $historicalData
            ]
        );
    }

    private function isNeedToRenderHistoricalDataPage(FormInterface $form): bool
    {
        return $form->isSubmitted() && $form->isValid() && $form->getData() instanceof CompanyInformationModel;
    }
}
