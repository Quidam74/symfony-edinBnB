<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116080232 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipement ADD bien_id INT NOT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F3BD95B80F ON equipement (bien_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3BD95B80F');
        $this->addSql('DROP INDEX IDX_B8B4C6F3BD95B80F ON equipement');
        $this->addSql('ALTER TABLE equipement DROP bien_id');
    }
}
