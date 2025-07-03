<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250703180000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des champs token et is_verified à user si non présents';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` ADD token VARCHAR(255) DEFAULT NULL, ADD is_verified TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE `user` DROP token, DROP is_verified');
    }
}
