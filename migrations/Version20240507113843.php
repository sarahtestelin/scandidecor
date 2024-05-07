<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507113843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_meuble (user_id INT NOT NULL, meuble_id INT NOT NULL, INDEX IDX_D20AA0BBA76ED395 (user_id), INDEX IDX_D20AA0BBE1780C00 (meuble_id), PRIMARY KEY(user_id, meuble_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_meuble ADD CONSTRAINT FK_D20AA0BBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_meuble ADD CONSTRAINT FK_D20AA0BBE1780C00 FOREIGN KEY (meuble_id) REFERENCES meuble (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_meuble DROP FOREIGN KEY FK_D20AA0BBA76ED395');
        $this->addSql('ALTER TABLE user_meuble DROP FOREIGN KEY FK_D20AA0BBE1780C00');
        $this->addSql('DROP TABLE user_meuble');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
