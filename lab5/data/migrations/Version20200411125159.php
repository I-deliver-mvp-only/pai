<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200411125159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->exec("CREATE TABLE products (
            id INTEGER AUTO_INCREMENT PRIMARY KEY NOT NULL,
            name VARCHAR(60) NOT NULL,
            price REAL NOT NULL CHECK(price > 0),
            img_url VARCHAR(255) NOT NULL
        )");
    }

    public function down(Schema $schema): void
    {
        $this->connection->exec("DROP TABLE products");
    }
}
