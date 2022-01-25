<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125094709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('DROP INDEX IDX_1193CB3FF5B7AF75');
        $this->addSql('DROP INDEX IDX_1193CB3F9395C3F3');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_address AS SELECT customer_id, address_id FROM customer_address');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('CREATE TABLE customer_address (customer_id INTEGER NOT NULL, address_id INTEGER NOT NULL, PRIMARY KEY(customer_id, address_id), CONSTRAINT FK_1193CB3F9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1193CB3FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO customer_address (customer_id, address_id) SELECT customer_id, address_id FROM __temp__customer_address');
        $this->addSql('DROP TABLE __temp__customer_address');
        $this->addSql('CREATE INDEX IDX_1193CB3FF5B7AF75 ON customer_address (address_id)');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL COLLATE BINARY, headers CLOB NOT NULL COLLATE BINARY, queue_name VARCHAR(255) NOT NULL COLLATE BINARY, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_1193CB3F9395C3F3');
        $this->addSql('DROP INDEX IDX_1193CB3FF5B7AF75');
        $this->addSql('CREATE TEMPORARY TABLE __temp__customer_address AS SELECT customer_id, address_id FROM customer_address');
        $this->addSql('DROP TABLE customer_address');
        $this->addSql('CREATE TABLE customer_address (customer_id INTEGER NOT NULL, address_id INTEGER NOT NULL, PRIMARY KEY(customer_id, address_id))');
        $this->addSql('INSERT INTO customer_address (customer_id, address_id) SELECT customer_id, address_id FROM __temp__customer_address');
        $this->addSql('DROP TABLE __temp__customer_address');
        $this->addSql('CREATE INDEX IDX_1193CB3F9395C3F3 ON customer_address (customer_id)');
        $this->addSql('CREATE INDEX IDX_1193CB3FF5B7AF75 ON customer_address (address_id)');
    }
}
