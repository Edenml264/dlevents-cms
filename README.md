# Diamond Lighting Events - CMS

Sistema de gestión de contenido (CMS) para Diamond Lighting Events, especializado en servicios audiovisuales para bodas, eventos corporativos y conciertos.

## Características

- **Gestión de Leads**
  - Dashboard con estadísticas
  - Seguimiento de leads y oportunidades
  - Filtrado por estado y fecha

- **CMS**
  - Gestión de secciones de página
  - Sistema de menú dinámico
  - Editor WYSIWYG con TinyMCE
  - Gestión de medios con FilePond

- **Panel de Administración**
  - Gestión de usuarios
  - Perfiles personalizables
  - Interfaz responsive

## Requisitos

- PHP >= 8.1
- Composer
- Node.js y NPM
- MySQL/SQLite

## Instalación

1. Clonar el repositorio:
```bash
git clone [url-del-repositorio]
cd dlevents
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de JavaScript:
```bash
npm install
```

4. Configurar el entorno:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurar la base de datos en el archivo `.env`

6. Ejecutar las migraciones:
```bash
php artisan migrate
```

7. Compilar assets:
```bash
npm run dev
```

## Desarrollo

Para el desarrollo local:

```bash
php artisan serve
npm run dev
```

## Estructura del Proyecto

- `app/Http/Controllers/Admin` - Controladores del panel de administración
- `resources/views/admin` - Vistas del panel de administración
- `database/migrations` - Migraciones de la base de datos
- `routes/web.php` - Definición de rutas
- `public/storage` - Archivos públicos y medios

## Contribuir

1. Crear un branch para la característica: `git checkout -b feature/nombre-caracteristica`
2. Commit de los cambios: `git commit -m 'Añadir nueva característica'`
3. Push al branch: `git push origin feature/nombre-caracteristica`
4. Crear un Pull Request

## Licencia

[Tipo de Licencia] - Ver archivo LICENSE para más detalles.
