<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230319165125_CompanyInformation extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE company_information_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE company_information (id INT NOT NULL, company_name VARCHAR(255) NOT NULL, symbol VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_30A8A01BECC836F9 ON company_information (symbol)');
        $this->addSql('CREATE INDEX company_symbol_idx ON company_information (symbol)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE company_information_id_seq CASCADE');
        $this->addSql('DROP TABLE company_information');
    }
}
