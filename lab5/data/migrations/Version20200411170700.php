<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200411170700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->exec("INSERT INTO products(name, price, img_url)
            VALUES('LED Philips 32PHT4503/12 TV Set', 1299, 'https://f00.esfr.pl/si_upload/gfx/karty/philips/telewizory-2018/PHS4503/assets/philips-4503.png'),
            ('TOSHIBA 75U6863DA TV Set', 999.99, 'https://outletmedia.pl/data/gfx/pictures/medium/1/6/2161_1.png'),
            ('Sony KD-65XF9005 TV Set', 2000, 'https://hiqstudio.pl/156-large_default/telewizor-sony-kd-65xf9005-kabel-hmdi-premium-4k-sony-center-nowy-sacz.jpg'),
            ('Samsung UE40MU6472 TV Set', 1599.99, 'https://f00.esfr.pl/si_upload/gfx/karty/samsung/telewizory-2017/MU6400/assets/samsung-samsung-mu6500-0872.png'),
            ('Notebook Dell', 1149, 'https://www.komputronik.pl/media/pl-komputronik/staticPages/komunia-dell/img/header_b.png'),
            ('Notebook MSI GL73 8RC-027PL', 2000, 'https://promocje.msi.com/wp-content/uploads/2019/02/MSI_NB_GL73_Photo_12_-1.png'),
            ('Notebook HP Spectre x360', 1000, 'https://www.pcworld.pl/g1/news/thumbnails/3/0/302067_HP_Spectre_x360_png_90_resize_770x1000.png'),
            ('Ultrabook Explore 1405 Kruger&Matz', 2399, 'https://www.lechpol.eu/sites/default/files/produkty/km1405-b/km1405-b.png'),
            ('Smartphone Redmi 8A Dual', 400, 'https://i01.appmifile.com/webfile/globalimg/in/cms/7566868A-4B7A-6B70-5E70-B4463DFC252B.jpg'),
            ('Smartphone Lenovo K5 Pro', 500, 'https://www.storearuba.com/65721-large_default/ulefone-s1-pro-55-inch-android-8-1gb-ram-16gb-rom-dual-sim-4g-smartphone-store-aruba.jpg')");
    }

    public function down(Schema $schema): void
    {
        $this->connection->exec("DELETE FROM products");
    }
}
