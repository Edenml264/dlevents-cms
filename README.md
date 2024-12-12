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

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## Soporte

Para soporte y consultas, por favor contactar a:
- Email: ventas@edenmendez.com
- Teléfono: (XXX) XXX-XXXX
