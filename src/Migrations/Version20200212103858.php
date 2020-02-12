<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212103858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, contributor_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT DEFAULT NULL, INDEX IDX_2FB3D0EE7A19A357 (contributor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprint (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT DEFAULT NULL, date_start DATETIME DEFAULT NULL, date_end DATETIME DEFAULT NULL, INDEX IDX_EF8055B7166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, sprint_id INT DEFAULT NULL, tags_id INT DEFAULT NULL, assignee_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, resume LONGTEXT DEFAULT NULL, priority VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_527EDB258C24077B (sprint_id), INDEX IDX_527EDB258D7B4FB4 (tags_id), INDEX IDX_527EDB2559EC7D60 (assignee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_comment (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, task_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_8B9578867E3C61F9 (owner_id), INDEX IDX_8B9578868DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE7A19A357 FOREIGN KEY (contributor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sprint ADD CONSTRAINT FK_EF8055B7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB258D7B4FB4 FOREIGN KEY (tags_id) REFERENCES task_tag (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2559EC7D60 FOREIGN KEY (assignee_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT FK_8B9578867E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task_comment ADD CONSTRAINT FK_8B9578868DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sprint DROP FOREIGN KEY FK_EF8055B7166D1F9C');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB258C24077B');
        $this->addSql('ALTER TABLE task_comment DROP FOREIGN KEY FK_8B9578868DB60186');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB258D7B4FB4');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE7A19A357');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2559EC7D60');
        $this->addSql('ALTER TABLE task_comment DROP FOREIGN KEY FK_8B9578867E3C61F9');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE sprint');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_comment');
        $this->addSql('DROP TABLE task_tag');
        $this->addSql('DROP TABLE user');
    }
}
