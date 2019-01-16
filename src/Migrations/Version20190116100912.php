<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116100912 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment CHANGE property_id property_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture CHANGE property_id property_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE travel CHANGE user_id user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipment CHANGE property_id property_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture CHANGE property_id property_id INT NOT NULL');
        $this->addSql('ALTER TABLE property CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE travel CHANGE user_id user_id INT NOT NULL');
    }
}
