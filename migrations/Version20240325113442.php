<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325113442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D7288688BB9');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C88688BB9');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location_user (location_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_D97630964D218E (location_id), INDEX IDX_D976309A76ED395 (user_id), PRIMARY KEY(location_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE location_user ADD CONSTRAINT FK_D97630964D218E FOREIGN KEY (location_id) REFERENCES location (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location_user ADD CONSTRAINT FK_D976309A76ED395 FOREIGN KEY (user_id) REFERENCES user_profiles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bed_user DROP FOREIGN KEY FK_AB9307EEA76ED395');
        $this->addSql('ALTER TABLE bed_user DROP FOREIGN KEY FK_AB9307EE88688BB9');
        $this->addSql('DROP TABLE bed');
        $this->addSql('DROP TABLE bed_user');
        $this->addSql('DROP INDEX IDX_9474526C88688BB9 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE bed_id location_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_9474526C64D218E ON comment (location_id)');
        $this->addSql('DROP INDEX IDX_AB030D7288688BB9 ON plant');
        $this->addSql('ALTER TABLE plant CHANGE bed_id location_id INT NOT NULL');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7264D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('CREATE INDEX IDX_AB030D7264D218E ON plant (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C64D218E');
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D7264D218E');
        $this->addSql('CREATE TABLE bed (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(10) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, icon VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bed_user (bed_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AB9307EE88688BB9 (bed_id), INDEX IDX_AB9307EEA76ED395 (user_id), PRIMARY KEY(bed_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bed_user ADD CONSTRAINT FK_AB9307EEA76ED395 FOREIGN KEY (user_id) REFERENCES user_profiles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bed_user ADD CONSTRAINT FK_AB9307EE88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location_user DROP FOREIGN KEY FK_D97630964D218E');
        $this->addSql('ALTER TABLE location_user DROP FOREIGN KEY FK_D976309A76ED395');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE location_user');
        $this->addSql('DROP INDEX IDX_AB030D7264D218E ON plant');
        $this->addSql('ALTER TABLE plant CHANGE location_id bed_id INT NOT NULL');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7288688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id)');
        $this->addSql('CREATE INDEX IDX_AB030D7288688BB9 ON plant (bed_id)');
        $this->addSql('DROP INDEX IDX_9474526C64D218E ON comment');
        $this->addSql('ALTER TABLE comment CHANGE location_id bed_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id)');
        $this->addSql('CREATE INDEX IDX_9474526C88688BB9 ON comment (bed_id)');
    }
}
