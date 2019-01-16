<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116075824 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disponibiliter ADD bien_id INT NOT NULL');
        $this->addSql('ALTER TABLE disponibiliter ADD CONSTRAINT FK_C7F4780ABD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('CREATE INDEX IDX_C7F4780ABD95B80F ON disponibiliter (bien_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disponibiliter DROP FOREIGN KEY FK_C7F4780ABD95B80F');
        $this->addSql('DROP INDEX IDX_C7F4780ABD95B80F ON disponibiliter');
        $this->addSql('ALTER TABLE disponibiliter DROP bien_id');
    }
}
