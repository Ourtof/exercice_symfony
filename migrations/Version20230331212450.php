<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230331212450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C14B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_64C19C14B89032C ON category (post_id)');
        $this->addSql('ALTER TABLE tag ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag ADD CONSTRAINT FK_389B7834B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_389B7834B89032C ON tag (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C14B89032C');
        $this->addSql('DROP INDEX IDX_64C19C14B89032C ON category');
        $this->addSql('ALTER TABLE category DROP post_id');
        $this->addSql('ALTER TABLE tag DROP FOREIGN KEY FK_389B7834B89032C');
        $this->addSql('DROP INDEX IDX_389B7834B89032C ON tag');
        $this->addSql('ALTER TABLE tag DROP post_id');
    }
}
