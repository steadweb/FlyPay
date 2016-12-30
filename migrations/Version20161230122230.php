<?php

namespace Steadweb\Flypay\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161230122230 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE flypay__cards (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', last4 VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flypay__locations (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flypay__payments (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', card_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', location_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', amount INT NOT NULL, gratuity INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_ACF128984ACC9A20 (card_id), INDEX IDX_ACF1289864D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flypay__payments_tables (payment_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', table_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_384585F24C3A3BB (payment_id), INDEX IDX_384585F2ECFF285C (table_id), PRIMARY KEY(payment_id, table_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE flypay__tables (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', seats INT NOT NULL, created DATETIME NOT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE flypay__payments ADD CONSTRAINT FK_ACF128984ACC9A20 FOREIGN KEY (card_id) REFERENCES flypay__cards (id)');
        $this->addSql('ALTER TABLE flypay__payments ADD CONSTRAINT FK_ACF1289864D218E FOREIGN KEY (location_id) REFERENCES flypay__locations (id)');
        $this->addSql('ALTER TABLE flypay__payments_tables ADD CONSTRAINT FK_384585F24C3A3BB FOREIGN KEY (payment_id) REFERENCES flypay__payments (id)');
        $this->addSql('ALTER TABLE flypay__payments_tables ADD CONSTRAINT FK_384585F2ECFF285C FOREIGN KEY (table_id) REFERENCES flypay__tables (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE flypay__payments DROP FOREIGN KEY FK_ACF128984ACC9A20');
        $this->addSql('ALTER TABLE flypay__payments DROP FOREIGN KEY FK_ACF1289864D218E');
        $this->addSql('ALTER TABLE flypay__payments_tables DROP FOREIGN KEY FK_384585F24C3A3BB');
        $this->addSql('ALTER TABLE flypay__payments_tables DROP FOREIGN KEY FK_384585F2ECFF285C');
        $this->addSql('DROP TABLE flypay__cards');
        $this->addSql('DROP TABLE flypay__locations');
        $this->addSql('DROP TABLE flypay__payments');
        $this->addSql('DROP TABLE flypay__payments_tables');
        $this->addSql('DROP TABLE flypay__tables');
    }
}
