<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116082304 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage_jour (voyage_id INT NOT NULL, jour_id INT NOT NULL, INDEX IDX_4A85114B68C9E5AF (voyage_id), INDEX IDX_4A85114B220C6AD0 (jour_id), PRIMARY KEY(voyage_id, jour_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voyage_jour ADD CONSTRAINT FK_4A85114B68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_jour ADD CONSTRAINT FK_4A85114B220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voyage_jour DROP FOREIGN KEY FK_4A85114B68C9E5AF');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_jour');
    }
}
