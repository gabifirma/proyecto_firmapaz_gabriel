# Guía de Despliegue con Docker - Firmapaz

## Requisitos Previos
- Docker instalado
- Docker Compose instalado
- Al menos 4GB de RAM disponibles

## Estructura del Proyecto
```
proyecto_firmapaz_gabriel/
├── app/                    # Aplicación CodeIgniter 4
├── docker-mysql/          # Scripts de base de datos
├── Dockerfile             # Configuración del contenedor PHP
├── docker-compose.yml     # Orquestación de servicios
└── DOCKER_DEPLOY.md      # Esta guía
```

## Pasos para Despliegue

### 1. Construir y Levantar Contenedores
```bash
docker-compose up --build -d
```

### 2. Verificar Estado de los Contenedores
```bash
docker-compose ps
```

### 3. Acceder a la Aplicación
- **Aplicación web**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Usuario: root
  - Contraseña: root

### 4. Verificar Logs (si hay problemas)
```bash
# Logs de la aplicación
docker-compose logs app

# Logs de la base de datos
docker-compose logs db
```

## Servicios Configurados

### 1. App (CodeIgniter 4)
- **Contenedor**: ci4_app
- **PHP**: 8.2 con Apache
- **Puerto**: 8080
- **Dependencias**: Se instalan automáticamente con Composer

### 2. Base de Datos (MySQL 8.0)
- **Contenedor**: firmapaz_db
- **Database**: bd_firmapaz_conti
- **Usuario**: ci4user
- **Contraseña**: ci4user
- **Puerto**: 3306

### 3. phpMyAdmin
- **Contenedor**: ci4_phpmyadmin
- **Puerto**: 8081

## Comandos Útiles

### Detener los servicios
```bash
docker-compose down
```

### Reiniciar servicios
```bash
docker-compose restart
```

### Reconstruir imagen (después de cambios en Dockerfile)
```bash
docker-compose build --no-cache
```

### Acceder al contenedor de la aplicación
```bash
docker-compose exec app bash
```

### Limpiar todo (contenedores, imágenes, volúmenes)
```bash
docker-compose down -v --rmi all
```

## Configuración de Entorno

El archivo `.env` en la carpeta `app/` está configurado para:
- `CI_ENVIRONMENT = development`
- `app.baseURL = 'http://localhost:8080/'`
- Conexión a la base de datos MySQL configurada

## Solución de Problemas Comunes

### 1. Error de permisos en la carpeta writable
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/app/writable
docker-compose exec app chmod -R 755 /var/www/html/app/writable
```

### 2. Error de conexión a la base de datos
- Verificar que el contenedor `db` esté corriendo
- Esperar 30 segundos después de levantar los contenedores
- Revisar configuración en `app/.env`

### 3. La aplicación no carga
- Verificar que las dependencias se instalaron: `docker-compose exec app ls -la /var/www/html/app/vendor`
- Si no existe, reinstalar: `docker-compose exec app composer install --working-dir=/var/www/html/app`

### 4. Puerto ya en uso
Cambiar los puertos en `docker-compose.yml`:
```yaml
ports:
  - "8081:80"  # Cambiar a otro puerto como 8082:80
```

## Para Producción

1. Cambiar `CI_ENVIRONMENT` a `production` en `app/.env`
2. Remover volúmenes de desarrollo en `docker-compose.yml`
3. Configurar HTTPS con un reverse proxy (nginx/traefik)
4. Usar variables de entorno para credenciales

## Soporte

Si encuentras problemas, revisa los logs de los contenedores y verifica que:
- Docker y Docker Compose estén actualizados
- Tengas suficiente espacio en disco y RAM
- Los puertos 8080 y 8081 estén disponibles
