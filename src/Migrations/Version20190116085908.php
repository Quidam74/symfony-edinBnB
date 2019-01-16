<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116085908 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC3864DE7DC5C');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494DE7DC5C');
        $this->addSql('ALTER TABLE disponibiliter DROP FOREIGN KEY FK_C7F4780ABD95B80F');
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3BD95B80F');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B78418BD95B80F');
        $this->addSql('ALTER TABLE disponibiliter DROP FOREIGN KEY FK_C7F4780A220C6AD0');
        $this->addSql('ALTER TABLE voyage_jour DROP FOREIGN KEY FK_4A85114B220C6AD0');
        $this->addSql('ALTER TABLE voyage_jour DROP FOREIGN KEY FK_4A85114B68C9E5AF');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, user_id INT NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, bed_room_count INT NOT NULL, bed_count INT NOT NULL, person_count INT NOT NULL, bath_room_count INT NOT NULL, UNIQUE INDEX UNIQ_8BF21CDEF5B7AF75 (address_id), INDEX IDX_8BF21CDEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE availability (id INT AUTO_INCREMENT NOT NULL, day_id INT DEFAULT NULL, property_id INT NOT NULL, is_available TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_3FB7A2BF9C24126 (day_id), INDEX IDX_3FB7A2BF549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(60) NOT NULL, city VARCHAR(60) NOT NULL, post_code VARCHAR(60) NOT NULL, complement VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE day (id INT AUTO_INCREMENT NOT NULL, day DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, description VARCHAR(80) NOT NULL, url VARCHAR(40) NOT NULL, INDEX IDX_16DB4F89549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_2D0B6BCEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_day (travel_id INT NOT NULL, day_id INT NOT NULL, INDEX IDX_DCF00820ECAB15B3 (travel_id), INDEX IDX_DCF008209C24126 (day_id), PRIMARY KEY(travel_id, day_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id INT AUTO_INCREMENT NOT NULL, property_id INT NOT NULL, description VARCHAR(100) NOT NULL, INDEX IDX_D338D583549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF9C24126 FOREIGN KEY (day_id) REFERENCES day (id)');
        $this->addSql('ALTER TABLE availability ADD CONSTRAINT FK_3FB7A2BF549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE travel ADD CONSTRAINT FK_2D0B6BCEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE travel_day ADD CONSTRAINT FK_DCF00820ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE travel_day ADD CONSTRAINT FK_DCF008209C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D583549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE disponibiliter');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE jour');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('DROP TABLE voyage_jour');
        $this->addSql('DROP INDEX UNIQ_8D93D6494DE7DC5C ON user');
        $this->addSql('ALTER TABLE user CHANGE date_of_birth date_of_birth DATE NOT NULL, CHANGE adresse_id address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5B7AF75 ON user (address_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF549213EC');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89549213EC');
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D583549213EC');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEF5B7AF75');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE availability DROP FOREIGN KEY FK_3FB7A2BF9C24126');
        $this->addSql('ALTER TABLE travel_day DROP FOREIGN KEY FK_DCF008209C24126');
        $this->addSql('ALTER TABLE travel_day DROP FOREIGN KEY FK_DCF00820ECAB15B3');
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, pays VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, ville VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, code_postale VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, complement VARCHAR(150) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, user_id INT NOT NULL, description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, prix INT NOT NULL, nb_chambre INT NOT NULL, nb_lit INT NOT NULL, nb_personne INT NOT NULL, nb_salle_de_bain INT NOT NULL, INDEX IDX_45EDC386A76ED395 (user_id), UNIQUE INDEX UNIQ_45EDC3864DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE disponibiliter (id INT AUTO_INCREMENT NOT NULL, jour_id INT DEFAULT NULL, bien_id INT NOT NULL, est_disponible TINYINT(1) NOT NULL, INDEX IDX_C7F4780ABD95B80F (bien_id), UNIQUE INDEX UNIQ_C7F4780A220C6AD0 (jour_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, bien_id INT NOT NULL, libelle VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_B8B4C6F3BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jour (id INT AUTO_INCREMENT NOT NULL, jour DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, bien_id INT NOT NULL, description VARCHAR(80) NOT NULL COLLATE utf8mb4_unicode_ci, url VARCHAR(40) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_14B78418BD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, INDEX IDX_3F9D8955A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE voyage_jour (voyage_id INT NOT NULL, jour_id INT NOT NULL, INDEX IDX_4A85114B68C9E5AF (voyage_id), INDEX IDX_4A85114B220C6AD0 (jour_id), PRIMARY KEY(voyage_id, jour_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC3864DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE disponibiliter ADD CONSTRAINT FK_C7F4780A220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id)');
        $this->addSql('ALTER TABLE disponibiliter ADD CONSTRAINT FK_C7F4780ABD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B78418BD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE voyage_jour ADD CONSTRAINT FK_4A85114B220C6AD0 FOREIGN KEY (jour_id) REFERENCES jour (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage_jour ADD CONSTRAINT FK_4A85114B68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE availability');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE day');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE travel');
        $this->addSql('DROP TABLE travel_day');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP INDEX UNIQ_8D93D649F5B7AF75 ON user');
        $this->addSql('ALTER TABLE user CHANGE date_of_birth date_of_birth DATETIME NOT NULL, CHANGE address_id adresse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6494DE7DC5C ON user (adresse_id)');
    }
}
