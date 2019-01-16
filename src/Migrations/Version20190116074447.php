<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116074447 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disponibiliter ADD jour_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE disponibiliter ADD CONSTRAINT FK_C7F4780A220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7F4780A220C6AD0 ON disponibiliter (jour_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE disponibiliter DROP FOREIGN KEY FK_C7F4780A220C6AD0');
        $this->addSql('DROP INDEX UNIQ_C7F4780A220C6AD0 ON disponibiliter');
        $this->addSql('ALTER TABLE disponibiliter DROP jour_id');
    }
}
