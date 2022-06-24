<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220624140621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diploma ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE diploma ADD CONSTRAINT FK_EC218957A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EC218957A76ED395 ON diploma (user_id)');
        $this->addSql('ALTER TABLE hobbie ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE hobbie ADD CONSTRAINT FK_1D9CA9F7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1D9CA9F7A76ED395 ON hobbie (user_id)');
        $this->addSql('ALTER TABLE language_spoken ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE language_spoken ADD CONSTRAINT FK_4CF2174CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4CF2174CA76ED395 ON language_spoken (user_id)');
        $this->addSql('ALTER TABLE personal_information ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE personal_information ADD CONSTRAINT FK_FFEF6BCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FFEF6BCCA76ED395 ON personal_information (user_id)');
        $this->addSql('ALTER TABLE professional_experience ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE professional_experience ADD CONSTRAINT FK_32FDB9BAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_32FDB9BAA76ED395 ON professional_experience (user_id)');
        $this->addSql('ALTER TABLE skill ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477A76ED395 ON skill (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE diploma DROP FOREIGN KEY FK_EC218957A76ED395');
        $this->addSql('DROP INDEX IDX_EC218957A76ED395 ON diploma');
        $this->addSql('ALTER TABLE diploma DROP user_id');
        $this->addSql('ALTER TABLE hobbie DROP FOREIGN KEY FK_1D9CA9F7A76ED395');
        $this->addSql('DROP INDEX IDX_1D9CA9F7A76ED395 ON hobbie');
        $this->addSql('ALTER TABLE hobbie DROP user_id');
        $this->addSql('ALTER TABLE language_spoken DROP FOREIGN KEY FK_4CF2174CA76ED395');
        $this->addSql('DROP INDEX IDX_4CF2174CA76ED395 ON language_spoken');
        $this->addSql('ALTER TABLE language_spoken DROP user_id');
        $this->addSql('ALTER TABLE personal_information DROP FOREIGN KEY FK_FFEF6BCCA76ED395');
        $this->addSql('DROP INDEX IDX_FFEF6BCCA76ED395 ON personal_information');
        $this->addSql('ALTER TABLE personal_information DROP user_id');
        $this->addSql('ALTER TABLE professional_experience DROP FOREIGN KEY FK_32FDB9BAA76ED395');
        $this->addSql('DROP INDEX IDX_32FDB9BAA76ED395 ON professional_experience');
        $this->addSql('ALTER TABLE professional_experience DROP user_id');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477A76ED395');
        $this->addSql('DROP INDEX IDX_5E3DE477A76ED395 ON skill');
        $this->addSql('ALTER TABLE skill DROP user_id');
    }
}
