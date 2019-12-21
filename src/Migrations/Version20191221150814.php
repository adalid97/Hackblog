<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191221150814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comentarios DROP FOREIGN KEY FK_noticias');
        $this->addSql('CREATE TABLE noticia (id INT AUTO_INCREMENT NOT NULL, titular VARCHAR(255) NOT NULL, entradilla VARCHAR(255) NOT NULL, cuerpo VARCHAR(255) NOT NULL, fecha DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE comentarios');
        $this->addSql('DROP TABLE noticias');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comentarios (id_comentario INT UNSIGNED AUTO_INCREMENT NOT NULL, id_noticia INT UNSIGNED NOT NULL, autor VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_bin`, texto TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_bin`, fecha DATETIME NOT NULL, INDEX FK_noticias (id_noticia), PRIMARY KEY(id_comentario)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE noticias (id_noticia INT UNSIGNED AUTO_INCREMENT NOT NULL, titular VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_bin`, entradilla TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_bin`, cuerpo TEXT CHARACTER SET utf8 NOT NULL COLLATE `utf8_bin`, fecha DATETIME NOT NULL, PRIMARY KEY(id_noticia)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE comentarios ADD CONSTRAINT FK_noticias FOREIGN KEY (id_noticia) REFERENCES noticias (id_noticia) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE noticia');
    }
}
