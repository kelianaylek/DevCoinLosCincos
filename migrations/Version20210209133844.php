<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209133844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions ADD question_code_1 LONGTEXT DEFAULT NULL, ADD question_code_2 LONGTEXT DEFAULT NULL, ADD question_code_3 LONGTEXT DEFAULT NULL, ADD question_code_4 LONGTEXT DEFAULT NULL, ADD question_code_5 LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questions DROP question_code_1, DROP question_code_2, DROP question_code_3, DROP question_code_4, DROP question_code_5');
    }
}
