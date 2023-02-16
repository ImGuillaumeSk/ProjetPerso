<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216105523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media RENAME INDEX idx_6a2ca10ca76ed395 TO IDX_6A2CA10C60BB6FE6');
        $this->addSql('ALTER TABLE watched_media DROP date_added');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media RENAME INDEX idx_6a2ca10c60bb6fe6 TO IDX_6A2CA10CA76ED395');
        $this->addSql('ALTER TABLE watched_media ADD date_added DATETIME NOT NULL');
    }
}
