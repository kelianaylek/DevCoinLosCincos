<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210211160144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers_likes (id INT AUTO_INCREMENT NOT NULL, answers_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3916CBAE79BF1BCE (answers_id), INDEX IDX_3916CBAEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers_likes ADD CONSTRAINT FK_3916CBAE79BF1BCE FOREIGN KEY (answers_id) REFERENCES answers (id)');
        $this->addSql('ALTER TABLE answers_likes ADD CONSTRAINT FK_3916CBAEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answers DROP answer_likes');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE answers_likes');
        $this->addSql('ALTER TABLE answers ADD answer_likes INT NOT NULL');
    }
}
