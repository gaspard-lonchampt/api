<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220118153653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `belongTo` (category_id INT NOT NULL, program_id INT NOT NULL, INDEX IDX_DF8D8D5C12469DE2 (category_id), INDEX IDX_DF8D8D5C3EB8070A (program_id), PRIMARY KEY(category_id, program_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE program (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, hosted_by VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `favoriteBy` (program_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_F0B54E543EB8070A (program_id), INDEX IDX_F0B54E54A76ED395 (user_id), PRIMARY KEY(program_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `showtimebb` (id INT AUTO_INCREMENT NOT NULL, program_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, created_at DATETIME NOT NULL, hosted_by VARCHAR(255) DEFAULT NULL, guest LONGTEXT DEFAULT NULL, INDEX IDX_4EFD5C4C3EB8070A (program_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `belongTo` ADD CONSTRAINT FK_DF8D8D5C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `belongTo` ADD CONSTRAINT FK_DF8D8D5C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `favoriteBy` ADD CONSTRAINT FK_F0B54E543EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `favoriteBy` ADD CONSTRAINT FK_F0B54E54A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `showtimebb` ADD CONSTRAINT FK_4EFD5C4C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `belongTo` DROP FOREIGN KEY FK_DF8D8D5C12469DE2');
        $this->addSql('ALTER TABLE `belongTo` DROP FOREIGN KEY FK_DF8D8D5C3EB8070A');
        $this->addSql('ALTER TABLE `favoriteBy` DROP FOREIGN KEY FK_F0B54E543EB8070A');
        $this->addSql('ALTER TABLE `showtimebb` DROP FOREIGN KEY FK_4EFD5C4C3EB8070A');
        $this->addSql('ALTER TABLE `favoriteBy` DROP FOREIGN KEY FK_F0B54E54A76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE `belongTo`');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE `favoriteBy`');
        $this->addSql('DROP TABLE `showtimebb`');
        $this->addSql('DROP TABLE `user`');
    }
}
