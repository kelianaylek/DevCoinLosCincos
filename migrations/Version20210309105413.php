<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210309105413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_like (id INT AUTO_INCREMENT NOT NULL, answer_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_F248A373AA334807 (answer_id), INDEX IDX_F248A373A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, question_id_id INT NOT NULL, answer_title VARCHAR(255) NOT NULL, answer_description VARCHAR(255) NOT NULL, answer_author VARCHAR(255) NOT NULL, answer_date DATETIME NOT NULL, answer_code_1 LONGTEXT DEFAULT NULL, answer_code_2 LONGTEXT DEFAULT NULL, answer_code_3 LONGTEXT DEFAULT NULL, answer_code_4 LONGTEXT DEFAULT NULL, answer_code_5 LONGTEXT DEFAULT NULL, INDEX IDX_50D0C6064FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_like ADD CONSTRAINT FK_F248A373AA334807 FOREIGN KEY (answer_id) REFERENCES answers (id)');
        $this->addSql('ALTER TABLE answer_like ADD CONSTRAINT FK_F248A373A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6064FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');
        $this->addSql('ALTER TABLE questions ADD question_code_1 LONGTEXT DEFAULT NULL, ADD question_code_2 LONGTEXT DEFAULT NULL, ADD question_code_3 LONGTEXT DEFAULT NULL, ADD question_code_4 LONGTEXT DEFAULT NULL, ADD question_code_5 LONGTEXT DEFAULT NULL, DROP question_likes');
        $this->addSql('ALTER TABLE user ADD status VARCHAR(1000) DEFAULT NULL, ADD study_year INT DEFAULT NULL, ADD discord_tag VARCHAR(20) DEFAULT NULL, ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_like DROP FOREIGN KEY FK_F248A373AA334807');
        $this->addSql('DROP TABLE answer_like');
        $this->addSql('DROP TABLE answers');
        $this->addSql('ALTER TABLE questions ADD question_likes INT NOT NULL, DROP question_code_1, DROP question_code_2, DROP question_code_3, DROP question_code_4, DROP question_code_5');
        $this->addSql('ALTER TABLE user DROP status, DROP study_year, DROP discord_tag, DROP image');
    }
}
