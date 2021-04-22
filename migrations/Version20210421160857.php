<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421160857 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', status VARCHAR(1000) DEFAULT NULL, study_year INT DEFAULT NULL, discord_tag VARCHAR(20) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions (id INT AUTO_INCREMENT NOT NULL, question_title VARCHAR(100) NOT NULL, question_description VARCHAR(255) NOT NULL, question_is_resolved TINYINT(1) NOT NULL, question_answers INT DEFAULT NULL, question_author VARCHAR(60) NOT NULL, question_date DATETIME NOT NULL, question_code_1 LONGTEXT DEFAULT NULL, question_code_2 LONGTEXT DEFAULT NULL, question_code_3 LONGTEXT DEFAULT NULL, question_code_4 LONGTEXT DEFAULT NULL, question_code_5 LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answers (id INT AUTO_INCREMENT NOT NULL, question_id_id INT NOT NULL, answer_title VARCHAR(255) NOT NULL, answer_description VARCHAR(255) NOT NULL, answer_author VARCHAR(255) NOT NULL, answer_date DATETIME NOT NULL, answer_code_1 LONGTEXT DEFAULT NULL, answer_code_2 LONGTEXT DEFAULT NULL, answer_code_3 LONGTEXT DEFAULT NULL, answer_code_4 LONGTEXT DEFAULT NULL, answer_code_5 LONGTEXT DEFAULT NULL, INDEX IDX_50D0C6064FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6064FAF8F53 FOREIGN KEY (question_id_id) REFERENCES questions (id)');

        $this->addSql('CREATE TABLE answer_like (id INT AUTO_INCREMENT NOT NULL, answer_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_F248A373AA334807 (answer_id), INDEX IDX_F248A373A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_like ADD CONSTRAINT FK_F248A373AA334807 FOREIGN KEY (answer_id) REFERENCES answers (id)');
        $this->addSql('ALTER TABLE answer_like ADD CONSTRAINT FK_F248A373A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer_like DROP FOREIGN KEY FK_F248A373AA334807');
        $this->addSql('ALTER TABLE answers DROP FOREIGN KEY FK_50D0C6064FAF8F53');
        $this->addSql('ALTER TABLE answer_like DROP FOREIGN KEY FK_F248A373A76ED395');
        $this->addSql('DROP TABLE answer_like');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE user');
    }
}
