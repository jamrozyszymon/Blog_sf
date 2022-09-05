<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220901092314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE OpinionPositive (post_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A2B4E3CE4B89032C (post_id), INDEX IDX_A2B4E3CEA76ED395 (user_id), PRIMARY KEY(post_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE OpinionNegative (post_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C7C294D54B89032C (post_id), INDEX IDX_C7C294D5A76ED395 (user_id), PRIMARY KEY(post_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE OpinionPositive ADD CONSTRAINT FK_A2B4E3CE4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OpinionPositive ADD CONSTRAINT FK_A2B4E3CEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OpinionNegative ADD CONSTRAINT FK_C7C294D54B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE OpinionNegative ADD CONSTRAINT FK_C7C294D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE OpinionPositive DROP FOREIGN KEY FK_A2B4E3CE4B89032C');
        $this->addSql('ALTER TABLE OpinionPositive DROP FOREIGN KEY FK_A2B4E3CEA76ED395');
        $this->addSql('ALTER TABLE OpinionNegative DROP FOREIGN KEY FK_C7C294D54B89032C');
        $this->addSql('ALTER TABLE OpinionNegative DROP FOREIGN KEY FK_C7C294D5A76ED395');
        $this->addSql('DROP TABLE OpinionPositive');
        $this->addSql('DROP TABLE OpinionNegative');
    }
}
