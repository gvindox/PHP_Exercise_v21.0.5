<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\CompanyInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompanyInformation>
 *
 * @method CompanyInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompanyInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompanyInformation[]    findAll()
 * @method CompanyInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompanyInformation::class);
    }

    public function save(CompanyInformation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompanyInformation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBySymbol(string $symbol): ?CompanyInformation
    {
        return $this->findOneBy(['symbol' => $symbol]);
    }
}
