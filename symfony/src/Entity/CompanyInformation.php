<?php

namespace App\Entity;

use App\Repository\CompanyInformationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Unique;

#[ORM\Entity(repositoryClass: CompanyInformationRepository::class)]
#[ORM\Index(columns: ['symbol'], name: 'company_symbol_idx')]
class CompanyInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $companyName = null;

    #[ORM\Column(length: 5, unique: true)]
    #[Unique]
    private ?string $symbol = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }
}
