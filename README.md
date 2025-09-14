
# Administrador de usuarios y aplicaciones

Esta aplicacion permite gestionar usuarios, aplicaciones y su acceso por los usuarios

Permite tener administradores y usuarios normales.

Administrador:
- Puede administrar usuarios
- Puede administrar aplicaciones
- Puede administrar permisos de usuarios sobre aplicaciones

Usuario:
- Puede acceder para ver sus aplicaciones

Se han utilizado las ultimas versiones del software para tener un proyecto lo mas actualizado posible.

Aplicado practicas comunes para manejar componentes, estados, redirecciones, etc

---

## Frontend

### Tecnologías

- **Framework:** Vue 3 (Options API)
- **Estilos:** Bootstrap / Bootstrap Icons CSS3 / SCSS / 
- **Gestión de estado:** Pinia
- **Ruteo:** Vue Router
- **Peticiones:** Axios
- **Compilador:** Vite + plugin de Laravel
- **Node:** Node v22.19.0

### Funcionalidades principales

- Diseño responsive (desktop, mobile, tablet)
- Menus minimalistas
- SPA con login, panel, usuarios y aplicaciones
- Consumo de API optimizado y renderizado dinámico
- Proteccion de rutas y autenticacion con Vue router (Guard) + Pinia
- Manejo de sesion con cookies (Sanctum cookie-based)
- Componentización y reutilización de UI
- Manejo de errores del estado

## Backend

### Tecnologías

- **Framework:** Laravel 12
- **Lenguaje:** PHP 8.
- **Autenticación:** Laravel Sanctum (cookie-based auth)
- **Arquitectura:** DDD (Domain-Driven Design) y Hexagonal
- **Base de datos:** MySQL 8.4.6
- **ORM:** Eloquent
- **API:** REST JSON API
- **Tests (si aplica):** PHPUnit, Pest

### Funcionalidades principales

- API REST con rutas protegidas por autenticación vía Sanctum + proteccion CSRF i XSS
- CRUD requerido para usuarios, aplicaciones y permisos
- Validaciones en capas de aplicación y dominio (formato de datos y reglas de negocio)
- Separación clara entre dominio, infraestructura y aplicación
- Inyección de dependencias para repositorios
- Uso de DTOs para desacoplar la lógica de negocio (modelos Laravel)
- Configuracion de 

## Docker

- Tres contenedores, uno por servicio
- Un volumen para persistir base de datos
- Contenedor de PHP no se ejecuta hasta que MySQL esta arrancado (mediante `condition` y healthcheck) para entonces lanzar las migraciones

## Proyecto

### Usar en local
- Copiar `.env.example` a `.env`
- Modificar campos:
```dotenv
DOCKER_USER=
DOCKER_USER_UID=  # Solo para Linux
APP_URL=
SANCTUM_STATEFUL_DOMAINS= #localhost,localhost:<puerto>,localhost:<puerto-vite-server>

DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
- Generar contenedores: `docker compose up --build`

### Iniciar sesion

> Definidos en `database/seeders/DatabaseSeeder.php`

**Administrador**
```
julia_perez
admin1234
```

**Usuario**
```
ana_fernandez
user1234
```


### Estructura base de datos

`Users` id, username, email, name, surname, ..., is_admin
- Informacion de los usuarios, permite tambien iniciar sesion

`Applications` id, name, url, is_active
- Informacion de las aplicaciones

`User_application` user_id, application_id
- Permite relacionar usuarios con las aplicaciones que pueden utilizar


### Carpetas importantes

`/imagenes`: Contiene imagenes y video de la UI

`/src`: Contiene todos los ficheros para DDD y hexagonal del backend.

> Esta separado primero por contextos/entidades (Users, Applications, Shared) y dentro contiene cada capa (Application, Domain, Infrastructure)

`/resources`: Paginas, js, componentes, scss y todo lo necesario para el frontend

`/public/build`: Aplicacion compilada con Vite

`/routes/api.php`: Rutas de la API REST
