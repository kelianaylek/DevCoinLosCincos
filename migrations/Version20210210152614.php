<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210152614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, question_id_id INT NOT NULL, answer_title VARCHAR(255) NOT NULL, answer_description VARCHAR(255) NOT NULL, answer_author VARCHAR(255) NOT NULL, answer_date DATETIME NOT NULL, answer_likes INT NOT NULL, answer_code_1 LONGTEXT DEFAULT NULL, answer_code_2 LONGTEXT DEFAULT NULL, answer_code_3 LONGTEXT DEFAULT NULL, answer_code_4 LONGTEXT DEFAULT NULL, answer_code_5 LONGTEXT DEFAULT NULL, INDEX IDX_50D0C6064FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6064FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE answers');
    }
}
