<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240324193401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bed (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bed_user (bed_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AB9307EE88688BB9 (bed_id), INDEX IDX_AB9307EEA76ED395 (user_id), PRIMARY KEY(bed_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, bed_id INT DEFAULT NULL, plant_id INT DEFAULT NULL, author VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', photo_filename VARCHAR(255) DEFAULT NULL, INDEX IDX_9474526C88688BB9 (bed_id), INDEX IDX_9474526C1D935652 (plant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant (id INT AUTO_INCREMENT NOT NULL, bed_id INT NOT NULL, species_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, text LONGTEXT DEFAULT NULL, photo_filename VARCHAR(255) DEFAULT NULL, INDEX IDX_AB030D7288688BB9 (bed_id), INDEX IDX_AB030D72B2A1D860 (species_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE species (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, scientific VARCHAR(255) DEFAULT NULL, cycle VARCHAR(255) DEFAULT NULL, watering VARCHAR(255) DEFAULT NULL, sunlight VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_profiles (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bed_user ADD CONSTRAINT FK_AB9307EE88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bed_user ADD CONSTRAINT FK_AB9307EEA76ED395 FOREIGN KEY (user_id) REFERENCES user_profiles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C1D935652 FOREIGN KEY (plant_id) REFERENCES plant (id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7288688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id)');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bed_user DROP FOREIGN KEY FK_AB9307EE88688BB9');
        $this->addSql('ALTER TABLE bed_user DROP FOREIGN KEY FK_AB9307EEA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C88688BB9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1D935652');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D7288688BB9');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D72B2A1D860');
        $this->addSql('DROP TABLE bed');
        $this->addSql('DROP TABLE bed_user');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE user_profiles');
    }
}
