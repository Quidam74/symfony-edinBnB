<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190118081330 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, user_id INT DEFAULT NULL, description LONGTEXT NOT NULL, price INT NOT NULL, bed_room_count INT NOT NULL, bed_count INT NOT NULL, person_count INT NOT NULL, bath_room_count INT NOT NULL, UNIQUE INDEX UNIQ_8BF21CDEF5B7AF75 (address_id), INDEX IDX_8BF21CDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property_equipment (property_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_A2D7D73E549213EC (property_id), INDEX IDX_A2D7D73E517FE9FE (equipment_id), PRIMARY KEY(property_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE availability (id INT AUTO_INCREMENT NOT NULL, day_id INT DEFAULT NULL, property_id INT NOT NULL, is_available TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_3FB7A2BF9C24126 (day_id), INDEX IDX_3FB7A2BF549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(60) NOT NULL, city VARCHAR(60) NOT NULL, post_code VARCHAR(60) NOT NULL, complement VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, day DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, description VARCHAR(80) NOT NULL, url VARCHAR(40) NOT NULL, INDEX IDX_16DB4F89549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, first_name VARCHAR(60) NOT NULL, last_name VARCHAR(60) NOT NULL, email VARCHAR(60) NOT NULL, roles JSON NOT NULL, date_of_birth DATE NOT NULL, hash_password VARCHAR(255) NOT NULL, banking_reference VARCHAR(100) NOT NULL, is_traveler TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_2D0B6BCEA76ED395 (user_id), INDEX IDX_2D0B6BCE549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_day (travel_id INT NOT NULL, day_id INT NOT NULL, INDEX IDX_DCF00820ECAB15B3 (travel_id), INDEX IDX_DCF008209C24126 (day_id), PRIMARY KEY(travel_id, day_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE property_equipment ADD CONSTRAINT FK_A2D7D73E549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_equipment ADD CONSTRAINT FK_A2D7D73E517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF9C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCE549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE travel_day ADD CONSTRAINT FK_DCF00820ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE travel_day ADD CONSTRAINT FK_DCF008209C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE property_equipment DROP FOREIGN KEY FK_A2D7D73E549213EC');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF549213EC');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89549213EC');
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCE549213EC');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEF5B7AF75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF9C24126');
        $this->addSql('ALTER TABLE travel_day DROP FOREIGN KEY FK_DCF008209C24126');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEA76ED395');
        $this->addSql('ALTER TABLE travel DROP FOREIGN KEY FK_2D0B6BCEA76ED395');
        $this->addSql('ALTER TABLE travel_day DROP FOREIGN KEY FK_DCF00820ECAB15B3');
        $this->addSql('ALTER TABLE property_equipment DROP FOREIGN KEY FK_A2D7D73E517FE9FE');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE property_equipment');
        $this->addSql('DROP TABLE availability');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE travel');
        $this->addSql('DROP TABLE travel_day');
        $this->addSql('DROP TABLE equipment');
    }
}
