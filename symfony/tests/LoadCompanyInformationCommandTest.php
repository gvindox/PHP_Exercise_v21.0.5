<?php
declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\LoadCompanyInformationCommand;
use App\Datahub\DatahubCompanyModel;
use App\Entity\CompanyInformation;
use App\Nasdaq\Client;
use App\Repository\CompanyInformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class LoadCompanyInformationCommandTest extends TestCase
{
    public function testExecute()
    {
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $client = $this->createMock(Client::class);
        $repository = $this->createMock(CompanyInformationRepository::class);

        $application = new Application();
        $application->add(new LoadCompanyInformationCommand($entityManager, $client, $repository));

        $command = $application->find('app:load-company-information');
        $commandTester = new CommandTester($command);

        $companyModels = [
            new DatahubCompanyModel('Apple Inc.', 'AAPL'),
        ];

        $client->expects($this->once())
            ->method('getCompanies')
            ->willReturn($companyModels);

        $repository->method('findBySymbol')
            ->willReturn(null);

        $entityManager->expects($this->exactly(count($companyModels)))
            ->method('persist')
            ->with(
                $this->callback(function (CompanyInformation $companyInformation) {
                    return $companyInformation->getSymbol() === 'AAPL' &&
                        $companyInformation->getCompanyName() === 'Apple Inc.';
                })
            );

        $entityManager->method('flush');

        $commandTester->execute([
            'command' => $command->getName(),
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Starting to load company information...', $output);
        $this->assertStringContainsString('Company information successfully uploaded', $output);
    }
}

