<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217103446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "live_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE program_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "belongTo" (category_id INT NOT NULL, program_id INT NOT NULL, PRIMARY KEY(category_id, program_id))');
        $this->addSql('CREATE INDEX IDX_DF8D8D5C12469DE2 ON "belongTo" (category_id)');
        $this->addSql('CREATE INDEX IDX_DF8D8D5C3EB8070A ON "belongTo" (program_id)');
        $this->addSql('CREATE TABLE "live" (id INT NOT NULL, program_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, hosted_by VARCHAR(255) DEFAULT NULL, guest TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_530F2CAF3EB8070A ON "live" (program_id)');
        $this->addSql('CREATE TABLE program (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, hosted_by VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "favoriteBy" (program_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(program_id, user_id))');
        $this->addSql('CREATE INDEX IDX_F0B54E543EB8070A ON "favoriteBy" (program_id)');
        $this->addSql('CREATE INDEX IDX_F0B54E54A76ED395 ON "favoriteBy" (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('ALTER TABLE "belongTo" ADD CONSTRAINT FK_DF8D8D5C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "belongTo" ADD CONSTRAINT FK_DF8D8D5C3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "live" ADD CONSTRAINT FK_530F2CAF3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "favoriteBy" ADD CONSTRAINT FK_F0B54E543EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "favoriteBy" ADD CONSTRAINT FK_F0B54E54A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "belongTo" DROP CONSTRAINT FK_DF8D8D5C12469DE2');
        $this->addSql('ALTER TABLE "belongTo" DROP CONSTRAINT FK_DF8D8D5C3EB8070A');
        $this->addSql('ALTER TABLE "live" DROP CONSTRAINT FK_530F2CAF3EB8070A');
        $this->addSql('ALTER TABLE "favoriteBy" DROP CONSTRAINT FK_F0B54E543EB8070A');
        $this->addSql('ALTER TABLE "favoriteBy" DROP CONSTRAINT FK_F0B54E54A76ED395');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "live_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE program_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE "belongTo"');
        $this->addSql('DROP TABLE "live"');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE "favoriteBy"');
        $this->addSql('DROP TABLE "user"');
    }
}
