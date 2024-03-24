<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502193101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE plot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE species_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_profiles_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, plot_id INT DEFAULT NULL, plant_id INT DEFAULT NULL, author VARCHAR(255) NOT NULL, text TEXT NOT NULL, email VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526C680D0B01 ON comment (plot_id)');
        $this->addSql('CREATE INDEX IDX_9474526C1D935652 ON comment (plant_id)');
        $this->addSql('COMMENT ON COLUMN comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE plant (id INT NOT NULL, plot_id INT NOT NULL, species_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, text TEXT DEFAULT NULL, photo_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AB030D72680D0B01 ON plant (plot_id)');
        $this->addSql('CREATE INDEX IDX_AB030D72B2A1D860 ON plant (species_id)');
        $this->addSql('CREATE TABLE plot (id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, icon VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE plot_user (plot_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(plot_id, user_id))');
        $this->addSql('CREATE INDEX IDX_6A37401B680D0B01 ON plot_user (plot_id)');
        $this->addSql('CREATE INDEX IDX_6A37401BA76ED395 ON plot_user (user_id)');
        $this->addSql('CREATE TABLE species (id INT NOT NULL, name VARCHAR(255) NOT NULL, scientific VARCHAR(255) DEFAULT NULL, cycle VARCHAR(255) DEFAULT NULL, watering VARCHAR(255) DEFAULT NULL, sunlight VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_profiles (id INT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C1D935652 FOREIGN KEY (plant_id) REFERENCES plant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D72B2A1D860 FOREIGN KEY (species_id) REFERENCES species (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_user ADD CONSTRAINT FK_6A37401B680D0B01 FOREIGN KEY (plot_id) REFERENCES plot (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE plot_user ADD CONSTRAINT FK_6A37401BA76ED395 FOREIGN KEY (user_id) REFERENCES user_profiles (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE plot_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE species_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_profiles_id_seq CASCADE');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C680D0B01');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C1D935652');
        $this->addSql('ALTER TABLE plant DROP CONSTRAINT FK_AB030D72680D0B01');
        $this->addSql('ALTER TABLE plant DROP CONSTRAINT FK_AB030D72B2A1D860');
        $this->addSql('ALTER TABLE plot_user DROP CONSTRAINT FK_6A37401B680D0B01');
        $this->addSql('ALTER TABLE plot_user DROP CONSTRAINT FK_6A37401BA76ED395');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE plant');
        $this->addSql('DROP TABLE plot');
        $this->addSql('DROP TABLE plot_user');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE user_profiles');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
