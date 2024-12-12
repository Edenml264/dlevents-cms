# Diamond Lighting Events CMS

Sistema de gestión de contenido para Diamond Lighting Events, desarrollado con Laravel 10 y Tailwind CSS.

## Características

- Panel de administración completo
- Gestión dinámica de contenido para todas las páginas
- Sistema de leads y cotizaciones
- Configuración personalizable del sitio
  - Tipografías
  - Paleta de colores corporativos
  - Gestión de logo y favicon
- Vista previa de cambios en tiempo real
- Diseño responsivo y moderno
- Sistema de autenticación seguro

## Requisitos

- PHP >= 8.1
- Composer
- Node.js y npm
- MySQL o PostgreSQL

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/Edenml264/dlevents-cms.git
cd dlevents-cms
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de JavaScript:
```bash
npm install
```

4. Copiar el archivo de configuración:
```bash
cp .env.example .env
```

5. Configurar las variables de entorno en el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dlevents
DB_USERNAME=root
DB_PASSWORD=
```

6. Generar la clave de la aplicación:
```bash
php artisan key:generate
```

7. Ejecutar las migraciones y seeders:
```bash
php artisan migrate:fresh --seed
```

8. Compilar los assets:
```bash
npm run dev
```

9. Iniciar el servidor:
```bash
php artisan serve
```

## Estructura del CMS

### Panel de Administración

- **Dashboard**: Vista general de estadísticas y actividad
- **Gestión de Contenido**: 
  - Editor de páginas
  - Configuración del sitio
  - Vista previa de cambios
- **Leads**: Gestión de contactos y cotizaciones
- **Configuración**: Ajustes generales del sistema

### Páginas Gestionables

- Inicio
- Servicios
- Galería
- Contacto

## Acceso al Sistema

1. URL del panel de administración: `http://localhost:8000/admin`
2. Credenciales por defecto:
   - Usuario: `admin`
   - Contraseña: `Admin@2024`

## Personalización

### Configuración del Sitio

El sistema permite personalizar:

1. **Información General**
   - Nombre del sitio
   - Descripción
   - Información de contacto

2. **Diseño**
   - Tipografías principales y secundarias
   - Colores corporativos
   - Logo y favicon

3. **Contenido**
   - Textos de cada sección
   - Imágenes y galerías
   - Menús y navegación

## Seguridad

- Autenticación robusta
- Protección CSRF
- Validación de formularios
- Sanitización de entrada de datos

## Contribución

1. Fork el repositorio
2. Cree una rama para su característica (`git checkout -b feature/AmazingFeature`)
3. Commit sus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abra un Pull Request

## Guía de Deployment en Hostgator

### Requisitos del Servidor
- PHP 8.2 o superior
- MySQL 5.7 o superior
- Extensiones PHP requeridas:
  - BCMath
  - Ctype
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
  - Fileinfo

### Pasos para el Deployment

1. **Preparación del Proyecto**
   ```bash
   # Optimizar autoloader
   composer install --optimize-autoloader --no-dev
   
   # Optimizar configuración
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Configuración en Hostgator**
   - Accede al cPanel de Hostgator
   - Selecciona PHP Version Manager
   - Configura PHP 8.2 o superior para tu dominio
   - Crea una nueva base de datos MySQL desde cPanel

3. **Subida de Archivos**
   - Sube todos los archivos al directorio `public_html`
   - Mueve el contenido de la carpeta `public` a `public_html`
   - Ajusta las rutas en `index.php`

4. **Configuración del Entorno**
   - Renombra `.env.example` a `.env`
   - Configura las variables de entorno:
     ```
     APP_NAME="DL Events"
     APP_ENV=production
     APP_DEBUG=false
     APP_URL=https://tudominio.com
     
     DB_CONNECTION=mysql
     DB_HOST=localhost
     DB_PORT=3306
     DB_DATABASE=tu_base_de_datos
     DB_USERNAME=tu_usuario
     DB_PASSWORD=tu_contraseña
     ```

5. **Permisos de Archivos**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

6. **Instalación Final**
   ```bash
   php artisan migrate --force
   php artisan db:seed
   php artisan storage:link
   ```

### Solución de Problemas Comunes

1. **Error 500**
   - Verifica los permisos de las carpetas
   - Revisa el archivo `.env`
   - Consulta los logs en `storage/logs`

2. **Problemas de Base de Datos**
   - Confirma las credenciales en `.env`
   - Verifica que la base de datos existe
   - Asegúrate que el usuario tiene permisos

3. **Archivos no Encontrados**
   - Verifica la configuración del documento root
   - Asegúrate que los enlaces simbólicos están correctos

## Despliegue Automático con GitHub Actions

Este proyecto está configurado para realizar despliegue automático a Hostgator cuando se hace push a la rama `main`.

### Configuración Inicial

1. **Obtener Credenciales FTP de Hostgator**
   - Accede al cPanel de Hostgator
   - Ve a "FTP Accounts"
   - Crea o usa una cuenta FTP existente
   - Guarda la siguiente información:
     - Servidor FTP (hostname)
     - Usuario FTP
     - Contraseña FTP

2. **Configurar Secrets en GitHub**
   - Ve a tu repositorio en GitHub
   - Accede a "Settings" > "Secrets and variables" > "Actions"
   - Agrega los siguientes secrets:
     - `FTP_SERVER` (ejemplo: ftp.tudominio.com)
     - `FTP_USERNAME` (tu usuario FTP)
     - `FTP_PASSWORD` (tu contraseña FTP)

### Funcionamiento

El despliegue automático:
1. Se activa cuando se hace push a la rama `main`
2. Instala las dependencias necesarias
3. Optimiza la aplicación Laravel
4. Sube los archivos actualizados vía FTP a Hostgator

### Notas Importantes

- La primera vez, deberás configurar manualmente la base de datos y el archivo `.env` en el servidor
- Los archivos excluidos del despliegue incluyen:
  - `.git`
  - `node_modules`
  - `README.md`
  - `.env.example`
  - `phpunit.xml`
- Asegúrate de mantener las variables de entorno actualizadas en el servidor

Para soporte adicional, contacta a:
- Email: ventas@edenmendez.com

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## Soporte

Para soporte y consultas, por favor contactar a:
- Email: ventas@edenmendez.com
- Teléfono: (XXX) XXX-XXXX
