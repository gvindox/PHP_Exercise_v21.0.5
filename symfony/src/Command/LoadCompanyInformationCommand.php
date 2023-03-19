<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\CompanyInformation;
use App\Nasdaq\Client;
use App\Nasdaq\CompanyModel;
use App\Repository\CompanyInformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:load-company-information',
    description: 'Load company information to database',
)]
class LoadCompanyInformationCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private Client $client,
        private CompanyInformationRepository $companyInformationRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->warning('Starting to load company information...');
        $companyModels = $this->client->getCompanies();
        $progressBar = new ProgressBar($output);

        $this->loadCompanyInformation($progressBar, $companyModels);

        $io->success('Company information successfully uploaded');

        return Command::SUCCESS;
    }

    private function loadCompanyInformation(ProgressBar $progressBar, array $companyModels): void
    {
        $entityCount = 0;
        /** @var CompanyModel $companyModel */
        foreach ($progressBar->iterate($companyModels) as $companyModel) {
            $companyInformation = $this->companyInformationRepository->findOneBy(
                ['symbol' => $companyModel->getSymbol()]
            );

            if (!$companyInformation) {
                $companyInformation = new CompanyInformation();
            }

            $companyInformation
                ->setCompanyName($companyModel->getCompanyName())
                ->setSymbol($companyModel->getSymbol());

            $this->entityManager->persist($companyInformation);

            if ($entityCount % 30 === 0) {
                $this->entityManager->flush();
            }
        }

        $this->entityManager->flush();
    }
}
