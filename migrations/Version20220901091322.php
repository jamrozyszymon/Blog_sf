<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901091322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinion_positive DROP FOREIGN KEY FK_B01C18CCD5E258C5');
        $this->addSql('ALTER TABLE opinion_positive_user DROP FOREIGN KEY FK_9807285468EE6EB2');
        $this->addSql('ALTER TABLE opinion_positive_user DROP FOREIGN KEY FK_98072854A76ED395');
        $this->addSql('DROP TABLE opinion_positive');
        $this->addSql('DROP TABLE opinion_positive_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE opinion_positive (id INT AUTO_INCREMENT NOT NULL, posts_id INT NOT NULL, INDEX IDX_B01C18CCD5E258C5 (posts_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE opinion_positive_user (opinion_positive_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9807285468EE6EB2 (opinion_positive_id), INDEX IDX_98072854A76ED395 (user_id), PRIMARY KEY(opinion_positive_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE opinion_positive ADD CONSTRAINT FK_B01C18CCD5E258C5 FOREIGN KEY (posts_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE opinion_positive_user ADD CONSTRAINT FK_9807285468EE6EB2 FOREIGN KEY (opinion_positive_id) REFERENCES opinion_positive (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE opinion_positive_user ADD CONSTRAINT FK_98072854A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
