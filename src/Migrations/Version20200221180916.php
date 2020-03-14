<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200221180916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, montant VARCHAR(255) NOT NULL, frais VARCHAR(255) NOT NULL, client_emetteur VARCHAR(255) NOT NULL, type_piece_emetteur VARCHAR(255) NOT NULL, numero_piece_emetteur VARCHAR(255) NOT NULL, date_envoi DATE NOT NULL, telephone_emetteur VARCHAR(255) NOT NULL, commission_emetteur DOUBLE PRECISION NOT NULL, date_retrait DATE NOT NULL, client_recepteur VARCHAR(255) NOT NULL, type_piece_recepteur VARCHAR(255) NOT NULL, telephone_recepteur VARCHAR(255) NOT NULL, numero_piece_recepteur VARCHAR(255) NOT NULL, commission_recepteur DOUBLE PRECISION NOT NULL, commission_systeme DOUBLE PRECISION NOT NULL, taxe_etats DOUBLE PRECISION NOT NULL, status TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transaction');
    }
}
