<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416121824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE associer (id INT AUTO_INCREMENT NOT NULL, couleur_id INT DEFAULT NULL, meuble_id INT DEFAULT NULL, stock INT NOT NULL, INDEX IDX_FA230DB9C31BA576 (couleur_id), INDEX IDX_FA230DB9E1780C00 (meuble_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meuble_categorie (meuble_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_46DAC972E1780C00 (meuble_id), INDEX IDX_46DAC972BCF5E72D (categorie_id), PRIMARY KEY(meuble_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE associer ADD CONSTRAINT FK_FA230DB9C31BA576 FOREIGN KEY (couleur_id) REFERENCES couleur (id)');
        $this->addSql('ALTER TABLE associer ADD CONSTRAINT FK_FA230DB9E1780C00 FOREIGN KEY (meuble_id) REFERENCES meuble (id)');
        $this->addSql('ALTER TABLE meuble_categorie ADD CONSTRAINT FK_46DAC972E1780C00 FOREIGN KEY (meuble_id) REFERENCES meuble (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meuble_categorie ADD CONSTRAINT FK_46DAC972BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE associer DROP FOREIGN KEY FK_FA230DB9C31BA576');
        $this->addSql('ALTER TABLE associer DROP FOREIGN KEY FK_FA230DB9E1780C00');
        $this->addSql('ALTER TABLE meuble_categorie DROP FOREIGN KEY FK_46DAC972E1780C00');
        $this->addSql('ALTER TABLE meuble_categorie DROP FOREIGN KEY FK_46DAC972BCF5E72D');
        $this->addSql('DROP TABLE associer');
        $this->addSql('DROP TABLE meuble_categorie');
    }
}
