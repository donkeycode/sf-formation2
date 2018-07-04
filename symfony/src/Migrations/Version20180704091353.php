<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180704091353 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cron_manager (id INT AUTO_INCREMENT NOT NULL, last_executed_at DATETIME NOT NULL, is_lock TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien (id INT AUTO_INCREMENT NOT NULL, proprietaire_id INT DEFAULT NULL, latitude VARCHAR(25) NOT NULL, longitude VARCHAR(25) NOT NULL, localisation VARCHAR(255) NOT NULL, state ENUM(\'draft\', \'in_review\', \'published\'), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_45EDC38676C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proprietaire (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bien_modification (id INT NOT NULL, proprietaire_id INT DEFAULT NULL, latitude VARCHAR(25) NOT NULL, longitude VARCHAR(25) NOT NULL, localisation VARCHAR(255) NOT NULL, state ENUM(\'draft\', \'in_review\', \'published\'), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6B8951576C50E4A (proprietaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lead (id INT AUTO_INCREMENT NOT NULL, bien_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_289161CBBD95B80F (bien_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC38676C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE bien_modification ADD CONSTRAINT FK_6B8951576C50E4A FOREIGN KEY (proprietaire_id) REFERENCES proprietaire (id)');
        $this->addSql('ALTER TABLE lead ADD CONSTRAINT FK_289161CBBD95B80F FOREIGN KEY (bien_id) REFERENCES bien (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lead DROP FOREIGN KEY FK_289161CBBD95B80F');
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38676C50E4A');
        $this->addSql('ALTER TABLE bien_modification DROP FOREIGN KEY FK_6B8951576C50E4A');
        $this->addSql('DROP TABLE cron_manager');
        $this->addSql('DROP TABLE bien');
        $this->addSql('DROP TABLE proprietaire');
        $this->addSql('DROP TABLE bien_modification');
        $this->addSql('DROP TABLE lead');
    }
}
