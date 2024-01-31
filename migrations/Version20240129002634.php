<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129002634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compras (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cliente_id INTEGER NOT NULL, cm_cantidadtotal INTEGER NOT NULL, cm_importetotal DOUBLE PRECISION NOT NULL, cm_fechacompra DATETIME NOT NULL, CONSTRAINT FK_3692E1B7DE734E51 FOREIGN KEY (cliente_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3692E1B7DE734E51 ON compras (cliente_id)');
        $this->addSql('CREATE TABLE detallecompra (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, compra_id INTEGER NOT NULL, producto_id INTEGER NOT NULL, dcm_cantidad INTEGER NOT NULL, dcm_importe DOUBLE PRECISION NOT NULL, dcm_estado INTEGER NOT NULL, CONSTRAINT FK_CA8F9737F2E704D7 FOREIGN KEY (compra_id) REFERENCES compras (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CA8F97377645698E FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CA8F9737F2E704D7 ON detallecompra (compra_id)');
        $this->addSql('CREATE INDEX IDX_CA8F97377645698E ON detallecompra (producto_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__usuario AS SELECT id, u_correo, roles, password, u_nombres, u_apepat, u_apemat, u_dni, u_telefono, u_estado, is_verified, google_id, facebook_id FROM usuario');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, u_correo VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, u_nombres VARCHAR(50) NOT NULL, u_apepat VARCHAR(50) NOT NULL, u_apemat VARCHAR(50) NOT NULL, u_dni VARCHAR(8) NOT NULL, u_telefono VARCHAR(9) DEFAULT NULL, u_estado BOOLEAN NOT NULL, is_verified BOOLEAN NOT NULL, google_id VARCHAR(255) DEFAULT NULL, facebook_id VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO usuario (id, u_correo, roles, password, u_nombres, u_apepat, u_apemat, u_dni, u_telefono, u_estado, is_verified, google_id, facebook_id) SELECT id, u_correo, roles, password, u_nombres, u_apepat, u_apemat, u_dni, u_telefono, u_estado, is_verified, google_id, facebook_id FROM __temp__usuario');
        $this->addSql('DROP TABLE __temp__usuario');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D92C973A9 ON usuario (u_correo)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE compras');
        $this->addSql('DROP TABLE detallecompra');
        $this->addSql('CREATE TEMPORARY TABLE __temp__messenger_messages AS SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM messenger_messages');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) SELECT id, body, headers, queue_name, created_at, available_at, delivered_at FROM __temp__messenger_messages');
        $this->addSql('DROP TABLE __temp__messenger_messages');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__usuario AS SELECT id, u_correo, roles, password, u_nombres, u_apepat, u_apemat, u_dni, u_telefono, u_estado, is_verified, google_id, facebook_id FROM usuario');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, u_correo VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, u_nombres VARCHAR(50) NOT NULL, u_apepat VARCHAR(50) NOT NULL, u_apemat VARCHAR(50) NOT NULL, u_dni VARCHAR(8) NOT NULL, u_telefono VARCHAR(9) DEFAULT NULL, u_estado BOOLEAN NOT NULL, is_verified BOOLEAN NOT NULL, google_id VARCHAR(255) DEFAULT NULL, facebook_id VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO usuario (id, u_correo, roles, password, u_nombres, u_apepat, u_apemat, u_dni, u_telefono, u_estado, is_verified, google_id, facebook_id) SELECT id, u_correo, roles, password, u_nombres, u_apepat, u_apemat, u_dni, u_telefono, u_estado, is_verified, google_id, facebook_id FROM __temp__usuario');
        $this->addSql('DROP TABLE __temp__usuario');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D92C973A9 ON usuario (u_correo)');
    }
}
