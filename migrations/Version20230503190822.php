<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503190822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526c680d0b01');
        $this->addSql('ALTER TABLE plant DROP CONSTRAINT fk_ab030d72680d0b01');
        $this->addSql('DROP SEQUENCE plot_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE bed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bed (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE bed_user (bed_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(bed_id, user_id))');
        $this->addSql('CREATE INDEX IDX_AB9307EE88688BB9 ON bed_user (bed_id)');
        $this->addSql('CREATE INDEX IDX_AB9307EEA76ED395 ON bed_user (user_id)');
        $this->addSql('ALTER TABLE bed_user ADD CONSTRAINT FK_AB9307EE88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bed_user ADD CONSTRAINT FK_AB9307EEA76ED395 FOREIGN KEY (user_id) REFERENCES user_profiles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_user DROP CONSTRAINT fk_6a37401b680d0b01');
        $this->addSql('ALTER TABLE plot_user DROP CONSTRAINT fk_6a37401ba76ed395');
        $this->addSql('DROP TABLE plot');
        $this->addSql('DROP TABLE plot_user');
        $this->addSql('DROP INDEX idx_9474526c680d0b01');
        $this->addSql('ALTER TABLE comment RENAME COLUMN plot_id TO bed_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C88688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C88688BB9 ON comment (bed_id)');
        $this->addSql('DROP INDEX idx_ab030d72680d0b01');
        $this->addSql('ALTER TABLE plant RENAME COLUMN plot_id TO bed_id');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7288688BB9 FOREIGN KEY (bed_id) REFERENCES bed (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AB030D7288688BB9 ON plant (bed_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C88688BB9');
        $this->addSql('ALTER TABLE plant DROP CONSTRAINT FK_AB030D7288688BB9');
        $this->addSql('DROP SEQUENCE bed_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE plot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plot (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plot_user (plot_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(plot_id, user_id))');
        $this->addSql('CREATE INDEX idx_6a37401ba76ed395 ON plot_user (user_id)');
        $this->addSql('CREATE INDEX idx_6a37401b680d0b01 ON plot_user (plot_id)');
        $this->addSql('ALTER TABLE plot_user ADD CONSTRAINT fk_6a37401b680d0b01 FOREIGN KEY (plot_id) REFERENCES plot (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_user ADD CONSTRAINT fk_6a37401ba76ed395 FOREIGN KEY (user_id) REFERENCES user_profiles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE bed_user DROP CONSTRAINT FK_AB9307EE88688BB9');
        $this->addSql('ALTER TABLE bed_user DROP CONSTRAINT FK_AB9307EEA76ED395');
        $this->addSql('DROP TABLE bed');
        $this->addSql('DROP TABLE bed_user');
        $this->addSql('DROP INDEX IDX_9474526C88688BB9');
        $this->addSql('ALTER TABLE comment RENAME COLUMN bed_id TO plot_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526c680d0b01 FOREIGN KEY (plot_id) REFERENCES plot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9474526c680d0b01 ON comment (plot_id)');
        $this->addSql('DROP INDEX IDX_AB030D7288688BB9');
        $this->addSql('ALTER TABLE plant RENAME COLUMN bed_id TO plot_id');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT fk_ab030d72680d0b01 FOREIGN KEY (plot_id) REFERENCES plot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ab030d72680d0b01 ON plant (plot_id)');
    }
}
