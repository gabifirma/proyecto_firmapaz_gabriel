-- ============================================================
-- Base de datos: bd_firmapaz_conti
-- Generado para Docker / MySQL 8.0
-- ============================================================

CREATE DATABASE IF NOT EXISTS `bd_firmapaz_conti`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE `bd_firmapaz_conti`;

-- ------------------------------------------------------------
-- Tabla: users (perfiles de usuario)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
  `id_perfil`           INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `perfil_descripcion`  VARCHAR(100)    NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id_perfil`, `perfil_descripcion`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- ------------------------------------------------------------
-- Tabla: personas (usuarios registrados)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `personas` (
  `id`                INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `persona_apellido`  VARCHAR(100)    NOT NULL,
  `persona_nombre`    VARCHAR(100)    NOT NULL,
  `persona_pais`      VARCHAR(100)    NOT NULL,
  `persona_mail`      VARCHAR(150)    NOT NULL UNIQUE,
  `persona_password`  VARCHAR(255)    NOT NULL,
  `id_perfil`         INT UNSIGNED    NOT NULL DEFAULT 2,
  `persona_estado`    TINYINT(1)      NOT NULL DEFAULT 1,
  `dni`               VARCHAR(20)     NULL,
  `domicilio`         VARCHAR(200)    NULL,
  `codigo_postal`     VARCHAR(20)     NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_personas_perfil`
    FOREIGN KEY (`id_perfil`) REFERENCES `users` (`id_perfil`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Admin por defecto (password: admin123 — cambiala después)
INSERT INTO `personas`
  (`persona_apellido`, `persona_nombre`, `persona_pais`, `persona_mail`, `persona_password`, `id_perfil`, `persona_estado`)
VALUES
  ('Admin', 'Admin', 'Argentina', 'admin@firmapaz.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, 1);

-- ------------------------------------------------------------
-- Tabla: categorias
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `categorias` (
  `id`                    INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `categoria_descripcion` VARCHAR(100)    NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categorias` (`id`, `categoria_descripcion`) VALUES
(1, 'Acción'),
(2, 'Aventura'),
(3, 'RPG'),
(4, 'Deportes'),
(5, 'Estrategia'),
(6, 'Simulación'),
(7, 'Terror'),
(8, 'Plataformas');

-- ------------------------------------------------------------
-- Tabla: videojuegos
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `videojuegos` (
  `id_videojuego`             INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `titulo_videojuego`         VARCHAR(150)    NOT NULL,
  `descripcion_videojuego`    TEXT            NULL,
  `desarrollador_videojuego`  VARCHAR(100)    NULL,
  `distribuidor_videojuego`   VARCHAR(100)    NULL,
  `precio_videojuego`         DECIMAL(10,2)   NOT NULL DEFAULT 0.00,
  `imagen_videojuego`         VARCHAR(255)    NULL,
  `id_categoria`              INT UNSIGNED    NOT NULL,
  `estado_videojuego`         TINYINT(1)      NOT NULL DEFAULT 1,
  `videojuego_stock`          INT             NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_videojuego`),
  CONSTRAINT `fk_videojuegos_categoria`
    FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Tabla: venta
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `venta` (
  `id_venta`      INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `id_persona`    INT UNSIGNED    NOT NULL,
  `fecha_venta`   DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_venta`   DECIMAL(10,2)   NOT NULL DEFAULT 0.00,
  `metodo_pago`   VARCHAR(30)     NULL,
  PRIMARY KEY (`id_venta`),
  CONSTRAINT `fk_venta_persona`
    FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Tabla: detalle_venta
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id`                INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `id_venta`          INT UNSIGNED    NOT NULL,
  `id_videojuego`     INT UNSIGNED    NOT NULL,
  `detalle_cantidad`  INT             NOT NULL DEFAULT 1,
  `detalle_precio`    DECIMAL(10,2)   NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_detalle_venta`
    FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `fk_detalle_videojuego`
    FOREIGN KEY (`id_videojuego`) REFERENCES `videojuegos` (`id_videojuego`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ------------------------------------------------------------
-- Tabla: mensajes (consultas de contacto)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `mensajes` (
  `id_mensaje`        INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `nombre_mensaje`    VARCHAR(100)    NOT NULL,
  `apellido_mensaje`  VARCHAR(100)    NOT NULL,
  `correo_mensaje`    VARCHAR(150)    NOT NULL,
  `motivo_mensaje`    VARCHAR(200)    NULL,
  `mensaje_mensaje`   TEXT            NULL,
  `leido`             TINYINT(1)      NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
