<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116023502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrito (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, usuario_id INTEGER NOT NULL, c_cantidadtotal INTEGER NOT NULL, c_importetotal DOUBLE PRECISION NOT NULL, CONSTRAINT FK_77E6BED5DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E6BED5DB38439E ON carrito (usuario_id)');
        $this->addSql('CREATE TABLE descuento (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, ds_codigo VARCHAR(30) NOT NULL, ds_valor DOUBLE PRECISION NOT NULL, ds_estado BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE detallecarrito (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, carrito_id INTEGER NOT NULL, producto_id INTEGER NOT NULL, dc_cantidad INTEGER NOT NULL, dc_importe DOUBLE PRECISION NOT NULL, CONSTRAINT FK_E20DBAF1DE2CF6E7 FOREIGN KEY (carrito_id) REFERENCES carrito (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E20DBAF17645698E FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E20DBAF1DE2CF6E7 ON detallecarrito (carrito_id)');
        $this->addSql('CREATE INDEX IDX_E20DBAF17645698E ON detallecarrito (producto_id)');
        $this->addSql('CREATE TABLE producto (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, usuario_id INTEGER NOT NULL, descuento_id INTEGER DEFAULT NULL, pr_nombre VARCHAR(50) NOT NULL, pr_categoria VARCHAR(50) NOT NULL, pr_stock INTEGER NOT NULL, pr_precio DOUBLE PRECISION NOT NULL, pr_imagenes CLOB DEFAULT NULL, pr_descripcion CLOB DEFAULT NULL, CONSTRAINT FK_A7BB0615DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_A7BB0615F045077C FOREIGN KEY (descuento_id) REFERENCES descuento (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_A7BB0615DB38439E ON producto (usuario_id)');
        $this->addSql('CREATE INDEX IDX_A7BB0615F045077C ON producto (descuento_id)');
        $this->addSql('CREATE TABLE usuario (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, u_correo VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, u_nombres VARCHAR(50) NOT NULL, u_apepat VARCHAR(50) NOT NULL, u_apemat VARCHAR(50) NOT NULL, u_dni VARCHAR(8) NOT NULL, u_telefono VARCHAR(9) DEFAULT NULL, u_estado BOOLEAN NOT NULL, is_verified BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05D92C973A9 ON usuario (u_correo)');
        $this->addSql('CREATE TABLE valoracion (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, producto_id INTEGER NOT NULL, usuario_id INTEGER NOT NULL, vl_valor INTEGER NOT NULL, vl_comentario CLOB DEFAULT NULL, CONSTRAINT FK_6D3DE0F47645698E FOREIGN KEY (producto_id) REFERENCES producto (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6D3DE0F4DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6D3DE0F47645698E ON valoracion (producto_id)');
        $this->addSql('CREATE INDEX IDX_6D3DE0F4DB38439E ON valoracion (usuario_id)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE carrito');
        $this->addSql('DROP TABLE descuento');
        $this->addSql('DROP TABLE detallecarrito');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE valoracion');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
