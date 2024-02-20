# Sistema de Punto de Venta CDP Lite

El sistema de punto de venta CDP Lite es una aplicación web basada en el lenguaje PHP y MySQL con la cual puedes mantener el control de inventario y venta de productos en una tienda. Este proyecto fue desarrollado utilizando CodeIgniter 4.

El sistema cuenta con un catalogo de productos, módulo de caja, ventas y reportes.

Con una interfaz adaptable que hace la administración del sistema más eficiente y permite la navegación móvil (diseño responsivo).

## Requisitos

- Servidor web (Apache Server 2.4 o superior).
- PHP 7.4 o superior.
  - Extensión [intl](http://php.net/manual/en/intl.requirements.php)
  - Extensión [mbstring](http://php.net/manual/en/mbstring.installation.php)
- MySQL 5.6 o superior.
- Composer
- Git (opcional)

## Instalación
### 1. Clonar repositorio:
```
git clone https://github.com/mroblesdev/pos-cdp-lite.git
```

### 2. Instalar dependencias con Composer:
```
cd pos-cdp-lite
composer install --no-dev
```

### 3. Configuración del entorno:

- Copia el archivo `env` a un nuevo archivo llamado `.env`.
- Modifica el archivo `.env` según tu configuración de base de datos y otros ajustes necesarios.

```
app.baseURL = 'http://localhost/pos-cdp-lite/public/'


database.default.hostname = localhost
database.default.database = pos-cdp-lite
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

Crear una base de datos con el nombre `pos-cdp-lite`.

### 4. Ejecutar migraciones y seeders:
```
php spark migrate

php spark db:seed ConfiguracionSeeder
php spark db:seed UsuariosSeeder
```

### 5. Ejecutar la aplicación:
```
php spark serve
``` 

Esto iniciará el servidor en http://localhost:8080 por defecto.

O en Apache Server con al dirección http://localhost/pos-cdp-lite/public

**Datos de acceso**

- **Usuario:** admin

- **Contraseña:** admin

### Habilitar mod_rewrite en Apache Server

El módulo `mod_rewrite` habilita URL sin `index.php`.

Asegúrese de que el módulo de reescritura esté habilitado (sin comentar) en el archivo de configuración principal, por ejemplo, `apache2/conf/httpd.conf`:
```
LoadModule rewrite_module modules/mod_rewrite.so
```

También asegúrese de que el elemento raíz del documento predeterminado `<Directory>` también lo habilite, en la configuración `AllowOverride`:
```
<Directory "/opt/lamp/apache2/htdocs">
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

## Características versión 1.0

- Acceso por credenciales
- Catalogo de productos
- Caja de cobro
- Generación de ticket
- Historial de ventas
  - Reimpresión de ticket
  - Cancelar ventas
- Reportes
  - Ventas
  - Productos
- Configuración del sistema

## Demostración

Para acceder a nuestra demostración y explorar todas las funcionalidades del Punto de Venta CDP Lite, por favor visita https://pos-lite.sistemarv.com


## Capturas de pantalla

| ![Inicio de sesión](public/images/capturas/1-Login.png)  |  ![Dashboard](public/images/capturas/2-Dasdboard.png)
| --- | --- |
| ![Caja](public/images/capturas/3-Caja.png)  |  ![Ticket](public/images/capturas/4-Ticket.png)
| ![Propuctos](public/images/capturas/5-Productos.png)  |  ![Reporte](public/images/capturas/6-Reporte.png)

## Contribuciones

Siéntete libre de contribuir al proyecto.

## Expresiones de Gratitud 🎁

- Comenta a otros sobre este proyecto 📢
- Invitame una cerveza 🍺 o un café ☕ [Da clic aquí](https://www.paypal.com/paypalme/markorobles?locale.x=es_XC.).

## Licencia

Este proyecto está bajo la Licencia [MIT](LICENSE).
