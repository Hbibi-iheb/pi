<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212164537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_forum (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(80) NOT NULL, description VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire_post (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, contenu VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_B372A8DF4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_forum (id INT AUTO_INCREMENT NOT NULL, categorie_id INT NOT NULL, contenu VARCHAR(150) NOT NULL, titre VARCHAR(80) NOT NULL, created_at DATETIME NOT NULL, user_id INT NOT NULL, INDEX IDX_12303222BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_like (id INT AUTO_INCREMENT NOT NULL, post_id INT NOT NULL, type TINYINT(1) NOT NULL, user_id INT NOT NULL, INDEX IDX_653627B84B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire_post ADD CONSTRAINT FK_B372A8DF4B89032C FOREIGN KEY (post_id) REFERENCES post_forum (id)');
        $this->addSql('ALTER TABLE post_forum ADD CONSTRAINT FK_12303222BCF5E72D FOREIGN KEY (categorie_id) REFERENCES category_forum (id)');
        $this->addSql('ALTER TABLE post_like ADD CONSTRAINT FK_653627B84B89032C FOREIGN KEY (post_id) REFERENCES post_forum (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire_post DROP FOREIGN KEY FK_B372A8DF4B89032C');
        $this->addSql('ALTER TABLE post_forum DROP FOREIGN KEY FK_12303222BCF5E72D');
        $this->addSql('ALTER TABLE post_like DROP FOREIGN KEY FK_653627B84B89032C');
        $this->addSql('DROP TABLE category_forum');
        $this->addSql('DROP TABLE commentaire_post');
        $this->addSql('DROP TABLE post_forum');
        $this->addSql('DROP TABLE post_like');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
