<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200607100805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE orders (id UUID NOT NULL, user_id UUID DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E52FFDEEA76ED395 ON orders (user_id)');
        $this->addSql('COMMENT ON COLUMN orders.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN orders.user_id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE categories (id UUID NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN categories.id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE category_products (category_id UUID NOT NULL, product_id UUID NOT NULL, PRIMARY KEY(category_id, product_id))');
        $this->addSql('CREATE INDEX IDX_4C0DE2112469DE2 ON category_products (category_id)');
        $this->addSql('CREATE INDEX IDX_4C0DE214584665A ON category_products (product_id)');
        $this->addSql('COMMENT ON COLUMN category_products.category_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN category_products.product_id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE invoices (id UUID NOT NULL, order_id UUID DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2F2F958D9F6D38 ON invoices (order_id)');
        $this->addSql('COMMENT ON COLUMN invoices.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN invoices.order_id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE users (id UUID NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE addresses (id UUID NOT NULL, user_id UUID DEFAULT NULL, house_number VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, post_code VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, county VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6FCA7516A76ED395 ON addresses (user_id)');
        $this->addSql('COMMENT ON COLUMN addresses.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN addresses.user_id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE order_lines (id UUID NOT NULL, product_id UUID DEFAULT NULL, order_id UUID DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CC9FF86B4584665A ON order_lines (product_id)');
        $this->addSql('CREATE INDEX IDX_CC9FF86B8D9F6D38 ON order_lines (order_id)');
        $this->addSql('COMMENT ON COLUMN order_lines.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN order_lines.product_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN order_lines.order_id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE products (id UUID NOT NULL, name VARCHAR(255) NOT NULL, price VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN products.id IS \'(DC2Type:uuid)\'');

        $this->addSql('CREATE TABLE admins (id UUID NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(180) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A2E0150FF85E0677 ON admins (username)');
        $this->addSql('COMMENT ON COLUMN admins.id IS \'(DC2Type:uuid)\'');

        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category_products ADD CONSTRAINT FK_4C0DE2112469DE2 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE category_products ADD CONSTRAINT FK_4C0DE214584665A FOREIGN KEY (product_id) REFERENCES products (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoices ADD CONSTRAINT FK_6A2F2F958D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE addresses ADD CONSTRAINT FK_6FCA7516A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_lines ADD CONSTRAINT FK_CC9FF86B4584665A FOREIGN KEY (product_id) REFERENCES products (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE order_lines ADD CONSTRAINT FK_CC9FF86B8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('postgresql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE invoices DROP CONSTRAINT FK_6A2F2F958D9F6D38');
        $this->addSql('ALTER TABLE order_lines DROP CONSTRAINT FK_CC9FF86B8D9F6D38');
        $this->addSql('ALTER TABLE category_products DROP CONSTRAINT FK_4C0DE2112469DE2');
        $this->addSql('ALTER TABLE orders DROP CONSTRAINT FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE addresses DROP CONSTRAINT FK_6FCA7516A76ED395');
        $this->addSql('ALTER TABLE category_products DROP CONSTRAINT FK_4C0DE214584665A');
        $this->addSql('ALTER TABLE order_lines DROP CONSTRAINT FK_CC9FF86B4584665A');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE category_products');
        $this->addSql('DROP TABLE invoices');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE addresses');
        $this->addSql('DROP TABLE order_lines');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE admins');
    }
}
