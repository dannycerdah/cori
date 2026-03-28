# Clínica Cori - Aplicación Web

Aplicación web moderna para gestión de citas médicas en una clínica, desarrollada con Laravel, MySQL y Livewire.

## Características

- **Página pública**: Información institucional, servicios y especialidades médicas
- **Sistema de citas**: Formulario para registrar citas médicas con validación
- **Panel administrativo**: Gestión de citas y pacientes con autenticación
- **Responsive**: Diseño adaptable a móviles usando Tailwind CSS
- **Compatible con cPanel**: Sin dependencias Node.js en producción

## Requisitos

- PHP 8.1 o superior
- MySQL 5.7 o superior
- Composer
- Servidor web (Apache/Nginx)

## Instalación Local

1. **Clonar o descargar el proyecto**:
   ```bash
   cd /ruta/a/tu/directorio
   # Si es clon: git clone <url-del-repo>
   # Si es descarga: extraer el ZIP
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   ```

3. **Configurar entorno**:
   - Copiar `.env.example` a `.env`
   - Configurar base de datos en `.env`:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=clinic
     DB_USERNAME=tu_usuario
     DB_PASSWORD=tu_password
     ```

4. **Generar clave de aplicación**:
   ```bash
   php artisan key:generate
   ```

5. **Ejecutar migraciones y seeders**:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Iniciar servidor de desarrollo**:
   ```bash
   php artisan serve
   ```
   Acceder en: `http://127.0.0.1:8000`

## Usuario Administrador

- **Email**: admin@clinicacori.com
- **Contraseña**: password123

## Despliegue en cPanel

### 1. Subir archivos
- Subir todo el contenido del proyecto (excepto `vendor/`) al directorio `public_html` o subdirectorio de tu dominio.

### 2. Configurar base de datos
- Crear base de datos MySQL en cPanel
- Crear usuario y asignar permisos
- Actualizar `.env` con las credenciales reales

### 3. Instalar dependencias
- Acceder por SSH o usar terminal de cPanel:
  ```bash
  composer install --no-dev --optimize-autoloader
  ```

### 4. Configurar aplicación
```bash
php artisan key:generate
php artisan migrate:fresh --seed
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 5. Configurar permisos
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### 6. Configurar .htaccess
Asegurarse de que el archivo `.htaccess` en `public/` esté presente para reescribir URLs.

## Estructura de Base de Datos

- **especialidades**: Nombre y descripción de especialidades médicas
- **pacientes**: Información de pacientes (nombre, teléfono, email)
- **citas**: Registros de citas con relaciones a pacientes y especialidades
- **users**: Usuarios del sistema (administradores)

## Tecnologías Usadas

- **Laravel 10**: Framework PHP
- **Livewire**: Componentes dinámicos sin JavaScript adicional
- **Tailwind CSS**: Framework CSS para diseño responsive
- **MySQL**: Base de datos relacional

## Funcionalidades

### Página Pública
- Información general de la clínica
- Lista de servicios médicos
- Especialidades disponibles
- Información de contacto
- Formulario de registro de citas

### Panel Administrativo
- Autenticación requerida
- Visualización de citas con filtros
- Gestión de estados de citas (pendiente/atendido/cancelado)
- Lista de pacientes registrados

## Seguridad

- Autenticación Laravel Breeze integrada
- Protección CSRF en formularios
- Validación de datos en backend
- Middleware de autenticación

## Desarrollo

Para desarrollo local con cambios en assets:
```bash
npm install
npm run dev
```

## Soporte

Para soporte técnico o reportes de bugs, contactar al equipo de desarrollo.

## Licencia

Este proyecto está bajo la Licencia MIT.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
