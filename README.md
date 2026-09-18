# NYVA - Actividad 2 - Electiva Profesional II

Proyecto académico para implementar en Laravel el modelo de datos definido en la Actividad 1 de NYVA: **Asistente virtual para la Automatización de Atención al Cliente y Gestión de Pedidos**.

- Jorge Daza
- Jonatan Arrieta
- Jesus Carrillo

## Tecnología

- PHP 8.3 o superior.
- Laravel 13.x.
- MySQL.
- Eloquent ORM.
- Migraciones, Factories y Seeders.

## Fuentes académicas usadas

1. `Primera Actividad Formativa (1).pdf`: modelo de datos, entidades, atributos y cardinalidades.
2. `Guia_Convenciones_Laravel.docx`: convenciones de nombres exigidas por el docente.
3
## Entidades implementadas

- User (`users`)
- Establishment (`establishments`)
- Plan (`plans`)
- Subscription (`subscriptions`)
- Category (`categories`)
- Product (`products`)
- Schedule (`schedules`)
- FrequentlyAskedQuestion (`frequently_asked_questions`)
- Order (`orders`)
- OrderItem (`order_items`)
- Conversation (`conversations`)

`order_items` representa la entidad asociativa **Detalle del pedido**. No se trató como una tabla pivot simple porque posee clave primaria propia y atributos de negocio: cantidad, precio unitario y subtotal.

## Instalación rápida en Windows / WampServer

1. Verifica PHP:

```bash
php -v
```

Laravel 13 requiere PHP 8.3 o superior.

2. Entra al proyecto e instala dependencias:

```bash
composer install
```

3. Crea el archivo de entorno:

```bash
copy .env.example .env
```

En PowerShell también puedes usar:

```powershell
Copy-Item .env.example .env
```

4. Genera la clave de aplicación:

```bash
php artisan key:generate
```

5. Crea la base de datos `nyva`. Puedes usar phpMyAdmin o ejecutar el contenido de:

```text
database/sql/create_database.sql
```

6. Ajusta en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nyva
DB_USERNAME=root
DB_PASSWORD=
```

7. Limpia configuración y reconstruye la base de datos:

```bash
php artisan config:clear
php artisan migrate:fresh --seed
```

8. Revisa el estado de migraciones:

```bash
php artisan migrate:status
```

9. Inicia el servidor:

```bash
php artisan serve
```

## Usuarios de demostración

Los seeders crean dos cuentas **solo para desarrollo académico**:

- `platform.admin@nyva.test`
- `establishment.admin@nyva.test`

La contraseña se toma de `SEED_DEMO_PASSWORD` en `.env`. La que aparece en `.env.example` es únicamente una contraseña de demostración y debe cambiarse fuera del entorno académico.

## Regla de GitHub

Sí deben versionarse:

- `app/Models`
- `database/migrations`
- `database/factories`
- `database/seeders`
- `.env.example`
- `composer.json`
- `composer.lock` cuando se genere con Composer
- documentación del proyecto

No deben versionarse:

- `.env`
- `vendor/`
- contraseñas reales, tokens o secretos

## Documentación completa

Consulta [`docs/ACTIVIDAD_2_DOCUMENTACION.md`](docs/ACTIVIDAD_2_DOCUMENTACION.md) para el análisis, decisiones técnicas, orden de migraciones, comandos Artisan, correspondencia del modelo y guion de sustentación.
