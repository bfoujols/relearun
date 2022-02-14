<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120102937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE code (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, inheritance INT NOT NULL, type VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE env (id INT AUTO_INCREMENT NOT NULL, code_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_F34542F927DAFE17 (code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE state (id INT AUTO_INCREMENT NOT NULL, env_id INT DEFAULT NULL, version_id INT NOT NULL, created_date DATETIME NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_A393D2FB18AD1504 (env_id), INDEX IDX_A393D2FB4BBC2705 (version_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE version (id INT AUTO_INCREMENT NOT NULL, code_id INT NOT NULL, name VARCHAR(50) NOT NULL, create_date DATETIME NOT NULL, INDEX IDX_BF1CD3C327DAFE17 (code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE env ADD CONSTRAINT FK_F34542F927DAFE17 FOREIGN KEY (code_id) REFERENCES code (id)');
        $this->addSql('ALTER TABLE state ADD CONSTRAINT FK_A393D2FB18AD1504 FOREIGN KEY (env_id) REFERENCES env (id)');
        $this->addSql('ALTER TABLE state ADD CONSTRAINT FK_A393D2FB4BBC2705 FOREIGN KEY (version_id) REFERENCES version (id)');
        $this->addSql('ALTER TABLE version ADD CONSTRAINT FK_BF1CD3C327DAFE17 FOREIGN KEY (code_id) REFERENCES code (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE env DROP FOREIGN KEY FK_F34542F927DAFE17');
        $this->addSql('ALTER TABLE version DROP FOREIGN KEY FK_BF1CD3C327DAFE17');
        $this->addSql('ALTER TABLE state DROP FOREIGN KEY FK_A393D2FB18AD1504');
        $this->addSql('ALTER TABLE state DROP FOREIGN KEY FK_A393D2FB4BBC2705');
        $this->addSql('DROP TABLE code');
        $this->addSql('DROP TABLE env');
        $this->addSql('DROP TABLE state');
        $this->addSql('DROP TABLE version');
    }
}
